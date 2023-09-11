import '../css/profile.css';

$(document).ready(function () {
    // Target the form submit event
    $('#UpdateForm').submit(function (event) {
        event.preventDefault(); // Prevent the default form submission

        // Get the form data
        var formData = {
            'email': $('#edit_email').val(),
            'contact_number': $('#edit_num').val(),
            'street': $('#edit_street').val(),
            'city': $('#edit_city').val(),
            'postal_code': $('#edit_country').val(),
            'country': $('#edit_postcode').val(),
        }

        // Get the API endpoint URL based on the form's action attribute
        var apiUrl = $(this).attr('action');

        console.log(apiUrl);

        // Send an AJAX PUT request to update the user profile
        $.ajax({
            url: apiUrl,
            method: 'PUT',
            data: formData,
            success: function (response) {
                // Handle the successful response here, e.g., show a success message
                alert(response.message);
            },
            error: function (error) {
                // Handle errors here, e.g., show validation errors
                if (error.status === 422) {
                    var errors = error.responseJSON.errors;
                    console.log(errors);
                    // Display the validation errors to the user
                    // You can implement your logic to show errors as needed
                } else {
                    // Handle other types of errors (e.g., 404)
                    alert('An error occurred. Please try again later.');
                }
            }
        });
    });


    $('#DeleteForm').submit(function (event) {
        event.preventDefault();

        var apiUrl = $(this).attr('action'); // Getting the API endpoint URL based on the form's action attribute

        $.ajax({
            url: apiUrl,
            method: 'DELETE',
            data: '',
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
});