//responsavel
function usres_run_filtes() {

    let name = $('#name_users_run_filter').val()
    let IdUsersResponsibleRunProcedures = $('#IdUsersResponsibleRunProcedures').val()

    if((name != undefined && IdUsersResponsibleRunProcedures != undefined) && (name.length > 0 || IdUsersResponsibleRunProcedures.length > 0)){

        request($('#IdUsersResponsibleRunProcedures').attr('url-query'), {name:name, IdUsersResponsibleRunProcedures:IdUsersResponsibleRunProcedures}, function(res){

            res = JSON.parse(res)
            let data = ""

            if(res.length > 0){
                for(i in res){
                    data += `<option value='${res[i].IdUsers}'>${res[i].name}</option>`
                }
            }else{
                data = '<option value="">...</option>'
            }
            
            $('#IdUsersResponsibleRunProcedures').html(data)
        }, 'POST');

    }
}
usres_run_filtes()

$(document).on('keyup', '#name_users_run_filter', function(){
    usres_run_filtes()
})