
function list_materials() {

    let title = $('#title_materials_filter').val()
    let IdMaterials = $('#IdMaterials').val()

    if(title.length > 0 || IdMaterials.length > 0){

        request($('#IdMaterials').attr('url-query'), {title:title, IdMaterials:IdMaterials}, function(res){
            res = JSON.parse(res)
            let data = ""

            if(res.length > 0){
                for(i in res){
                    data += `<option value='${res[i].IdMaterials}'>${res[i].code} • ${res[i].title}</option>`
                }
            }else{
                data = '<option value="">...</option>'
            }
            
            $('#IdMaterials').html(data)
        });

    }
}
list_materials()

$(document).on('keyup', '#title_materials_filter', function(){
    list_materials()
})