
//list medication_prescriptions
function list_medication_prescriptions(a = null) {

    let title = $('#title_medication_prescriptions_filter').val()
    let IdMedicationActivePrinciples = $('#IdMedicationActivePrinciples').val()

    if((title != undefined && IdMedicationActivePrinciples != undefined) && (title.length > 0 || IdMedicationActivePrinciples.length > 0)){

        request($('#IdMedicationActivePrinciples').attr('url-query'), {title:title, IdMedicationActivePrinciples:IdMedicationActivePrinciples}, function(res){
            if(res != "error"){
                res = JSON.parse(res)
                let data = ""

                if(res.length > 0){
                    for(i in res){

                        let a = ""
                        if(i == 0){
                            a = "selected" 
                        }
                        data += `<option value='${res[i].IdMedicationActivePrinciples}' ${a}>${res[i].title}</option>`
                    }
                }else{
                    data = '<option value="">...</option>'
                }
                
                $('#IdMedicationActivePrinciples').html(data)
                checked_IdMedicationActivePrinciples(a)
            }
        }, 'POST');
    }
}
list_medication_prescriptions()

$(document).on('keyup', '#title_medication_prescriptions_filter', function(){
    list_medication_prescriptions()
})

//show hide
function show_hide_allergies() {
    let a = $('#type_allergies').val()
    if(a == "m"){
        $('.medication_prescriptions-allergies').removeClass('hide')
        $('.text-allergies').addClass('hide')
    }else{
        $('.medication_prescriptions-allergies').addClass('hide')
        $('.text-allergies').removeClass('hide')
    }
}
show_hide_allergies()

$(document).on('change', '#type_allergies', function(){
    show_hide_allergies()
})