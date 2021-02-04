process.setMaxListeners(Infinity); // <== Important line

const SERVER_PORT = 8000;
const SOCKET_CHANNEL = 'validator';
const REDIS_CHANNEL = 'bar_validator';
const ADD_CREDIT_URL = 'http://storm.bar/wallet/add';
const SECRET_KEY = 'VALIDATOR_SECRET';

const sspLib = require('encrypted-smiley-secure-protocol');
const axios = require('axios');

// require http module and get server
const server = require('http').Server();

// using socket.io which was installed through npm
const io = require('socket.io')(server, {
    cors: {
        origin: '*',
    }
});

const Redis = require("ioredis");
const sub = new Redis();

let channels = [{value: 0, country_code: 'UZS'}];

let eSSP = new sspLib({
    id: 0,
    debug: false,
    timeout: 3000,
    fixedKey: '0123456701234567'
});

let serialPortConfig = {
    baudrate: 9600, // default: 9600
    databits: 8, // default: 8
    stopbits: 2, // default: 2
    parity: 'none' // default: 'none'
};

eSSP.on('OPEN', () => {
    console.log('Port opened!');
});

eSSP.on('CLOSE', () => {
    console.log('Port closed!');
});

eSSP.on('CREDIT_NOTE', result => {
    console.log(channels[result.channel]);
    axios
        .post(ADD_CREDIT_URL, {
            value: channels[result.channel].value,
            secret: SECRET_KEY
        })
        .then(res => {
            console.log(res.data);
        })
        .catch(error => {
            console.error(error);
        });
});

eSSP.on('NOTE_REJECTED', result => {
    console.log('NOTE_REJECTED', result);

    eSSP.command('LAST_REJECT_CODE')
        .then(result => {
            console.log(result)
        })
});

sub.subscribe(REDIS_CHANNEL);
sub.on("message", function (channel, data) {
    console.log(channel, data);

    data = JSON.parse(data);

    switch (data.action) {
        case 'START':
            eSSP.command('SYNC')
                .then(() => eSSP.command('SYNC'))
                .then(() => eSSP.enable())
                .then(() => {
                    console.log('VALIDATOR ENABLED');
                    io.emit(SOCKET_CHANNEL, 'VALIDATOR ENABLED');
                })
                .catch(error => {
                    console.log(error);
                });
            break;

        case 'STOP':
            eSSP.command('SYNC')
                .then(() => eSSP.command('SYNC'))
                .then(() => eSSP.disable())
                .then(() => {
                    console.log('VALIDATOR DISABLED');
                    io.emit(SOCKET_CHANNEL, 'VALIDATOR DISABLED');
                })
                .catch(error => {
                    console.log(error);
                });
            break;

        case 'PROXY':
            console.log(data);
            io.emit(SOCKET_CHANNEL, {
                'action': data.action,
                'data': data.data
            });
            break;
    }

});


eSSP.open('/dev/ttyACM0', serialPortConfig)
    .then(() => eSSP.command('SYNC'))
    .then(() => eSSP.command('HOST_PROTOCOL_VERSION', {version: 6}))
    .then(() => eSSP.initEncryption())
    .then(() => eSSP.command('SET_CHANNEL_INHIBITS', {
        channels: [0, 0, 0, 1, 1, 1, 1, 1] // channel 1-3 disable
    }))
    .then(() => eSSP.command('GET_SERIAL_NUMBER'))
    .then(result => {
        console.log('SERIAL NUMBER:', result.info.serial_number);
    })
    .then(() => eSSP.command('SETUP_REQUEST'))
    .then(result => {
        for (let i = 0; i < result.info.channel_value.length; i++) {
            channels[result.info.channel_value[i]] = {
                value: result.info.expanded_channel_value[i],
                country_code: result.info.expanded_channel_country_code[i]
            };
        }
    })
    .catch(error => {
        console.log(error);
    });


// Start listening for client.css connections
server.listen(SERVER_PORT, function () {
    console.log('Listening to incoming client connections on port ' + SERVER_PORT)
});
