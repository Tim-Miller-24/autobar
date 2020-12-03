var host = window.location.host.split(':')[0];
var socket = io.connect('//' + host + ':8000', {rejectUnauthorized: false});

socket.on('connect', function () {
    console.log('CONNECT');

    socket.on('validator', function (data) {
        console.log('VALIDATOR EVENT', data);

        switch (data.action) {
            case 'CREDIT':
                Livewire.emit('creditAdded');
                break;

            case 'PROXY':
                switch (data.data.event) {
                    case 'orderFinished':
                        console.log('orderFinished');
                        setTimeout(function(){
                            window.location.replace(data.data.url);
                        }, 2000);
                        // document.querySelector('#NotifyOrderCreated').autoplay = true;
                        break;
                    case 'orderPaid':
                        console.log('orderPaid');
                        Livewire.emit('orderPaid');
                        break;
                    case 'creditAdded':
                        console.log('creditAdded');
                        Livewire.emit('creditAdded');
                        break;
                    case 'orderCreated':
                        console.log('orderCreated');
                        Livewire.emit('orderCreated');
                        break;
                }
                break;

        }
    });

    socket.on('disconnect', function () {
        console.log('disconnect')
    })
});
