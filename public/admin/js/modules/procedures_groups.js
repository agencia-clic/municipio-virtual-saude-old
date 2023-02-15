$(document).on("click",'.procedures-button', function(e) {
    modal_iframe($(this).attr('title'), $(this).attr('data-url'), `<button class="btn btn-primary submit-form-iframe" type="button">Salvar</button>`)
})

$(document).on("click",'.procedures-run-button', function(e) {
    modal_iframe($(this).attr('title'), $(this).attr('data-url'), ``)
})