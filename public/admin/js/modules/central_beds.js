//responsavel
function usres_forward_filtes() {

    let name = $('#name_patient_filter').val()
    let cpf_cnpj = $('#cpf_cnpj_filter').val()
    let IdUsers = $('#IdUsers').val()

    if((name != undefined && IdUsers != undefined ) && (name.length > 0 || IdUsers.length > 0)){

        request($('#IdUsers').attr('url-query'), {cpf_cnpj:cpf_cnpj,name:name, IdUsersResponsible:IdUsers}, function(res){

            let data = ""

            if(res != 'error'){

                res = JSON.parse(res)

                if(res.length > 0){
                    for(i in res){

                        let a = ""
                        if(i == 0){
                            a = "selected"
                        }

                        data += `<option value='${res[i].IdUsers}' ${a}>${res[i].name}</option>`
                    }

                }else{
                    data = '<option value="">...</option>'
                }
            }else{
                data = '<option value="">...</option>'
            }
            
            $('#IdUsers').html(data)
            select_user()
        }, 'POST');

    }
}
usres_forward_filtes()

$(document).on('keyup', '#name_patient_filter', function(){
    usres_forward_filtes()
})

$(document).on('keyup', '#cpf_cnpj_filter', function(){
    usres_forward_filtes()
})

//select users solicitação
function select_user() {

    let IdUsers = $('#IdUsers :selected').val()
    $('#data-users').addClass('hide')
    $('#admission_request').addClass('hide')
    $('#IdAdmitPatientRequests').val('')

    if((IdUsers != undefined) && IdUsers.length > 0){

        request($('#IdUsers').attr('url-query'), {IdUsersResponsible:IdUsers, current:true}, function(res){

            if(res != 'error'){
                res = JSON.parse(res)
                if(Object.keys(res).length > 0){
                    $('#data-users').removeClass('hide')
                    $('#data-users').html(users_html(res))

                    request($('#admission_request').attr('url-query'), {IdUsers:res.IdUsers}, function(res){
                    
                        if(res != 'error'){
                            res = JSON.parse(res)
                            $('#IdAdmitPatientRequests').val(res.IdAdmitPatientRequests)
                            $('#admission_request').html(admission_request(res))
                            $('#admission_request').removeClass('hide')
                        }

                    }, 'POST')
                }
            }

        }, 'POST')        

    }
}

function users_html(data) {
 
    return `<div class="card-header">
        <div class="row flex-between-end">
            <div class="col-12 align-self-center">
                <h5>
                    <h6 class="alert-heading fw-semi-bold">
                        Paciente: ${data.name} • ${not_null(data['cpf_cnpj'], ' • ')}  ${not_null(data['date_birth'], ' ANOS ')} 
                    </h6>

                    <h6 class="alert-heading fw-semi-bold">
                        <span><strong>Endereço: ${not_null(data['address'], ' • ')} ${not_null(data['number'], ' • ')} ${not_null(data['complement'])} ${not_null(data['district'], ' • ')} ${not_null(data['city'], ' • ')} ${not_null(data['uf'])}</strong></span><br>
                    </h6>
                </h5>
            </div>
        </div>
    </div>`
}

//solicitação internação
function admission_request(data) {

    if(Object.keys(data).length > 0){

        return `
        <div class="card border mt-1 h-100 border-primary">
            <div class="card-header">
                <div class="row flex-between-end">
                    <div class="col-12 align-self-center">
                        <h5>
                            <h6 class="alert-heading fw-semi-bold">
                                Médico: ${data.responsible} ${data.specialty_responsible}
                            </h6>

                            <h6 class="alert-heading fw-semi-bold">
                                <span><strong>Solicitação: ${data.created_at}</strong></span>
                            </h6>

                            <h6 class="alert-heading fw-semi-bold">
                                <span><strong>Responsavel Aprovação: ${data.responsible_admit} ${data.specialty_admin_responsible} • ${data.updated_at}</strong></span>
                            </h6>
                        </h5>
                    </div>
                </div>
            </div>
        </div>`

    }else{

        return `
        <div class="card border mt-1 h-100 border-warning">
            <div class="card-header">
                <div class="row flex-between-end">
                    <div class="col-12 align-self-center">
                        <h5>
                            <h6 class="alert-heading fw-semi-bold">
                                Não há nenhuma solicitação de internação
                            </h6>
                        </h5>
                    </div>
                </div>
            </div>
        </div>`
    }
}

//cleaning-modal
function cleaning_modal(title, desc, color, url) {
    modal_info(title, '', desc, `bg-${color}`, `<button type="button" class="btn btn-${color}" onclick="cleaning_modal_request('${url}')">Sim</button>`)
}

//cleaning-modal-request
function cleaning_modal_request(url) {
    request(url, {}, function(res){
        modal_info("SUCESSO", '', `Registro deletado com sucesso.`, 'bg-primary')
        reload()
    }, 'POST')
}