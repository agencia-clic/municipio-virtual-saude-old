//new data
Echo.channel(`emergency-services.${$('#table-medical_care').attr('data-id')}`).listen('channelEmergencyServices', (e) => {
    list()
});

//start medical care
Echo.channel(`medical-care.${$('#table-emergency-services').attr('data-id')}`).listen('channelMedicalCare', (e) => {
    list()
});

//screenings
Echo.channel(`screenings.${$('#table-medical_care').attr('data-id')}`).listen('channelScreenings', (e) => {
    list()
});

//list data
function list() {
    request($('#table-medical_care').attr('url'), {page:$('#page').val(), cpf_cnpj:$('#cpf_cnpj').val(), types:$('#types').val(), name:$('#name').val(), IdEmergencyServices:$('#IdEmergencyServices').val()}, function(res){
        $('#table-medical_care').html(res)
    }, 'POST')
}
list()

$(document).on('click', '.medical-care-watch', function(e){
    e.preventDefault()
    modal_info('Atenção', '', $(this).attr('title'), 'bg-warning', `<button class="btn btn-warning medical-care-watch-button" url="${$(this).attr('href')}" type="button">Sim</button>`)
})

$(document).on('click', '.medical-care-watch-button', function () {

    request($(this).attr('url'), {}, function(res){
        list()
    }, 'POST')
    
    $('#modal_info').modal('hide')
    $('#modal_info').remove();
})