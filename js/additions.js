jQuery(document).ready(function() {

    jQuery('form.verify-form').submit(function( event ) {
        var form = jQuery(this),
            form_action = form.attr('data-action-name');
        // Stop the form from submitting
        event.preventDefault();
        // Needs for recaptacha ready
        grecaptcha.ready(function() {
            // Do request for recaptcha token
            // Response is promise with passed token
            grecaptcha.execute('6LcokGkUAAAAAIo1z0lyZ-CO-X0FIy8_5v9ulfTL', { action: form_action } ).then( function(token) {
                // add token to form
                form.prepend('<input type="hidden" name="token" value="' + token + '">');
                form.prepend('<input type="hidden" name="action" value="' + form_action + '">');
                // submit form now
                form.unbind('submit').submit();
            });
        });
    });

});