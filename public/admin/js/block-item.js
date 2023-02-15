function block_item() {
    $('.block-item-class').hide()
    $(".kanban-item.shadow-sm.active").each(function() {
        $(`.${$(this).attr('data-class')}`).show()
    });

    validate_form()
}
block_item()

$(document).on('click', '.kanban-item.shadow-sm', function(){
    $('.kanban-item.shadow-sm').removeClass('active')
    localStorage.setItem('block-item-select', $(this).attr('data-class'))
    $(this).addClass('active')
    block_item()
});

//validate
function validate_form(){
    $(".kanban-item.shadow-sm").each(function() {
        //validate
        $(this).removeClass('kanban-item-invalid')
        let a = $(`.${$(this).attr('data-class')} .is-invalid`)
        if(a.length > 0){
            $(this).addClass('kanban-item-invalid')
        }
    });
}