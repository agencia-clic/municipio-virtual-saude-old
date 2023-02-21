$(document).on("click",'button[data-iframe]', function(e) {
    modal_iframe($(this).attr('iframe-title'), $(this).attr('url'), `<button class="btn btn-primary btn-sm submit-form-iframe" type="button">Salvar</button>`)
})

$(document).on('click', ".submit-form-iframe", function(e) {
    $("iframe[class='responsive-iframe']").contents().find("#send-form").click()
})