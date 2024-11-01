$(document).ready(function() {
    $('#resendButton').on('click', function() {
        $.ajax({
            url: '../email/resend_token.php',
            type: 'POST',
            data: {
                email: $('#email').text(),
                user_id: $('#user_id').val(),
                first_name: $('#first_name').val()
            },
            success: function(response) {
                alert(response);
                $('#resend').modal('hide');
            },
            error: function(xhr, status, error) {
                alert('An error occurred: ' + error);
            }
        });
    });
});