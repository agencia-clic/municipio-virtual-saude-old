
function modal_info(a,b, c, d, button = '', p = "", e = "",) {
    
    let html = `<div class="modal fade" id="modal_info" tabindex="-1" aria-labelledby="tooltippopoversLabel" aria-hidden="true" ${e}>
    <div class="modal-dialog mt-6" role="document">
            <div class="modal-content border-0">
                <div class="position-absolute top-0 end-0 mt-2 me-2 z-index-1">
                    <button class="btn-close btn btn-sm btn-circle d-flex flex-center transition-base" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body p-0">
                    <div class="${d} rounded-top-lg py-3 ps-3 pe-6">
                        <h5 class="mb-1 text-light" id="tooltippopoversLabel">${a}</h5>
                    </div>
                    <div class="p-3 pb-0">
                        <div class="row">
                            <div class="col">
                                <h6 class="text-secondary">${b}</h6>
                                <p class="text-secondary">${c}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    ${button}
                    <button class="btn btn-secondary btn-sm" type="button" data-bs-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>`;

    $('#modal_info').modal('hide')
    $('#modal_info').remove();
    $("#top").append(html);
    $('#modal_info').modal('show')
}

function modal_create(a,b,r,c='primary', d=60, button = `<button class="btn btn-${c}" type="submit" data-bs-dismiss="modal">Salvar</button>`) {
    
    let html = `<div class="modal fade" id="modal_create" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: ${d}%">
            <div class="modal-content position-relative">
                <div class="position-absolute top-0 end-0 mt-2 me-2 z-index-1">
                    <button class="btn-close btn btn-sm btn-circle d-flex flex-center transition-base" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form class="needs-validation" id="form_modal" name="form_modal" method="POST" enctype="multipart/form-data" action="${r}" novalidate="">
                    <div class="modal-body p-0">
                        <div class="rounded-top-lg py-3 ps-4 pe-6 bg-${c}">
                            <h5 class="mb-1 text-light" id="modal_create_label">${a}</h5>
                        </div>
                        <div class="p-4 mb-2 pb-0">${b}</div>
                    </div>
                    <div class="modal-footer mt-2">
                        <button class="btn btn-secondary btn-sm" type="button" data-bs-dismiss="modal">Fechar</button>
                        ${button}
                    </div>
                </form>

            </div>
        </div>
    </div>`;

    $('#modal_create').modal('hide')
    $('#modal_create').remove()
    $("#top").append(html);
    $('#modal_create').modal('show')
}

function modal_iframe(a, url, button) {
    
    let html = `<div class="modal fade" id="modal_iframe" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 90%; max-height: 90%;">
            <div class="modal-content position-relative">
                <div class="position-absolute top-0 end-0 mt-2 me-2 z-index-1">
                    <button class="btn-close btn btn-sm btn-circle d-flex flex-center transition-base" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body p-0">
                    <div class="rounded-top-lg py-3 ps-4 pe-6 bg-primary">
                        <h5 class="mb-1 text-light" id="modal_iframe_label">${a}</h5>
                    </div>
                    <div class="p-4 mb-2 pb-0 container_iframe">
                        <iframe class="responsive-iframe" name="iframe_modal" id="iframe_modal" src="${url}"></iframe>
                    </div>
                </div>
                
                <div class="modal-footer mt-2">
                    ${button}
                    <button class="btn btn-secondary btn-sm" type="button" data-bs-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>`;

    $('#modal_iframe').modal('hide')
    $('#modal_iframe').remove();
    $("#top").append(html);
    $('#modal_iframe').modal('show')
}

window.close_modal = function(id){
    $(id).modal('hide')
    $(id).remove();
};

function inject_css(a, b) {
    $("<style></style>").appendTo("head").html(a);
}

//modal info
$(document).on('click', 'a[moda-alert]', function(e){

    e.preventDefault()
    let button;
    let modal = $('a[moda-alert]').attr('moda-alert')
    let url = $(this).attr('href')
    modal = modal.split(",")
    

    if(url){
        button = `<a href='${url}'><button class="btn btn-info submit-form-iframe" type="button">Sim</button></a>`
    }

    modal_info(modal[0], '', modal[1], 'bg-primary', button)
})