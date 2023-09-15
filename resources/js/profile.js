import '../css/profile.css';

$(document).ready(function () {

    $('#UpdateForm').submit(function (event) {

        event.preventDefault();

        // Get the form data
        var formData = {
            'email': $('#edit_email').val(),
            'contact_number': $('#edit_num').val(),
            'street': $('#edit_street').val(),
            'city': $('#edit_city').val(),
            'postal_code': $('#edit_country').val(),
            'country': $('#edit_postcode').val(),
        }

        var apiUrl = $(this).attr('action');

        console.log(apiUrl);

        // Send an AJAX PUT request to update the user profile
        $.ajax({
            url: apiUrl,
            method: 'PUT',
            data: formData,
            success: function (response) {
                alert(response.message);
            },
            error: function (error) {
                if (error.status === 422) {
                    var errors = error.responseJSON.errors;
                    console.log(errors);
                } else {
                    alert('An error occurred. Please try again later.');
                }
            }
        });
    });


    $('#DeleteForm').submit(function (event) {

        event.preventDefault();

        var apiUrl = $(this).attr('action');

        $.ajax({
            url: apiUrl,
            method: 'DELETE',
            data: '',
            success: function (response) {
                alert(response.message);
                window.location.href = '/';
            },
            error: function (error) {
                if (error.status === 422) {
                    var errors = error.responseJSON.errors;
                    console.log(errors);
                } else {
                    alert('An error occurred. Please try again later.');
                }
            }
        });
    });

});