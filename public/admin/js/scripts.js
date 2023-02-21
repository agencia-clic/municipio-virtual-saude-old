// show hide
$('[data-show]').each(function() {
    show_hide($(this))
});

function show_hide(b) {
    let a = b.attr('data-show')
    let p = b.attr('data-class')
    let c =  b.val()
    a = a.split(',')
    p = p.split(',')

    if(p && a[0] != undefined){

        if(a[0] == c){
            $(p[0]).removeClass('hide')

            if(p[1] != undefined){
                $(p[1]).addClass('hide')
            }

        }else if(a[1] == c){
            $(p[0]).addClass('hide')

            if(p[1] != undefined){
                $(p[1]).removeClass('hide')
            }
        }else{
            $(p[0]).addClass('hide')
            if(p[1] != undefined){
                $(p[1]).addClass('hide')
            }
        }
    }
}

$(document).on('change', '[data-show]', function(){
    show_hide($(this))
})

function zero(x) {
    if (x < 10) {
        x = '0' + x;
    } return x;
}

//call-attendance
$( "#call-attendance" ).on( "click", function(e) {
    e.preventDefault()
    let a = localStorage.getItem('room_call')
    modal_call(a, $('#call-attendance').attr('href')) 
});

//call save
$(document).on("click", "#save-call", function() {
    let a = $('#room_call').val()
    let b = $('#room_call :selected').text()

    if(a != null && room_call != ""){
        localStorage.setItem('room_call', a)
        localStorage.setItem('room_call_text', b)
    }
});

//call save attendance
$(document).on("click", ".call-save-attendance", function(e) {
    e.preventDefault()

    let a = localStorage.getItem('room_call')
    if(a == null){
        a = ""
        modal_call(a, $('#call-attendance').attr('href'))
    }else{
        modal_iframe("Registros de Chamadas", $(this).attr('href'), `<button type="button" class="btn btn-primary call-save-modal" data-url='${$(this).attr('href')}' data-bs-dismiss="modal">Chamar</button>`)
    }
});

//call save attendance modal
$(document).on("click", ".call-save-modal", function(e) {
    e.preventDefault()

    let a = localStorage.getItem('room_call_text')
    if(a == null){
        a = ""
        modal_call(a, $('#call-attendance').attr('href'))
    }else{

        request($(this).attr('data-url'), {sala:a}, function(res){}, 'POST')
        modal_info("SUCESSO", 'Ação realizada com sucesso.', '', 'bg-primary')
    }
});

//modal
function modal_call(a, url) {

    html = ""
    request(url, {}, function(res){
        
        if(res != null && res != ""){

            console.log(res)

            res = JSON.parse(res)
            $.each(res, function( key, value ) {

                d = ""
                if(a == value.IdCallPanel){
                    d = "selected"
                }

                html += `<option value="${value.IdCallPanel}" ${d}>${value.title}</option>`
            });
        }

        modal_info("Tela de Atendimento", '', `
            <div id="room_call_fields" class="form-group">
                <label for="room_call" id="label_room_call" class="label_room_call">Status:</label>
                <select id="room_call" class="form-control form-control-sm">${html}</select>
            </div>
        `, 'bg-primary', `<button class="btn btn-primary" id="save-call" type="button" data-bs-dismiss="modal">Salvar</button>`)

    })
}

document.addEventListener("DOMContentLoaded", function(){
    if (window.innerWidth < 992) {
      document.querySelectorAll('.navbar .dropdown').forEach(function(everydropdown){
        everydropdown.addEventListener('hidden.bs.dropdown', function () {
            this.querySelectorAll('.submenu').forEach(function(everysubmenu){
                everysubmenu.style.display = 'none';
            });
        })
      });
      document.querySelectorAll('.dropdown-menu a').forEach(function(element){
        element.addEventListener('click', function (e) {
            let nextEl = this.nextElementSibling;
            if(nextEl && nextEl.classList.contains('submenu')) {	
              // prevent opening link if link needs to open dropdown
              e.preventDefault();
              if(nextEl.style.display == 'block'){
                nextEl.style.display = 'none';
              } else {
                nextEl.style.display = 'block';
              }
    
            }
        });
      })
    }
})

//online - offline
Echo.join(`users-online.${$('body').attr('data-id')}`).here(function (user) {

    if(user != null && $('body').attr('data-id') != null){
        user = user[0]
        axios.put(`/api/user/${user.IdUsers}/online?api_token=${user.api_token}`, {});

        window.addEventListener("beforeunload", function(event) {
            axios.put(`/api/user/${user.IdUsers}/offline?api_token=${user.api_token}`, {});
        })
    }
});

//active atendimento
function activeControlToggle() {
    let a = $('#activeControlToggle').is(':checked');

    if(a){
        axios.put(`/api/user/${$('body').attr('IdUsers')}/active-attendance?api_token=${$('body').attr('token')}&type=a`, {}).then(function (response) {
            if(typeof list == "function") {
                list()
            }
        })
    }else{
        axios.put(`/api/user/${$('body').attr('IdUsers')}/active-attendance?api_token=${$('body').attr('token')}&type=b`, {}).then(function (response) {
            if(typeof list == "function") {
                list()
            }
        })
    }
}

$(document).on('mouseover', '.data-view', function(){
    $(this).find(".title").addClass('hide');
    $(this).find(".description").removeClass('hide');
})

$(document).on('mouseleave', '.data-view', function(){
    $(this).find(".description").addClass('hide');
    $(this).find(".title").removeClass('hide');
})

$(document).on('click', 'button[data-redirect]', function(){

    let a = '_self'

    if($(this).attr('target')){
        a = $(this).attr('target')
    }

    window.open($(this).attr('data-redirect'), a);
})

//redirect new-tab
function new_tab(a) {
    if(a){
        let json = JSON.parse(a)
        json.forEach(val => {
            window.open(val, '_blank');
        });
    }
}

$(document).on('click', '.modal-print-option', function(e){
    e.preventDefault()

    let html = `<option value="">Todos</option>`
    let data = $(this).attr('data-option')

    if(data != null && data != ''){
        data = JSON.parse(data)
        data.forEach(val => {
            html += `<option value="${val.value}">${val.option}</option>`
        });
    }

    modal_info($(this).attr('title'), '', `
        <div id="modal_print_fields" class="form-group mt-0">
            <label for="modal_print" id="label_modal_print" class="label_modal_print">Tipo:</label>
            <select id="modal_print" class="form-control form-control-sm">${html}</select>
        </div>
    `, 'bg-primary', `<button class="btn btn-primary" id="save-call" onclick="redirect_print('${$(this).attr('data-url')}')" type="button" data-bs-dismiss="modal">Avançar</button>`)
})

function redirect_print(url) {
    window.open(url+'?type='+$('#modal_print').val(), '_blank');
}

$('input').on('input', function() {
    if (!$(this).is('[data-no-uppercase]')) {
      this.value = this.value.toUpperCase();
    }
});