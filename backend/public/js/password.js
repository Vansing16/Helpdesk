
$(document).ready(function() {
    $('#password, #confirm_password').on('keyup', function () {
        if ($('#password').val() == $('#confirm_password').val()) {
            $('#confirm_password').removeClass('is-invalid');
        } else {
            $('#confirm_password').addClass('is-invalid');
        }
    });
});