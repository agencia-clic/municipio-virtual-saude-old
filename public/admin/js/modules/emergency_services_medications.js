function show_hide_type() {

    if($('input[name="type_prescription"]:checked').val() != undefined ){

        if($('input[name="type_prescription"]:checked').val() == "u"){

            $('#number_time_day_fields').addClass('hide')
            $('#brack_prescription_fields').addClass('hide')

        }else if($('input[name="type_prescription"]:checked').val() == "i"){

            $('#number_time_day_fields').addClass('hide')
            $('#brack_prescription_fields').removeClass('hide')

        }else{
            $('#number_time_day_fields').removeClass('hide')
            $('#brack_prescription_fields').addClass('hide')
        }

    }
    
}
show_hide_type()

$(document).on('change', 'input[name="type_prescription"]', function(){
    show_hide_type()
})

//list medicamentos
function list_medicines(a = null) {

    let title = $('#title_medicines_filter').val()
    let IdMedicines = $('#IdMedicines').val()

    if(title.length > 0 || IdMedicines.length > 0){

        request($('#IdMedicines').attr('url-query'), {title:title, IdMedicines:IdMedicines}, function(res){
            if(res != "error"){
                res = JSON.parse(res)
                let data = ""

                if(res.length > 0){
                    for(i in res){

                        let a = ""
                        if(i == 0){
                            a = "selected" 
                        }
                        data += `<option value='${res[i].IdMedicines}' ${a}>${res[i].title} • ${res[i].units}</option>`
                    }
                }else{
                    data = '<option value="">...</option>'
                }
                
                $('#IdMedicines').html(data)
                checked_medicines(a)
            }
        }, 'POST');
    }
}
list_medicines()

$(document).on('keyup', '#title_medicines_filter', function(){
    list_medicines()
})

//verifi check
function checked_medicines(a) {
    
    $('#IdMedicationAdministrations_fields').addClass('hide')
    $('#IdMedicationDilutions_fields').addClass('hide')

    $('#users_diseases').addClass('hide')
    $('#users_diseases').html('')

    if($('#IdMedicines option').filter(':selected').val() != null && $('#IdMedicines option').filter(':selected').val() != ""){
        
        request($('#IdMedicines').attr('data-select'), {IdMedicines:$('#IdMedicines option').filter(':selected').val()}, function(res){

            if(res != 'error'){

                res = JSON.parse(res)

                if(res['medication_administrations'] != null){
                    $('#IdMedicationAdministrations').html(option_select(res['medication_administrations'], 'IdMedicationAdministrations'));
                    $('#IdMedicationAdministrations_fields').removeClass('hide')
                }

                if(res['medication_dilutions'] != null){
                    $('#IdMedicationDilutions').html(option_select(res['medication_dilutions'], 'IdMedicationDilutions'));
                    $('#IdMedicationDilutions_fields').removeClass('hide')
                }

                if(a != null){
                    $('#IdMedicationAdministrations').val(a.IdMedicationAdministrations)
                    $('#IdMedicationDilutions').val(a.IdMedicationDilutions)
                    $('#infusao').val()
                    show_hide_type()
                }

                if(res['users_diseases']){
                    $('#users_diseases').removeClass('hide')
                    $('#users_diseases').html(res.users_diseases)
                }

                $('#medication_fields').removeClass('hide')
            }

        }, 'POST')

    }
}

$(document).on('change', '#IdMedicines', function(){
    checked_medicines()
})

function option_select(res, id) {
    let data = ""

    if(res.length > 0){
        for(i in res){

            let a = ""
            if(i == 0){
                a = "selected" 
            }
            data += `<option value='${res[i][`${id}`]}' ${a}>${res[i].title}</option>`
        }
    }else{
        data = '<option value="">...</option>'
    }

    return data;
}

//save medicines
function save_medicines() {

    let error = true

    console.log("rfffw")
    
    if(!validate_medication()){
        error = false
    }

    if(error == false){
        save_update_note()
        return 0;
    }

    //save
    request($('#send-form').attr('data-url'), {note:$('#note_medication').val(), IdEmergencyServicesMedications:$('#IdEmergencyServicesMedications').val(), IdMedicines:$('#IdMedicines').val(), guidance:$('#prescription_guidance').val(), type:$('input[name="type_prescription"]:checked').val(), number_time_day:$('#number_time_day').val(), brack:$('#brack_prescription').val(), IdMedicationAdministrations:$('#IdMedicationAdministrations').val(), infusao:$('#infusao').val(), IdMedicationDilutions:$('#IdMedicationDilutions').val(), amount:$('#amount_prescription').val(), un_measure:$('#un_measure').val()}, function(res){

        if(res != 'error'){
            res = JSON.parse(res)
        }

        $('#send-form').attr('data-url', res['create'])
        $('#table-list').attr('data-iframe', res['table'])
        $('#medication_fields').addClass('hide')

        reload()
        window.parent.reload_iframe()
        reset_fields_medication()
    
    }, 'POST')

}

//save note
function save_update_note() {
    request($('#send-form').attr('data-url'), {note:$('#note_medication').val()}, function (res) {
        window.parent.reload_iframe()
    }, 'POST')
}

//edit medications
function editMedications(url) {
    
    request(url, {}, function (res) {

        if(res != "error"){

            reset_fields_medication()
            res = JSON.parse(res)
            $('#title_medicines_filter').val('')
            $('#IdEmergencyServicesMedications').val(res.IdEmergencyServicesMedications)

            $('#number_time_day').val(res.number_time_day)
            $('#brack_prescription').val(res.break)
            $('#prescription_guidance').val(res.guidance)
            $('#amount_prescription').val(res.amount)
            $('#un_measure').val(res.un_measure)
            $('#type_prescription_only').prop('checked', true)

            if(res.type == "i"){
                $('#type_prescription_break').prop('checked', true)
            }else if(res.type = "f"){
                $('#type_prescription_frequency').prop('checked', true)
            }

            $('#IdMedicines').html(`<option value="${res.IdMedicines}" selected>...</option>`)
            list_medicines(res)
        }


    }, 'POST')
}

function delete_run(url, id, del) {
    $(`#${del}`).remove()
    request(url, {}, function(res){
        modal_info("SUCESSO", '', `Registro deletado com sucesso.`, 'bg-primary')
        reload()
    }, 'POST');
}