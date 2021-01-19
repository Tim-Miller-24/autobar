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
const MONTH_NAMES = ['Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'];
const DAYS = ['Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб', 'Вс'];

function formatDate(date) {
    let month = '' + (date.getMonth() + 1),
        day = '' + date.getDate(),
        year = date.getFullYear();

    if (month.length < 2)
        month = '0' + month;
    if (day.length < 2)
        day = '0' + day;

    return [year, month, day].join('-');
}