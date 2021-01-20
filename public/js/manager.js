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

let from_$input = $('#sales_date_from').pickadate({
        monthsFull: [ 'января', 'февраля', 'марта', 'апреля', 'мая', 'июня', 'июля', 'августа', 'сентября', 'октября', 'ноября', 'декабря' ],
        monthsShort: [ 'янв', 'фев', 'мар', 'апр', 'май', 'июн', 'июл', 'авг', 'сен', 'окт', 'ноя', 'дек' ],
        weekdaysFull: [ 'воскресенье', 'понедельник', 'вторник', 'среда', 'четверг', 'пятница', 'суббота' ],
        weekdaysShort: [ 'вс', 'пн', 'вт', 'ср', 'чт', 'пт', 'сб' ],
        today: 'сегодня',
        clear: 'удалить',
        close: 'закрыть',
        firstDay: 1,
        format: 'yyyy-mm-dd'
    }),
    from_picker = from_$input.pickadate('picker');

let to_$input = $('#sales_date_to').pickadate({
        monthsFull: [ 'января', 'февраля', 'марта', 'апреля', 'мая', 'июня', 'июля', 'августа', 'сентября', 'октября', 'ноября', 'декабря' ],
        monthsShort: [ 'янв', 'фев', 'мар', 'апр', 'май', 'июн', 'июл', 'авг', 'сен', 'окт', 'ноя', 'дек' ],
        weekdaysFull: [ 'воскресенье', 'понедельник', 'вторник', 'среда', 'четверг', 'пятница', 'суббота' ],
        weekdaysShort: [ 'вс', 'пн', 'вт', 'ср', 'чт', 'пт', 'сб' ],
        today: 'сегодня',
        clear: 'удалить',
        close: 'закрыть',
        firstDay: 1,
        format: 'yyyy-mm-dd'
    }),
    to_picker = to_$input.pickadate('picker');


// Check if there’s a “from” or “to” date to start with.
if ( from_picker.get('value') ) {
    to_picker.set('min', from_picker.get('select'))
}
if ( to_picker.get('value') ) {
    from_picker.set('max', to_picker.get('select'))
}

// When something is selected, update the “from” and “to” limits.
from_picker.on('set', function(event) {
    if ( event.select ) {
        to_picker.set('min', from_picker.get('select'))
    }
    else if ( 'clear' in event ) {
        to_picker.set('min', false)
    }
});

to_picker.on('set', function(event) {
    if ( event.select ) {
        from_picker.set('max', to_picker.get('select'))
    }
    else if ( 'clear' in event ) {
        from_picker.set('max', false)
    }
});