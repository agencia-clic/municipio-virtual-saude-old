window.medication_edite_check = function(title, url){
    request(url, {}, function(res){
        modal_create(title, res, "", 'primary', 70, `<button class="btn btn-primary btn-sm" onclick="update_medication_check()" type="button">Salvar</button>`)
    })
}

function update_medication_check() {

    let error = false;
    let action = $('input[name="action_type"]:checked').val()

    if(action == null || action == ''){
        $('input[name="action_type"]').addClass('is-invalid')
        error = true;
    }

    if((action != undefined) && action == 'f'){

        if($('#note_finalize').val() == null || $('#note_finalize').val() == ''){
            $('#note_finalize').addClass('is-invalid')
            error = true
        }
        
    }else if((action != undefined) && action == 'sm'){

        if(!validate_medication()){
            error = true
        }

    }else if((action != undefined) && action == 'aip'){

        if($('#schedule_date').val() == null || $('#schedule_date').val() == ''){
            $('#schedule_date').addClass('is-invalid')
            error = true
        }

        if($('#schedule_date_hour').val() == null || $('#schedule_date_hour').val() == ''){
            $('#schedule_date_hour').addClass('is-invalid')
            error = true
        }

    }else if((action != undefined) && action == 'pnm'){

        if($('#note_denied_medication').val() == null || $('#note_denied_medication').val() == ''){
            $('#note_denied_medication').addClass('is-invalid')
            error = true
        }
    }

    if(error){
        return 0;
    }

    request($('#send-form-medication').attr('data-url'), {
        action:action,
        schedule_date_hour:$('#schedule_date_hour').val(),
        schedule_date:$('#schedule_date').val(),
        note_denied_medication:$('#note_denied_medication').val(),
        note_finalize:$('#note_finalize').val(),
        note:$('#note_medication').val(), IdEmergencyServicesMedications:$('#IdEmergencyServicesMedications').val(), IdMedicines:$('#IdMedicines').val(), guidance:$('#prescription_guidance').val(), type:$('input[name="type_prescription"]:checked').val(), number_time_day:$('#number_time_day').val(), brack:$('#brack_prescription').val(), IdMedicationAdministrations:$('#IdMedicationAdministrations').val(), IdMedicationInfusao:$('#IdMedicationInfusao').val(), IdMedicationDilutions:$('#IdMedicationDilutions').val(), amount:$('#amount_prescription').val(), un_measure:$('#un_measure').val()
    }, function(res){

        window.top.frames['iframe_modal'].reload()
        reload()
        $('#modal_create').modal('hide')
        $('#modal_create').remove()

        if(res != null && res != ''){
            window.open(res,'_blank');
            window.open(res);
        }

    }, 'POST') 
}

//show hide type
function show_hide_action_medication() {
    
    reset_fields_medication()

    $('#reason_termination').addClass('hide')
    $('#schedule_start').addClass('hide')
    $('#denied_medication').addClass('hide')
    $('#replace_medication_card').addClass('hide')
    $('input[name="action_type"]').removeClass('is-invalid')

    let action = $('input[name="action_type"]:checked').val()

    if((action != undefined) && action == 'f'){

        $('#reason_termination').removeClass('hide')
        $('#schedule_start').addClass('hide')
        $('#denied_medication').addClass('hide')
        $('#replace_medication_card').addClass('hide')

    }else if((action != undefined) && action == 'mf'){

        $('#reason_termination').addClass('hide')
        $('#schedule_start').addClass('hide')
        $('#denied_medication').addClass('hide')
        $('#replace_medication_card').addClass('hide')

    }else if((action != undefined) && action == 'sm'){

        $('#reason_termination').addClass('hide')
        $('#schedule_start').addClass('hide')
        $('#denied_medication').addClass('hide')
        $('#replace_medication_card').removeClass('hide')

    }else if((action != undefined) && action == 'aip'){

        $('#reason_termination').addClass('hide')
        $('#schedule_start').removeClass('hide')
        $('#denied_medication').addClass('hide')
        $('#replace_medication_card').addClass('hide')

    }else if((action != undefined) && action == 'pnm'){

        $('#reason_termination').addClass('hide')
        $('#schedule_start').addClass('hide')
        $('#denied_medication').removeClass('hide')
        $('#replace_medication_card').addClass('hide')
    }
}
show_hide_action_medication()

$(document).on('change','input[name="action_type"]', function(e){
    e.preventDefault()
    show_hide_action_medication()
})