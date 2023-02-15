function list_procedures_groups() {

    let url = $('.procedures-group-list').attr('data-url')

    if(url != undefined){
        request(url, {}, function(res){
            $('.procedures-group-list').html(res)
        }, 'GET')
    }
}

list_procedures_groups()

$(document).on('click', '.procedures-button', function(){
    $(this).addClass('hide');
    let url = $('.procedures-group-list').attr('data-form')

    if(url != undefined){
        request(url, {}, function(res){
            $('.procedures-group-list').html(res)
        }, 'GET')
    }
})

$(document).on('click', '.procedures-button-voltar', function(){
    $(this).addClass('hide');
    $('.procedures-button').removeClass('hide')
    list_procedures_groups()
})