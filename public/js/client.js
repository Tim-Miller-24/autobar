let host = window.location.host.split(':')[0];
let socket = io.connect('//' + host + ':8000', {rejectUnauthorized: false});

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
                        }, 3000);
                        document.querySelector('#NotifyOrderFinished').autoplay = true;
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
                    case 'maintenanceMode':
                        console.log('maintenanceMode');
                        setTimeout(function(){
                            window.location.replace('http://' + host);
                        }, 1000);
                        break;
                    case 'workDay':
                        console.log('workDay');
                        setTimeout(function(){
                            window.location.replace(data.data.url);
                        }, 1);
                        break;
                }
                break;

        }
    });

    socket.on('disconnect', function () {
        console.log('disconnect')
    })
});

$("button.modal-button").click(function (e) {
    e.preventDefault();
    let modal_id = $(this).data('modal-id');
    $(modal_id).modal();
});

let inactivityTime = function () {
    let time;
    window.onload = resetTimer;
    // DOM Events
    document.onmousemove = resetTimer;
    document.onkeydown = resetTimer;
    document.onclick = resetTimer;     // touchpad clicks
    document.addEventListener('scroll', resetTimer, true); // improved; see comments

    function goToSlideshow() {
        if(slideshow) {
            alert("You are now logged out.")
        }
        //location.href = 'logout.html'
    }

    function resetTimer() {
        clearTimeout(time);
        time = setTimeout(goToSlideshow, 3000)
        // 1000 milliseconds = 1 second
    }
};

window.onload = function() {
    inactivityTime();
};