//users query - start 
$(".query_users_patient").on('click', function(e){
    request($(this).attr('url'), {user_letter:$('#user_letter').val(), user_name:$('#user_name').val(), user_cpf_cnpj:$('#user_cpf_cnpj').val(),user_cns:$('#user_cns').val(), user_mother:$('#user_mother').val(), user_date_birth:$('#user_date_birth').val()}, function(res){
        $(`#IdUsers`).html(res)
        enable_edit()
        users_atual_reload($(`#IdUsers`).val())
    }, 'POST');
})
//users query - end

//users edit patient - start
$(".edit-patient-users").on('click', function(e){
    let IdUsers = $('#IdUsers').val();
    if(IdUsers){
        modal_iframe($(this).attr('iframe-title'), `${$(this).attr('url')}/${btoa(IdUsers)}`, `<button class="btn btn-primary btn-sm submit-form-iframe" type="button">Editar</button>`)
    }else{
        modal_info("Atenção", "","Selecione um paciente.", "bg-warning")
    }
})
//users edit patient - end

//anabled - edit - start
$(document).on('change', '#IdUsers', function(e){
    e.preventDefault()
    enable_edit()
    users_atual_reload($(this).val())
})
//anabled - edit - end

function enable_edit() {
    if($('#IdUsers').val()){
        $('.edit-patient-users').prop("disabled", false)
    }else{
        $('.edit-patient-users').prop("disabled", true)
    }
}
enable_edit()

window.query_users = function(id){
    users_atual_reload(id)
};

function users_atual_reload(id) {
    let url = $('#IdUsers').attr('url-query')

    if(url && id){
        request(url, {id:id}, function(res){
            res = JSON.parse(res)
            color_users_data(res[0])
            query_fields()
        }, "POST");
    }else{
        color_users_data()
    }
}

if($('#IdUsers').val()){
    users_atual_reload($('#IdUsers').val())
}

function color_users_data(a) {
 
    let html = null;
    if(a){
        html = `<div class="alert alert-${use_weight_color(a)}" role="alert">
            <h5 class="alert-heading fw-semi-bold">${not_null(a['name'], ' • ')} ${not_null(a['cpf_cnpj'], ' • ')} ${not_null(a['date_birth'], '', ' Anos')}</h5>
            <span><strong>Mãe: ${not_null(a['mother'])}</strong></span><br/>
            <span><strong>CNS: ${not_null(a['cns'])}</strong></span><br/>
            <span><strong>Email: ${not_null(a['email'])}</strong></span><br/>
            <span><strong>Telefone: ${not_null(a['phone'])}</strong></span><br/>
            <span><strong>Celular: ${not_null(a['cell'])}</strong></span><br/>
            <span><strong>Endereço: ${not_null(a['address'], ' • ')} ${not_null(a['number'], ' • ')} ${not_null(a['complement'])} ${not_null(a['district'], ' • ')} ${not_null(a['city'], ' • ')} ${not_null(a['uf'])}</strong></span><br/>
        </div>`;

        $(`#IdUsers option[value='${a['IdUsers']}']`).each(function() {
            $(this).remove();
        });

        $('#IdUsers').html(` <option value="${a['IdUsers']}">${a['name']}</option>` + $('#IdUsers').html())
    }

    $('.users-data-view').html(html)
}

function use_weight_color(a) {
    
    let w = 0;

    if(!a['mother']){
        w = w + 3;
    }

    if(!a['cpf_cnpj']){
        w = w + 3;
    }

    if(!a['cns']){
        w = w + 3;
    }

    if(!a['phone']  && !a['cell']){
        w = w + 1;
    }

    if(!a['date_birth']){
        w = w + 2;
    }

    if(!a['address'] || !a['zip_code'] || !a['number']){
        w = w + 2;
    }

    if(w < 2){
        return "success";
    }

    if(w == 2){
        return "primary";
    }

    if(w <= 6){
        return "warning";
    }

    return "danger";
}

//allergies diseases
$(document).on("submit","#form_modal",function(e) {
    e.preventDefault()
    
    let url = $(this).attr('action');
    let form = $(this).serializeArray();
    let title = $('#modal_create_label').text();
    let data = [];
    $.each(form, function(i, field){
        data[field.name] = field.value;
    });

    data = Object.assign({}, data)

    request(url, data, function(res){

        $('#modal_create').modal('hide')
        $('#modal_create').remove();

        if(res == 'error'){
            modal_info("ERRO", "ERRO AO TENTAR REALIZAR ESSA AÇÂO","POR FAVOR TENTE NOVAMENTE.", "bg-warning")
        }else if(res == 'success'){
            query_fields()
        }else{
            modal_create(title, res, url)
        }
    
    }, 'POST');
})

function query_fields() {

    let IdUsers = $('#IdUsers').val()

    if(IdUsers){
        let a;
        $('div[data-iframe]').each(function( index ) {
            let a = $(this)

            request(id_after($(this).attr('data-iframe'), btoa(IdUsers)), {}, function(res){
                a.html(res)
                $('.card-users').removeClass('hide');
            });
        });
    }else{
        $('.card-users').addClass('hide');
    }
}
query_fields();

$(document).on("click",'button[iframe-create]',function(e) {
    e.preventDefault();
    let IdUsers = $('#IdUsers').val()
    let title = $(this).attr('title')

    let url_insert = id_after($(this).attr('iframe-create'), btoa(IdUsers), $(this).attr('a'))
    let url = id_after($(this).attr('iframe-form'), btoa(IdUsers), $(this).attr('a'))
    
    if(url){
        request(url, {}, function(res){
            modal_create(title, res, url_insert)
        });
    }
})

function id_after(url, id, b = false) {
   let a = url.split('?')

    if(b){
        return url
    }

    if(a[1] != undefined){
        return `${a[0]}/${id}?${a[1]}`
    }

   return `${a[0]}/${id}`
}

//show register users 
function show_register_users() {

    if($('#identified_patient').val() == "n"){
        $('.card-users-patient-register').addClass('hide')
        $('.users-no-indentificate').removeClass('hide')
        $("#IdUsers").val('')
        
    }else{
        
        $('.card-users-patient-register').removeClass('hide')
        $('.users-no-indentificate').addClass('hide')

        $('.users-no-indentificate input').val('');
        $('.users-no-indentificate select').val('');
        $('.users-no-indentificate textarea').attr('value', "")
    }

    query_fields()
}

$(document).on('click', '#identified_patient', function (e) {
    show_register_users()
    color_users_data()
})
show_register_users()

//forwarding
function forwarding() {
    let a = $('#forwarding').val()

    if(a == "y"){
        $('.card-forwarding').removeClass('hide')
    }else{
        $('.card-forwarding').addClass('hide')

        $('.card-forwarding input').val('');
        $('.card-forwarding select').val('');
    }
}
forwarding()

$(document).on('change', '#forwarding', function (e) {
    forwarding()
})

//cancel
$(document).on('click', '.cancel-emergency_services', function (e) {
    e.preventDefault()
    proceduresRefused($(this))
})

function proceduresRefused(a) {
    let title = a.attr('data-title')

    if(title == undefined){
        title = "RECUSAR"
    }

    let id = a.attr('data-id');
    modal_create(`Deseja ${title.toLowerCase()} o registro de codigo: <strong>${id}</strong>`, `
    
    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <div class="form-group">
                <label class="form-label" for="cancellation_justification_label">Motivo:</label>
                <textarea class="form-control form-control-sm" name="cancellation_justification" rows="3" required></textarea>
                <div class="valid-feedback">sucesso!</div>
            </div>
        </div>
    </div>`, a.attr('href'), 'danger', 40)
}