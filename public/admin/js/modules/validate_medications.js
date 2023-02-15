
function validate_medication() {

    let error = true;

    $('#users_diseases').addClass('hide')
    $('#users_diseases').html('')

    $('#brack_prescription').removeClass('is-invalid')
    $('#number_time_day').removeClass('is-invalid')
    $('#IdMedicationAdministrations').removeClass('is-invalid')
    $('#IdMedicationDilutions').removeClass('is-invalid')
    $('#prescription_guidance').removeClass('is-invalid')
    $('#IdMedicines').removeClass('is-invalid')

    //validate
    if(!$('#IdMedicationAdministrations_fields').hasClass('hide') && $('#IdMedicationAdministrations').val() && ($('#IdMedicationAdministrations').val() == null || $('#IdMedicationAdministrations').val() == "")){
        error = false;
        $('#IdMedicationAdministrations').addClass('is-invalid')
    }

    if(!$('#IdMedicationDilutions_fields').hasClass('hide') && ($('#IdMedicationDilutions').val() == null || $('#IdMedicationDilutions').val() == "")){
        error = false;
        $('#IdMedicationDilutions').addClass('is-invalid')
    }

    if($('#prescription_guidance').val() == null || $('#prescription_guidance').val() == ""){
        error = false;
        $('#prescription_guidance').addClass('is-invalid')
    }

    if($('#IdMedicines').val() == null || $('#IdMedicines').val() == ""){
        error = false;
        $('#IdMedicines').addClass('is-invalid')
    }

    if($('#amount_prescription').val() == null || $('#amount_prescription').val() == ""){
        error = false;
        $('#amount_prescription').addClass('is-invalid')
    }

    if($('input[name="type_prescription"]:checked').val() == "i" && ($('#brack_prescription').val() == "" || $('#brack_prescription').val() == null)){
        error = false;
        $('#brack_prescription').addClass('is-invalid')
    } 

    if($('input[name="type_prescription"]:checked').val() == "f" && ($('#number_time_day').val() == "" || $('#number_time_day').val() == null)){
        $('#number_time_day').addClass('is-invalid')
        error = false;
    }

    return error;
}

//reset fields
function reset_fields_medication() {
    
    $('#medication_fields').addClass('hide')

    $('#IdMedicines').html('<option value="">...</option>')
    $('#prescription_guidance').val('')
    $('#type_prescription_only').prop('checked', true)

    $('#title_medicines_filter').val('')

    $('#number_time_day_fields').addClass('hide')
    $('#brack_prescription_fields').addClass('hide')

    $('#number_time_day').val('')
    $('#brack_prescription').val('')
    $('#IdEmergencyServicesMedications').val('')

    $('#IdMedicationDilutions').html('<option value="">...</option>')
    $('#amount_prescription').val('')

    $('#infusao').html('<option value="">...</option>')

    $('#un_measure').val('')

    $('#IdMedicationAdministrations_fields').addClass('hide')
    $('#IdMedicationDilutions_fields').addClass('hide')
}