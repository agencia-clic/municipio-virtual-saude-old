//responsavel
function usres_forward_filtes() {

    let name = $('#name_users_filter').val()
    let IdUsersResponsible = $('#IdUsersResponsible').val()

    if((name != undefined && IdUsersResponsibleInternment != undefined ) && (name.length > 0 || IdUsersResponsible.length > 0)){

        request($('#IdUsersResponsible').attr('url-query'), {name:name, IdUsersResponsible:IdUsersResponsible}, function(res){

            res = JSON.parse(res)
            let data = ""

            if(res.length > 0){
                for(i in res){
                    data += `<option value='${res[i].IdUsers}'>${res[i].name}</option>`
                }
            }else{
                data = '<option value="">...</option>'
            }
            
            $('#IdUsersResponsible').html(data)
        }, 'POST');

    }
}
usres_forward_filtes()

$(document).on('keyup', '#name_users_filter', function(){
    usres_forward_filtes()
})