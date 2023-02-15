$( ".flowcharts-save" ).change(function() {
    request($(this).attr('url'), {IdFlowcharts:$(this).val(), action:$(this).is(':checked')}, (res)=>{
        flowcharts_list()
    })
});

function flowcharts_list() {
    let url = $('#flowcharts-column').attr('url')
    request(url, {}, (res)=>{
        $('#flowcharts-column').html(res)
    })
}
flowcharts_list()

function save_form_items() {

    $('.kanban-items-save').each(function(index, value) {

        let IdFlowchartsServiceUnits = $(this).attr('data-IdFlowchartsServiceUnits');
        let IdFlowcharts = $(this).attr('data-IdFlowcharts');
        let html = "";

        $(`#${this.id} input`).each(function(index, value) {
            html += `<input type="hidden" name="IdUsers[${IdFlowcharts}][]" value="${IdFlowchartsServiceUnits},${$(this).val()}">`; 
        })

        $(`#IdFlowchartsServiceUnits-input-${IdFlowchartsServiceUnits}`).html(html)
    });

    $('#form').submit();
}