function check_procedures(title, url) {
    modal_iframe(title, url, ``)
}


$(document).on('click', '#save-medication-check', function(){

    let data = []
    let url = $(this).attr('data-url')

    $('.check-medication:checked').each(function(index) {
        data.push($(this).val())
    })

    if(data.length > 0){
        
        request(url, {IdEmergencyServicesMedications:data}, function(res){
            window.top.frames['iframe_modal'].reload()
            reload()
            window.parent.delete_modal_success()
        }, 'POST')
    }
    
    reload()
})