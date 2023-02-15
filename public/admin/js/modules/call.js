
//data e hora atual
setInterval(function(){
    let new_time = new Date()
    let hours = new_time.getHours()
    let minutes = zero(new_time.getMinutes())
    let month = zero(new_time.getMonth() + 1)
    let day = zero(new_time.getDate())

    $('#date-time').html(`
        <div class="col-md-6">
            <span class="text-white h1 align-middle" style="font-size: 4.5vh">${hours}:${minutes}</span>
        </div>
        <div class="col-md-6">
            <span class="text-white h1 align-middle" style="font-size: 4.5vh">${day}/${month}</span>
        </div>
    `)
    
},1000)

//list data
function list() {
    request($('#historic-table').attr('url'), {}, function(res){
        $('#historic-table').html(res)
    }, 'POST')

    request($('#historic-table').attr('url-call'), {}, function(res){
       
        res = JSON.parse(res)

        if(res != null && res[0] != null){

            $('#current-patient').html(`
                <h1 class="text-white align-middle" style="font-size: 8vh">Paciente</h1>
                <span class="text-white h1 align-middle" style="font-size: 4vh">${res[0].user}</span>
            `)

            $('#sala-call').html(res[0].sala)
        }

    }, 'POST')
}
list()

//call
Echo.channel(`call.${$('#historic-table').attr('data-id')}`).listen('channelCall', (e) => {
    list()
    sound_play()
});

//sound button
$(document).on('mousemove', '.button-sound-footer', function (e) {
    $('.button-sound').removeClass('hide')
})

$(document).on('mouseleave', '.button-sound-footer', function (e) {
    $('.button-sound').addClass('hide')
})

//sound
$(document).on('click', '.button-sound', function (e) {
    
    $('.button-sound').removeClass('btn-secondary')
    $('.button-sound').addClass('btn-primary')
    sound_play()
})

function sound_play() {
    const audio = new Audio($('.button-sound').attr('data-audio'));
    audio.play();
}