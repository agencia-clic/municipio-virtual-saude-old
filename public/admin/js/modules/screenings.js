$('#temperature').priceFormat({
    prefix: '',
    centsSeparator: ',',
    thousandsSeparator: '.'
})

$('#weight').priceFormat({
    prefix: '',
    centsSeparator: ',',
    thousandsSeparator: '.'
})

$('#heart_rate').priceFormat({
    prefix: '',
    centsSeparator: ',',
    thousandsSeparator: '.'
})

$('#height').priceFormat({
    prefix: '',
    centsSeparator: ',',
    thousandsSeparator: '.'
})

$('#respiratory_frequency').priceFormat({
    prefix: '',
    centsSeparator: ',',
    thousandsSeparator: '.'
})

$('#O2_saturation').priceFormat({
    prefix: '',
    centsSeparator: ',',
    thousandsSeparator: '.'
})

$('#ecg').priceFormat({
    prefix: '',
    centsSeparator: ',',
    thousandsSeparator: '.'
})

$('#blood_glucose').priceFormat({
    prefix: '',
    centsSeparator: ',',
    thousandsSeparator: '.'
})

$('#gestational_age').priceFormat({
    prefix: '',
    centsSeparator: ',',
    thousandsSeparator: '.'
})

$("input[id='blood_pressure']").inputmask('99/99', { numericInput: true});

function scale_pain() {
    
    let pain = $('#rule_of_pain').val()
    let a = "rgba(26,380,50,255)";
    let text = `<span class="badge pain_zero">${pain}</span>`

    if(pain == 1){
        a = 'rgba(102,350,34,255)'
        text = `<span class="badge pain_one">${pain}</span>`
    }else if(pain == 2){
        a = 'rgba(126,320,13,255)'
        text = `<span class="badge pain_two">${pain}</span>`
    }else if(pain == 3){
        a = 'rgba(191,260,7,255)'
        text = `<span class="badge pain_three">${pain}</span>`
    }else if(pain == 4){
        a = 'rgba(255,230,1,255)'
        text = `<span class="badge pain_four">${pain}</span>`
    }else if(pain == 5){
        a = 'rgba(255,200,0,255)'
        text = `<span class="badge pain_five">${pain}</span>`
    }else if(pain == 6){
        a = 'rgba(254,153,0,255)'
        text = `<span class="badge pain_six">${pain}</span>`
    }else if(pain == 7){
        a = 'rgba(254,120,11,255)'
        text = `<span class="badge pain_seven">${pain}</span>`
    }else if(pain == 8){
        a = 'rgba(251,90,22,255)'
        text = `<span class="badge pain_eight">${pain}</span>`
    }else if(pain == 9){
        a = 'rgba(247,75,29,255)'
        text = `<span class="badge pain_nine">${pain}</span>`
    }else if(pain == 10){
        a = 'rgba(247,7,29,255)'
        text = `<span class="badge pain_ten">${pain}</span>`
    }

    $("label[for='rule_of_pain'] span").html(text)
    inject_css(`#rule_of_pain::-webkit-slider-thumb {-webkit-appearance: none; border: 3px solid ${a};background: ${a};}`)
}
scale_pain()

$(document).on('change', '#rule_of_pain', function () {
    scale_pain()
})

//Pregnant
$(document).on('change', '#condition_pregnant', function () {
    is_pregnant()
})

function is_pregnant() {
    let a = $('#condition_pregnant').is(':checked')
    if(a){
        $('.gestational-block').removeClass('hide')
    }else{
        $('.gestational-block input').val('')
        $('.gestational-block').addClass('hide')
    }
}
is_pregnant()

//type attendance
function type_attendance() {
    let type = $('#type').val()

    if(type == "e"){

        $('.card-forwarding-attendance').removeClass('hide')
        $('.card-discharge-reason').addClass('hide')
        $('.card-discharge-reason textarea').val('')

        $('.card-specialties').addClass('hide')

        $('.card-specialties').addClass('hide')
        $('.card-specialties select').val('');

    }else if(type == "l"){

        $('.card-discharge-reason').removeClass('hide')

        $('.card-forwarding-attendance').addClass('hide')
        $('.card-forwarding-attendance textarea').val('')

        $('.card-specialties').addClass('hide')
        $('.card-specialties select').val('');

    }else{

        $('.card-specialties').removeClass('hide')

        $('.card-forwarding-attendance').addClass('hide')
        $('.card-forwarding-attendance input').val('')

        $('.card-discharge-reason').addClass('hide')
        $('.card-discharge-reason').val('')
    }
}
type_attendance()

$(document).on('change', '#type', function (e) {
    type_attendance()
})

//classification
function scale_classification() {
    
    let a = $('#classification').val()
    let b = "rgba(0,0,255)";
    let text = `<span class="badge not_urgent">Não urgente</span>`

    if(a == 4){
        b = "rgba(255,0,0)"
        text = `<span class="badge emergency">Emergência</span>`
    }else if(a == 3){
        b = "rgba(255,165,0)"
        text = `<span class="badge very_urgent">Muito Urgente</span>`
    }else if(a == 2){
        b = "rgba(255,255,0)"
        text = `<span class="badge urgent">Urgente</span>`
    }else if(a == 1){
        b = "rgba(0,128,0)"
        text = `<span class="badge little_urgent">Pouco Urgente</span>`
    }

    forwarding_show(a)
    $("label[for='classification'] span").html(text)
    inject_css(`#classification::-webkit-slider-thumb {-webkit-appearance: none; border: 3px solid ${b};background: ${b};}`)
}
scale_classification()

$(document).on('change', '#classification', function (e) {
    scale_classification()
})

function forwarding_show(a) {
    
    if(($('.card-forwarding-attendance').length) && a > 2){
        $('.card-forwarding-attendance').removeClass('hide')
        $('.card-specialties').addClass('hide')
        $('#type').val('e')
    }else{
        $('.card-forwarding-attendance').addClass('hide')
        $('.card-specialties').removeClass('hide')
        $('#type').val('a')
    }
}