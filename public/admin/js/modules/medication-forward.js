//procedimentos
function procedures_filtes() {

    let title = $('#title_procedures_filter').val()
    let IdProceduresForward = $('#IdProceduresForward').val()

    if(title.length > 0 || IdProceduresForward.length > 0){

        request($('#IdProceduresForward').attr('url-query'), {title:title, IdProceduresForward:IdProceduresForward}, function(res){

            res = JSON.parse(res)
            let data = ""

            if(res.length > 0){
                for(i in res){
                    data += `<option value='${res[i].IdProcedures}'>${res[i].code} • ${res[i].title}</option>`
                }
            }else{
                data = '<option value="">...</option>'
            }
            
            $('#IdProceduresForward').html(data)
        }, 'GET');

    }
}
procedures_filtes()

$(document).on('keyup', '#title_procedures_filter', function(){
    procedures_filtes()
})

//categoria
function categories_filtes() {

    let title = $('#title_categories_filter').val()
    let IdSpecialtyCategories = $('#IdSpecialtyCategories').val()

    if(title.length > 0 || IdSpecialtyCategories.length > 0){

        request($('#IdSpecialtyCategories').attr('url-query'), {title:title, IdSpecialtyCategories:IdSpecialtyCategories}, function(res){

            res = JSON.parse(res)
            let data = ""

            if(res.length > 0){
                for(i in res){
                    data += `<option value='${res[i].IdSpecialtyCategories}'>${res[i].title} • ${res[i].categorie}</option>`
                }
            }else{
                data = '<option value="">...</option>'
            }
            
            $('#IdSpecialtyCategories').html(data)
        }, 'GET');

    }
}
categories_filtes()

$(document).on('keyup', '#title_categories_filter', function(){
    categories_filtes()
})