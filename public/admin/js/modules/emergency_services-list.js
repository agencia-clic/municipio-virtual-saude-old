//new data
Echo.channel(`emergency-services.${$('#table-emergency-services').attr('data-id')}`).listen('channelEmergencyServices', (e) => {
    list()
});

//screenings
Echo.channel(`screenings.${$('#table-emergency-services').attr('data-id')}`).listen('channelScreenings', (e) => {
    list()
});

//start medical care
Echo.channel(`medical-care.${$('#table-emergency-services').attr('data-id')}`).listen('channelMedicalCare', (e) => {
    list()
});

//list data
function list() {
    request($('#table-emergency-services').attr('url'), {page:$('#page').val(), cpf_cnpj:$('#cpf_cnpj').val(), types:$('#types').val(), name:$('#name').val(), IdEmergencyServices:$('#IdEmergencyServices').val()}, function(res){
        $('#table-emergency-services').html(res)
    }, 'POST')
}
list()