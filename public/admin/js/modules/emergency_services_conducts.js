//internação
function validate_conducts_internment() {

    if($('#admit_patient').is(':checked') && $('#patient_discharge').is(':checked') == false){

        $(`#admit-patient-check-request`).removeClass('hide')
        $('#admit-patient-check-request-message').addClass('hide')

        $(`#patient-discharge-check-request`).addClass('hide')
        $('#patient-discharge-check-request-message').removeClass('hide')
        $("#patient_discharge").prop( "checked", false)

        request($('#admit-patient-check-request').attr('url'), {}, function(res){
            $('#admit-patient-check-request').html(res)
        })

    }else if($('#admit_patient').is(':checked') && $('#patient_discharge').is(':checked')){
        $(`#admit-patient-check-request`).addClass('hide')
        $('#admit-patient-check-request-message').removeClass('hide')
        $("#admit_patient").prop( "checked", false)

        $('#admit-patient-check-request').html('')
    }else{

        if($('#observation').is(':checked') == false){
            $('#patient-discharge-check-request-message').addClass('hide')
        }

        $('#admit-patient-check-request').html('')
        $(`#admit-patient-check-request`).addClass('hide')
    }

}
validate_conducts_internment()

//internação
function validate_conducts_observation() {

    if($('#observation').is(':checked') && $('#patient_discharge').is(':checked') == false){

        $(`#observation-check-request`).removeClass('hide')
        $('#observation-check-request-message').addClass('hide')

        $(`#patient-discharge-check-request`).addClass('hide')
        $('#patient-discharge-check-request-message').removeClass('hide')

    }else if($('#observation').is(':checked') && $('#patient_discharge').is(':checked')){
        $(`#observation-check-request`).addClass('hide')
        $('#observation-check-request-message').removeClass('hide')
        $("#observation").prop( "checked", false)
    }else{

        if($('#admit_patient').is(':checked') == false){
            $('#patient-discharge-check-request-message').addClass('hide')
        }

        $(`#observation-check-request`).addClass('hide')
    }

}
validate_conducts_observation()

//alta
function validate_conducts_patient_discharge() {

    if($('#patient_discharge').is(':checked') && $('#observation').is(':checked') == false && $('#admit_patient').is(':checked') == false){

        $(`#patient-discharge-check-request`).removeClass('hide')
        $('#patient-discharge-check-request-message').addClass('hide')

        $(`#observation-check-request`).addClass('hide')
        $('#observation-check-request-message').removeClass('hide')

        $(`#admit-patient-check-request`).addClass('hide')
        $('#admit-patient-check-request-message').removeClass('hide')

    }else if($('#patient_discharge').is(':checked') && $('#observation').is(':checked') && $('#admit_patient').is(':checked')){
        $(`#patient-discharge-check-request`).addClass('hide')
        $('#patient-discharge-check-request-message').removeClass('hide')
        $("#patient_discharge").prop( "checked", false)
    }else{

        $('#observation-check-request-message').addClass('hide')
        $('#admit-patient-check-request-message').addClass('hide')

        $(`#patient-discharge-check-request`).addClass('hide')
    }

}
validate_conducts_patient_discharge()

function show_hide_conducts() {
    
    $('.check-request').each(function() {
        if($(this).is(':checked')){
            $(`#${$(this).val()}`).removeClass('hide')
        }else{
            $(`#${$(this).val()}`).addClass('hide')
        }
    });
}
show_hide_conducts()

$(document).on('change', '.check-request', function(){
    show_hide_conducts()
})


window.run_procedures = function(title, url, a){
    request(url, {}, function(res){
        modal_create(title, res, "", a, 50, `<button class="btn btn-${a}" id="procedures-save" type="button" data-bs-dismiss="modal">Salvar</button>`)
    })
}

$(document).on('click', '#procedures-save', function () {
    
    let date = `${$('#date_run').val()} ${$('#date_time_run').val()}`

    if($('#IdUsersResponsibleRunProcedures').val() == null){
        $('#IdUsersResponsibleRunProcedures').addClass('is-invalid')
        return 0;
    }

    if($('#date_run').val() == null){
        $('#date_run').addClass('is-invalid')
        return 0;
    }

    if($('#date_time_run').val() == null){
        $('#date_time_run').addClass('is-invalid')
        return 0;
    }

    request($('#route-save').attr('data-url'), {date:date, note_refused:$("#note_refused").val(), medical_report:$('#medical_report').val(), IdUsersResponsibleRunProcedures:$('#IdUsersResponsibleRunProcedures').val()}, function(res){
        $('#modal_create').modal('hide')
        $('#modal_create').remove();
        window.parent.iframe_modal.reload()
        reload()
    }, 'POST')
})


function checarData(data) {
    return data instanceof Date && !isNaN(data);
}

//check-request-save-transfer
function check_request_save_transfer() {

    if($('#unit_transfer').is(':checked')){
        $(`#${$('#unit_transfer').val()}`).removeClass('hide')
        $('#unit_transfer_reason_reason').prop('required', true)
    }else{
        $(`#${$('#unit_transfer').val()}`).addClass('hide')
        $('#unit_transfer_reason_reason').prop('required', false)
    }

}
check_request_save_transfer()

//comparison statement validade
function comparison_statement_validade() {

    if($('#declaration_presence_check').is(':checked')){
        $('#date_comparison_statement').prop('required', true)
        $('#date_time_comparison_statement').prop('required', true)
        $('#up_until_comparison_statement').prop('required', true)
        $('#note_comparison_statement').prop('required', true)
    }else{
        $('#date_comparison_statement').prop('required', false)
        $('#date_time_comparison_statement').prop('required', false)
        $('#up_until_comparison_statement').prop('required', false)
        $('#note_comparison_statement').prop('required', false)
    }
}
comparison_statement_validade();

//medical certificate validade
function medical_certificate_validade() {

    if($('#medical_certificate').is(':checked')){
        $('#date_medical_certificate').prop('required', true)
        $('#IdCid10').prop('required', true)
    }else{
        $('#date_medical_certificate').prop('required', false)
        $('#IdCid10').prop('required', false)
    }
}
medical_certificate_validade();

$(document).on("click",".save_form",function(e) {
    e.preventDefault()
    save_form_conduct()
})

function save_form_conduct() {
    let url = $('#form').attr('action');
    let form = $('#form')[0]
    let data = new FormData(form);

    $.ajax({
        url: url,
        method: 'POST',
        data: data,
        contentType: false, 
        processData: false,
        success: function(res) {
           
            modal_info("SUCESSO", '', 'Ação Realizada com sucesso.', 'bg-primary')

        },error: function (xmlHttpRequest, textStatus, errorThrown) {
           
            modal_info("ERRO", "ERRO AO TENTAR REALIZAR ESSA AÇÂO","POR FAVOR TENTE NOVAMENTE.", "bg-warning")
            
        }
    });
}