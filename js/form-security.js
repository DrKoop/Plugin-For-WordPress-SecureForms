jQuery(document).ready(function($) {
    $('input, textarea').on('input', function() {
        var inputValue = $(this).val();
        var regex = /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]+/;
        if (regex.test(inputValue)) {
            $(this).val('');
            $('#form-security-alert').show();
        } else {
            $('#form-security-alert').hide();
        }
    });
});