function list_procedures() {

    let code = $('#code_procedures_filter').val()
    let title = $('#title_procedures_filter').val()
    let IdProcedures = $('#IdProcedures').val()

    if((code != undefined && code.length > 0) || (title != undefined && title.length > 0) || (IdProcedures != undefined && IdProcedures.length > 0)){

        request($('#IdProcedures').attr('url-query'), {code:code, title:title, IdProcedures:IdProcedures}, function(res){

            $('#IdProcedures').removeClass('is-invalid')

            res = JSON.parse(res)
            let data = ""

            if(res.length > 0){
                for(i in res){
                    data += `<option value='${res[i].IdProcedures}'>${res[i].code} • ${res[i].title}</option>`
                }
            }else{
                data = '<option value="">...</option>'
            }
            
            $('#IdProcedures').html(data)
        });

    }
}
list_procedures()

//save
function save_procedures() {

    if($('#IdProcedures').val() == null || $('#IdProcedures').val() == ""){
        $('#IdProcedures').addClass('is-invalid')
        return 0;
    }

    request($('#send-form').attr('data-url'), {note:$('#note').val(), IdProcedures:$('#IdProcedures').val(), IdEmergencyServicesProcedures:$('#IdEmergencyServicesProcedures').val()}, function(res){

        if(res != null){
            res = JSON.parse(res)
        }

        $('#send-form').attr('data-url', res['create'])
        $('#table-list').attr('data-iframe', res['table'])

        $('#note').val('') 
        $('#IdProcedures').html('<option value="">...</option>')
        $('#code_procedures_filter').val('')
        $('#title_procedures_filter').val('')
        $('#IdEmergencyServicesProcedures').val('')

        reload()
        window.parent.reload_iframe()
    
    }, 'POST')
}

function editProcedures(url) {

    request(url, {}, function(res){

        if(res != 'error'){

            res = JSON.parse(res)

            $('#code_procedures_filter').val('')
            $('#title_procedures_filter').val('')
            $('#IdEmergencyServicesProcedures').val(res.IdEmergencyServicesProcedures)
            $('#note').val(res.note) 
            $('#IdProcedures').html(`<option value="${res.IdProcedures}">...</option>`)

            list_procedures()
        }

    }, 'POST')

}

$(document).on('keyup', '#code_procedures_filter', function(){
    list_procedures()
})

$(document).on('keyup', '#title_procedures_filter', function(){
    list_procedures()
})
reload()