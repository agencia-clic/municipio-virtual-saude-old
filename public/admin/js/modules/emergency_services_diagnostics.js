function list_cid() {

    let code = $('#code_filter').val()
    let title = $('#title_filter').val()
    let IdCid10 = $('#IdCid10').val()

    if((code != undefined && title != undefined && IdCid10 != undefined) && code.length > 0 || title.length > 0 || IdCid10.length > 0){

        request($('#IdCid10').attr('url-query'), {code:code, title:title, IdCid10:IdCid10}, function(res){
            res = JSON.parse(res)
            let data = ""

            if(res.length > 0){
                for(i in res){
                    data += `<option value='${res[i].IdCid10}'>${res[i].code} • ${res[i].title}</option>`
                }
            }else{
                data = '<option value="">...</option>'
            }
            
            $('#IdCid10').html(data)
        });

    }
}
list_cid()

$(document).on('keyup', '#code_filter', function(){
    list_cid()
})

$(document).on('keyup', '#title_filter', function(){
    list_cid()
})