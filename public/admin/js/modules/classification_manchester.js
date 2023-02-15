$(document).on('click', '.query-topics', function (e) {
    e.preventDefault()
    query_topics()
})

function query_topics() {
    request($('.query-topics').attr('url'), {topics_letter:$('#topics_letter').val(), topics:$('#topics').val(), topics_sinais:$('#topics_sinais').val()}, function(res){
        $('#res-topcs').html(res)
    }, 'GET')
}