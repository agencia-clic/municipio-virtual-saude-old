

$(document).on("click","a[action='delete']",function(e) {
    e.preventDefault();
    let title = $(this).attr('data-title')

    if(title == undefined){
        title = "DELETAR"
    }

    let del = $(this).attr('data-id-delete');
    if(del == undefined){
       del = `${$(this).attr('data-id')}-table`;
    }
    modal_info(title, '', `Realmente deseja ${title.toLowerCase()} o registro de codigo: <strong>${$(this).attr('data-id')}</strong>`, 'bg-danger', `<button type="button" class="btn btn-danger action-delete" data-id-delete="${del}" id="${$(this).attr('data-id')}" url="${$(this).attr('href')}">${title}</button>`)
});

$(document).on('click', ".action-delete", function(e) {
    e.preventDefault()
    let del = $(this).attr('data-id-delete')

    $(`#${del}`).remove()
    request($(this).attr('url'), {}, function(res){
        modal_info("SUCESSO", '', `Registro deletado com sucesso.`, 'bg-primary')
    }, 'POST');
});