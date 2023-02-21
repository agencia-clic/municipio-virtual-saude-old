
window.materials_create = function(title, url, url_create){
    request(url, {}, function(res){
        modal_create(title, res, "", 'primary', 50, `<button class="btn btn-primary btn-sm materials-save" onclick="save_materials('${url_create}')" type="button">Salvar</button>`)
    })
}

function save_materials(url) {
    
    let error = false

    if($('#IdMaterials').val() == null || $('#IdMaterials').val() == ""){
        $('#IdMaterials').addClass('is-invalid')
        error = true
    }

    if($('#amount').val() == null || $('#amount').val() == ""){
        $('#amount').addClass('is-invalid')
        error = true
    }

    if(error){
        return 0
    }

    request(url, {amount:$('#amount').val(), IdMaterials:$('#IdMaterials').val(), note:$('#note').val()}, function(res){
        
        window.top.frames['iframe_modal'].reload()
        reload()

        $('#modal_create').modal('hide')
        $('#modal_create').remove()

    }, 'POST')
}

window.delete_modal_materials = function(title, id, del, url){
    modal_info(title, '', `Realmente deseja ${title.toLowerCase()} o registro de codigo: <strong>${id}</strong>`, 'bg-danger', `<button type="button" class="btn btn-danger" data-bs-dismiss="modal" onclick="delete_run('${url}', '${id}', '${del}')">${title}</button>`)
}

function delete_run(url, id, del) {
    $(`#${del}`).remove()
    request(url, {}, function(res){
        window.top.frames['iframe_modal'].reload()
        reload()
    }, 'POST');
}