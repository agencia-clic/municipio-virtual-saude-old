//list data
function list_approve() {
    request($('#table-admit_patient_requests').attr('url'), {page:$('#page').val()}, function(res){
        $('#table-admit_patient_requests').html(res)
    }, 'POST')
}
list_approve()

//approve modal
function approve_reprove_modal(title, desc, url, a, color) {
    
    modal_info(title, '', desc, `bg-${color}`, `<button type="button" class="btn btn-${color}" data-bs-dismiss="modal" onclick="run_approve_reprove('${url}')">${a}</button>`)
}

function run_approve_reprove(url) {
    
    request(url, {}, function(res){
        modal_info("SUCESSO", '', `Registro deletado com sucesso.`, 'bg-primary')
        list_approve()
    }, 'POST')
}