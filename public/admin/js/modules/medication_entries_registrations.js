function medication_reload(id = null) {

    let url = $('#IdMedicines').attr('url-query')
    request(url, {IdMedicines:id, name:$('#medication_name').val()}, function(res){
        res = JSON.parse(res)
        html = '<option value="">...</option>'

        if(res != null && res.length > 0){
            html = ""

            console.log(res)

            $.each(res, function( index, value ){
                html = html + `<option value="${value.IdMedicines}">${value.title} • ${value.units}</option>`;
            });
        }

        $('#IdMedicines').html(html)
       
    }, "POST");
}

$(document).on('keyup', '#medication_name', function(){
    medication_reload()
})

$(document).on('click', '.modal-save', function(e){
    e.preventDefault()
    modal_info("ATENÇÃO", '', 'Deseja realmente continuar ?', 'bg-warning', `<button type="button" class="btn btn-warning submit-form-medication" data-bs-dismiss="modal">Continuar</button>`)
})

$(document).on('click', '.submit-form-medication', function(e){
    $("#form").first().submit();
})
