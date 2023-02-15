$(document).on("click",'button[iframe-create]',function(e) {
    e.preventDefault();
    let title = $(this).attr('title')
    let url_insert = $(this).attr('iframe-create');
    let url = $(this).attr('iframe-form');
    
    if(url){
        request(url, {}, function(res){
            modal_create(title, res, url_insert)
        });
    }
})

$(document).on("submit","#form_modal",function(e) {
    e.preventDefault()
    
    let url = $(this).attr('action');
    let form = $('#form_modal')[0]
    let data = new FormData(form);
    let title = $('#modal_create_label').text();

    $('#modal_create').modal('hide')
    $('#modal_create').remove();

    $.ajax({
        url: url,
        method: 'POST',
        data: data,
        contentType: false, 
        processData: false,
        success: function(res) {
            
            if(res == 'success'){
                reload()
            }else{
                modal_create(title, res, url)
            }

        },error: function (xmlHttpRequest, textStatus, errorThrown) {
            modal_info("ERRO", "ERRO AO TENTAR REALIZAR ESSA AÇÂO","POR FAVOR TENTE NOVAMENTE.", "bg-warning")
        }
    })

})

function reload() {
   $(".flatpickr-calendar.animate").remove();
    $('div[data-iframe]').each(function( index ) {
        if($(this).attr('data-iframe')){
            let a = $(this);
            reload_html($(this).attr('data-iframe'), a)
        }
    });
}
reload()

function reload_html(url, a) {
    request(url, {}, function(res){
        a.html(res)
    });
}

window.reload_iframe = function(id){
    reload()
}

window.delete_modal = function(title, id, del, url){
    modal_info(title, '', `Realmente deseja ${title.toLowerCase()} o registro de codigo: <strong>${id}</strong>`, 'bg-danger', `<button type="button" class="btn btn-danger" data-bs-dismiss="modal" onclick="window.top.frames['iframe_modal'].delete_run('${url}', '${id}', '${del}')">${title}</button>`)
}

window.delete_modal_success = function(){
    modal_info("SUCESSO", '', `Registro deletado com sucesso.`, 'bg-primary')
}