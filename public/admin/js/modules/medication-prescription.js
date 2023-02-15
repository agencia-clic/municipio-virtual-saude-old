function list_medication_prescription() {

    let title = $('#title_medication_prescription_filter').val()
    let IdMedicationPrescription = $('#IdMedicationPrescription').val()

    if(title.length > 0 || IdMedicationPrescription.length > 0){

        $('#title_medication_prescription_filter').removeClass('is-invalid')

        request($('#IdMedicationPrescription').attr('url-query'), {title:title, IdMedicationPrescription:IdMedicationPrescription}, function(res){
            res = JSON.parse(res)
            let data = ""

            if(res.length > 0){
                for(i in res){
                    data += `<option value='${res[i].IdMedicationPrescriptions}'>${res[i].title}</option>`
                }
            }else{
                data = '<option value="">...</option>'
            }
            
            $('#IdMedicationPrescription').html(data)
        });

    }
}

list_medication_prescription()

$(document).on('keyup', '#title_medication_prescription_filter', function(){
    list_medication_prescription()
})

$(document).on('click', '.button-medication-save', function(){

    let title = $('#title_medication_prescription_filter').val()

    if(title.length > 0){

        request($(this).attr('url'), {title:title}, function(res){
           
            list_medication_prescription()

            if(res != "success"){
                $('#title_medication_prescription_filter').addClass('is-invalid')
            }
        })
    }else{
        $('#title_medication_prescription_filter').addClass('is-invalid')
    }
})

//units filter
function list_units_medication_prescription() {

    let title = $('#title_medication_units_filter').val()
    let IdMedicationUnits = $('#IdMedicationUnits').val()

    if(title.length > 0 || IdMedicationUnits.length > 0){

        request($('#IdMedicationUnits').attr('url-query'), {title:title, IdMedicationUnits:IdMedicationUnits}, function(res){
            res = JSON.parse(res)
            let data = ""

            if(res.length > 0){
                for(i in res){
                    data += `<option value='${res[i].IdMedicationUnits}'>${res[i].title}</option>`
                }
            }else{
                data = '<option value="">...</option>'
            }
            
            $('#IdMedicationUnits').html(data)
        });
    }
}

list_units_medication_prescription()

$(document).on('keyup', '#title_medication_units_filter', function(){
    list_units_medication_prescription()
})

//administrations filter
function list_administrations_medication_prescription() {

    let title = $('#title_medication_administrations_filter').val()
    let IdMedicationAdministrations = $('#IdMedicationAdministrations').val()

    if(title.length > 0 || IdMedicationAdministrations.length > 0){

        request($('#IdMedicationAdministrations').attr('url-query'), {title:title, IdMedicationAdministrations:IdMedicationAdministrations}, function(res){
            res = JSON.parse(res)
            let data = ""

            if(res.length > 0){
                for(i in res){
                    data += `<option value='${res[i].IdMedicationAdministrations}'>${res[i].title}</option>`
                }
            }else{
                data = '<option value="">...</option>'
            }
            
            $('#IdMedicationAdministrations').html(data)
        });
    }
}

list_administrations_medication_prescription()

$(document).on('keyup', '#title_medication_administrations_filter', function(){
    list_administrations_medication_prescription()
})