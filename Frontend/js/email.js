

    $(document).ready(function() {
        $('#register-btn').click(function() {
            var formData = {
                'firstname': $('#firstname').val(),
                'lastname': $('#lastname').val(),
                'companyname': $('#companyname').val(),
                'phone': $('#phone').val(),
                'email': $('#email').val(),
                'password': $('#password').val(),
                'reemail': $('#reemail').val(),
                'cpass': $('#cpass').val()
            };

            $.ajax({
                type: 'POST',
                url: '../views/sendmail.php',
                data: formData,
                dataType: 'json',
                encode: true,
                success: function(response) {
                    $('#result-message').html('<p>' + response.message + '</p>');
                },
                error: function(xhr, status, error) {
                    $('#result-message').html('<p>Error: ' + error + '</p>');
                }
            });
        });
    });

