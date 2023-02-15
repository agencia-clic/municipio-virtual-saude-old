//list
function list_rooms() {
    
    $('#IdRooms').prop("disabled", true);

    let IdFunctionalUnits = $('#IdFunctionalUnits').val()
    let IdRooms = $('#IdRooms').val()

    if(IdFunctionalUnits != undefined && IdFunctionalUnits != null && IdFunctionalUnits != ''){

        request($('#IdRooms').attr('data-query'), {IdFunctionalUnits:IdFunctionalUnits, IdRooms:IdRooms}, function(res){

            if(res != 'error'){

                res = JSON.parse(res)
                let data = ""

                if(res.length > 0){
                    for(i in res){
                        data += `<option value='${res[i].IdRooms}'>${res[i].title}</option>`
                    }

                    $('#IdRooms').prop("disabled", false);
                }else{
                    data = '<option value="">...</option>'
                }
                
                $('#IdRooms').html(data) 
                list_rooms_beds()   
            }

        }, 'POST')

    }else{
        $('#IdRooms').html('<option value="">...</option>')   
    }
}
list_rooms()

//list
function list_rooms_beds() {
    
    $('#IdRoomsBeds_transfer').prop("disabled", true);

    let IdRooms = $('#IdRooms').val()
    let IdRoomsBeds = $('#IdRoomsBeds_transfer').val()

    if((IdRoomsBeds != undefined) && IdRooms != undefined && IdRooms != null && IdRooms != ''){

        request($('#IdRoomsBeds_transfer').attr('data-query'), {IdRooms:IdRooms, IdRoomsBeds:IdRoomsBeds}, function(res){

            if(res != 'error'){

                res = JSON.parse(res)
                let data = ""

                if(res.length > 0){
                    for(i in res){
                        data += `<option value='${res[i].IdRoomsBeds}'>${res[i].title}</option>`
                    }

                    $('#IdRoomsBeds_transfer').prop("disabled", false);
                }else{
                    data = '<option value="">...</option>'
                }
                
                $('#IdRoomsBeds_transfer').html(data)    
            }

        }, 'POST')

    }else{
        $('#IdRoomsBeds_transfer').html('<option value="">...</option>')   
    }
}