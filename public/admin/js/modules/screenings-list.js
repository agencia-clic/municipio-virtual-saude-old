//new data
Echo.channel(`emergency-services.${$('#table-screenings').attr('data-id')}`).listen('channelEmergencyServices', (e) => {
    list()
});

//screenings
Echo.channel(`screenings.${$('#table-screenings').attr('data-id')}`).listen('channelScreenings', (e) => {
    list()
});

//list data
function list() {
    request($('#table-screenings').attr('url'), {page:$('#page').val(), cpf_cnpj:$('#cpf_cnpj').val(), types:$('#types').val(), name:$('#name').val(), IdEmergencyServices:$('#IdEmergencyServices').val()}, function(res){
        $('#table-screenings').html(res)
    }, 'POST')
}
list()