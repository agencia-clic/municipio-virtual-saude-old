function list_cid() {

    let code = $('#code_filter').val()
    let title = $('#title_filter').val()
    let IdCid10MedicalCertificate = $('#IdCid10MedicalCertificate').val()

    if((code != undefined && title != undefined && IdCid10MedicalCertificate != undefined) && code.length > 0 || title.length > 0 || IdCid10MedicalCertificate.length > 0){

        request($('#IdCid10MedicalCertificate').attr('url-query'), {code:code, title:title, IdCid10:IdCid10MedicalCertificate}, function(res){
            res = JSON.parse(res)
            let data = ""

            if(res.length > 0){
                for(i in res){
                    data += `<option value='${res[i].IdCid10}'>${res[i].code} • ${res[i].title}</option>`
                }
            }else{
                data = '<option value="">...</option>'
            }
            
            $('#IdCid10MedicalCertificate').html(data)
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