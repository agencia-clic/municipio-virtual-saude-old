$( "input[query]").on("blur", function(e) {
    let query = $(this).attr('query');
    if(query === "true"){
        zipcodeQuery(['address','district','city','uf'], $(this))
    }else{
        zipcodeQuery(query.split(","), $(this))
    }
});

function zipcodeQuery(a, b) {

    let zip = b.val().replace(/\D/g, '');
    if(zip != ""){
        let validate_zip = /^[0-9]{8}$/;

        if(validate_zip.test(zip)){

            set_fields(a,'...')
            $.getJSON(`//viacep.com.br/ws/${zip}/json/?callback=?`, function(data) {

                if (!("erro" in data)) {
                    set_fields([a[0]],data.logradouro.toUpperCase())
                    set_fields([a[1]],data.bairro.toUpperCase())
                    set_fields([a[2]],data.localidade.toUpperCase())
                    set_fields([a[3]],data.uf.toUpperCase())

                }else {
                    set_fields(a,'')
                    modal_info("ERRO", "CEP INVÁLIDO","POR FAVOR CORRIGIR.", "bg-warning")
                }
            })
            
        }else{
            modal_info("ERRO", "CEP VAZIO","POR FAVOR CORRIGIR.", "bg-warning")
        }
        
    }else{
        set_fields(a,'')
    }
}

function set_fields(a,b) {
    
    if(a.length > 0){
        a.forEach(element => {
            $(`input[name='${element}']`).val(b)
            $(`select[name='${element}']`).val(b)
        });
    }
}