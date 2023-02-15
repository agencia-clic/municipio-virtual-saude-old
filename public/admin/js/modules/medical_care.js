function type() {
    let type = $("#type").val()

    if(type == "b"){

        $('.card-forwarding-attendance').addClass('hide')
        $('.card-forwarding-attendance select').val('');
        $('.card-forwarding-attendance textarea').val('')

        $('.card-discharge-reason').addClass('hide')
        $('.card-discharge-reason').val('')

    }else if(type == "r"){

        $('.card-forwarding-attendance').addClass('hide')
        $('.card-forwarding-attendance select').val('');
        $('.card-forwarding-attendance textarea').val('')

        $('.card-discharge-reason').removeClass('hide')

    }else{
        $('.card-forwarding-attendance').removeClass('hide')

        $('.card-discharge-reason').addClass('hide')
        $('.card-discharge-reason').val('')
    }
}
type()

$('#type').on('change', function(){
    type()
})