$(document).ready(function() {
    $('#reg-form').on('submit', function(e) {
        e.preventDefault();

        const formData = {
            email: $('#email').val(),
            firstname: $('#firstname').val(),
            companyname: $('#companyname').val(),
            password: $('#password').val(),
            reemail: $('#reemail').val(),
            lastname: $('#lastname').val(),
            phone: $('#phone').val(),
            cpass: $('#cpass').val(),
        };

        $.ajax({
            url: '../controllers/CustomerController.php',
            method: 'POST',
            data: formData,
            success: function(response) {
                try {
                    response = JSON.parse(response);
                } catch (e) {
                    console.log('Error parsing JSON:', e);
                    alert('An error occurred while processing your request.');
                    return;
                }

                console.log('Server response:', response);

                if (response && response.success) {
                    alert(response.message);
                    alert("Registration Successful");
                } else {
                    alert(response.message || 'An error occurred');
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('An error occurred: ' + textStatus + ', ' + errorThrown);
                console.log('Response text:', jqXHR.responseText);
            }
        });
    });
});
