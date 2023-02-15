function request(url, data, callback, method = "GET", a="") {
    
    if(!data._token){
        data._token = $("input[name='_token']").val();
    }

    $.ajax({
        url: url,
        method: method,
        data: data,
        success: function(data) {
            callback(data);
        },error: function (xmlHttpRequest, textStatus, errorThrown) {
            callback('error');
        }
    }, a);
}

function not_null(a, b = "", c = "") {

    if(a != undefined && a != null){
        return `${a}${b}${c}`
    }

    return "";
}