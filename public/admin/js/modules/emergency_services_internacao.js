//internação
function list_cid_main_cid10() {

    let code = $('#code_main_filter').val()
    let title = $('#cid10_main_filter').val()
    let IdCid10Main = $('#IdCid10Main').val()

    if(code.length > 0 || title.length > 0 || IdCid10Main.length > 0){

        request($('#IdCid10Main').attr('url-query'), {code:code, title:title, IdCid10:IdCid10Main}, function(res){
            res = JSON.parse(res)
            let data = ""

            if(res.length > 0){
                for(i in res){
                    data += `<option value='${res[i].IdCid10}'>${res[i].code} • ${res[i].title}</option>`
                }
            }else{
                data = '<option value="">...</option>'
            }
            
            $('#IdCid10Main').html(data)
        });

    }
}
list_cid_main_cid10()

$(document).on('keyup', '#code_main_filter', function(){
    list_cid_main_cid10()
})

$(document).on('keyup', '#cid10_main_filter', function(){
    list_cid_main_cid10()
})

//secundario
function list_cid_secondary_cid10() {

    let code = $('#code_secondary_filter').val()
    let title = $('#cid10_secondary_filter').val()
    let IdCid10Secondary = $('#IdCid10Secondary').val()

    if(code.length > 0 || title.length > 0 || IdCid10Secondary.length > 0){

        request($('#IdCid10Secondary').attr('url-query'), {code:code, title:title, IdCid10:IdCid10Secondary}, function(res){
            res = JSON.parse(res)
            let data = ""

            if(res.length > 0){
                for(i in res){
                    data += `<option value='${res[i].IdCid10}'>${res[i].code} • ${res[i].title}</option>`
                }
            }else{
                data = '<option value="">...</option>'
            }
            
            $('#IdCid10Secondary').html(data)
        });

    }
}
list_cid_secondary_cid10()

$(document).on('keyup', '#code_secondary_filter', function(){
    list_cid_secondary_cid10()
})

$(document).on('keyup', '#cid10_secondary_filter', function(){
    list_cid_secondary_cid10()
})

//associated_causes
function list_cid_associated_causes_cid10() {

    let code = $('#code_associated_causes_filter').val()
    let title = $('#cid10_associated_causes_filter').val()
    let IdCid10AssociatedCauses = $('#IdCid10AssociatedCauses').val()

    if(code.length > 0 || title.length > 0 || IdCid10AssociatedCauses.length > 0){

        request($('#IdCid10AssociatedCauses').attr('url-query'), {code:code, title:title, IdCid10:IdCid10AssociatedCauses}, function(res){
            res = JSON.parse(res)
            let data = ""

            if(res.length > 0){
                for(i in res){
                    data += `<option value='${res[i].IdCid10}'>${res[i].code} • ${res[i].title}</option>`
                }
            }else{
                data = '<option value="">...</option>'
            }
            
            $('#IdCid10AssociatedCauses').html(data)
        });

    }
}
list_cid_associated_causes_cid10()

$(document).on('keyup', '#code_associated_causes_filter', function(){
    list_cid_associated_causes_cid10()
})

$(document).on('keyup', '#cid10_associated_causes_filter', function(){
    list_cid_associated_causes_cid10()
})

//responsavel
function usres_internment_filtes() {

    let name = $('#name_users_internment_filter').val()
    let IdUsersResponsibleInternment = $('#IdUsersResponsibleInternment').val()

    if(name.length > 0 || IdUsersResponsibleInternment.length > 0){

        request((name != undefined && IdUsersResponsibleInternment != undefined ) && $('#IdUsersResponsibleInternment').attr('url-query'), {name:name, IdUsersResponsible:IdUsersResponsibleInternment}, function(res){

            res = JSON.parse(res)
            let data = ""

            if(res.length > 0){
                for(i in res){
                    data += `<option value='${res[i].IdUsers}'>${res[i].name}</option>`
                }
            }else{
                data = '<option value="">...</option>'
            }
            
            $('#IdUsersResponsibleInternment').html(data)
        }, 'POST');

    }
}
usres_internment_filtes()

$(document).on('keyup', '#name_users_internment_filter', function(){
    usres_internment_filtes()
})