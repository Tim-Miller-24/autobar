var host = window.location.host.split(':')[0];
var socket = io.connect('//' + host + ':8000', {rejectUnauthorized: false});

socket.on('connect', function () {
    console.log('CONNECT');

    socket.on('validator', function (data) {
        console.log('VALIDATOR EVENT', data);

        switch (data.action) {
            case 'PROXY':
                switch (data.data.event) {
                    case 'orderFinished':
                        Livewire.emit('orderFinished');
                        break;
                    case 'creditAdded':
                        Livewire.emit('creditAdded');
                        document.querySelector('#NotifyCreditAdded').play();
                        break;
                    case 'orderCreated':
                        setTimeout(function(){
                            location.reload();
                        }, 2000);
                        document.querySelector('#NotifyOrderCreated').autoplay = true;
                        break;
                }
                break;

        }
    });

    socket.on('disconnect', function () {
        console.log('disconnect')
    })
});

function sleep(ms) {
    return new Promise(resolve => setTimeout(resolve, ms));
}