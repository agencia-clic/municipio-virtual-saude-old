$('button[query-fields]').on('click', function(e){
    e.preventDefault();
    query_fields($(this), true);
})

function query_fields(a, b) {

    let data;
    let fields = a.attr('query-fields');
    let select = a.attr('select');
    let id = a.attr('data-id');

    if(b){
        data = fields_data(fields)
    }else{

        if(id){
            data = {id:id}
        }else{
            data = null;
        }
    }

    if(data){
        request(a.attr('url'), data, function(res){
            $(`#${select}`).html(res)
        }, 'POST');
    }
}
    
$('button[query-fields]').each(function( index ) {
    query_fields($(this), false);
});

function fields_data(a) {

    let data = {};
    a = a.split(',')
    a.forEach(element => {
        data[element] = $(`#${element}`).val()
    });

    return data;
}