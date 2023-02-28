// This function checks if a tab is locked (i.e., disabled) based on whether the textarea in that tab has any content
function is_lock() {
    
    $('a[data-wizard-step]').removeClass('done')
    $('a[data-wizard-step]').removeClass('active-wizard')

    // Loop through each anchor tag with a 'data-wizard-step' attribute
    $('a[data-wizard-step]').each(function(index) {
        index = index + 1
        var textarea = $('#bootstrap-wizard-validation-tab'+index+' textarea')
        var textarea_val = textarea.val()

        // If the textarea is empty, disable the tab
        if(textarea_val.length == 0){
            $(this).attr('disabled', true);
        }else{
            // Otherwise, enable the tab
            $(this).removeAttr('disabled')
            $(this).addClass('done')

            if($(this).hasClass('active')) {
                $(this).removeClass('active')
                $(this).addClass('active')
            }
        }
    });
}

// Call the is_lock function to initialize the locked tabs when the page loads
is_lock()

// This function handles navigating to the next or previous tab based on the 'operator' parameter (+ for next, - for previous)
function tap_position(operator) {

    // Call the is_lock function to update the locked tabs before navigating
    is_lock()

    // Get the current tab position and textarea content
    var current_position = parseInt($('.nav-link.active').attr('tab-position'));
    var current_tab = $('.nav-link.active')
    var current_textarea = $(current_tab.attr('href')+' textarea')
    var textarea_val = current_textarea.val()

    // Calculate the new position based on the operator (+ or -)
    var new_position = operator === '+' ? current_position + 1 : current_position - 1;
    var next_position = operator === '+' ? new_position + 1 : new_position - 1;

    // Find the anchor tags for the new and next tabs based on their position
    var $new_tab = $('a[tab-position="' + new_position + '"]');
    var $next_tab = $('a[tab-position="' + next_position + '"]');

    // Remove any validation error styling from all textareas
    $('.tab-pane textarea').removeClass('is-invalid')
    $('.nav-link.active > span.nav-item-circle-parent > span.nav-item-circle').removeClass('is-invalid-wizard')

    // If the current tab is locked and the textarea is empty, prevent navigation to the next tab
    if(current_tab.attr("disabled", true) && (textarea_val.length == 0) && (operator === '+')){
        current_textarea.addClass('is-invalid')
        $('.nav-link.active > span.nav-item-circle-parent > span.nav-item-circle').addClass('is-invalid-wizard')
        return false;
    }

    // If the new tab exists, activate it and deactivate the current tab
    if ($new_tab.length) {
        $('a.active[data-wizard-step="data-wizard-step"]').removeClass('active');
        $('.tab-pane.wizard').removeClass('active');

        var tab_card = $new_tab.attr('href')
        $(tab_card).addClass('active');

        $new_tab.addClass('active');
    } else {
        // If there is no new tab (i.e., at the end of the form), hide the 'next' button
        if (operator === '+') {
            $('#next-wizard').hide();
        } else if (operator === '-') {
            // If there is no previous tab (i.e., at the beginning of the form), hide the 'previous' button
            $('#prev-wizard').hide();
        }
    }

    // If there is a next tab, show the 'previous' and 'next' buttons
    if ($next_tab.length) {
        $('#prev-wizard').show();
        $('#next-wizard').show();
    } else {
        // If there is no next tab, hide the 'next' button
        if (operator === '+') {
            $('#next-wizard').hide();
        } else if (operator === '-') {
            // If there is no previous tab, hide the 'previous
            $('#prev-wizard').hide();
        }
    }

    is_lock()
}

function validation_wizard() {
    is_lock()
    $('span.nav-item-circle').removeClass('is-invalid-wizard')
    $('a[data-wizard-step="data-wizard-step"][disabled] > span.nav-item-circle-parent > span.nav-item-circle').addClass('is-invalid-wizard')
}