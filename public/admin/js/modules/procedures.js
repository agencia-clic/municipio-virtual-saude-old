
//accept procedures
$(document).on('click', '.accept-procedures', function(e){
    e.preventDefault()
    procedures($(this))        
})

function procedures(a) {
    let title = a.attr('data-title')

    if(title == undefined){
        title = "ACEITAR"
    }

    let id = a.attr('data-id');

    modal_info(title, '', `Deseja ${title.toLowerCase()} o registro de codigo: <strong>${id}</strong>`, 'bg-warning', `<button type="button" class="btn btn-warning action-procedures" id="${a.attr('data-id')}" url="${a.attr('href')}">${title}</button>`)
}

$(document).on('click', '.action-procedures', function () {
    request($(this).attr('url'), {}, function(res){
        modal_info("SUCESSO", '', 'Ação Realizada com sucesso.', 'bg-primary')
        list()
    }, 'POST')
})

//list data
function list() {
    
    request($('#table-procedures-accept').attr('url'), {page:$('#page').val(), cpf_cnpj:$('#cpf_cnpj').val(), status:$('#status').val(), name:$('#name').val(), IdEmergencyServices:$('#IdEmergencyServices').val()}, function(res){
        $('#table-procedures-accept').html(res)
    }, 'POST')
}
list()