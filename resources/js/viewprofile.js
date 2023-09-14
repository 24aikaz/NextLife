import '../css/viewprofile.css';

$(document).ready(function () {
    console.log("Hello");

    var username = $('#carry_value').text();
    console.log(username);

    //Used an absolute path instead for apiURL because it 
    //seems that it's taking from relative url which is returning
    //an error "NOT FOUND"
    var apiUrl = "http://127.0.0.1:8000/api/user/" + username;
    console.log(apiUrl);

    $.ajax({
        url: apiUrl,
        method: 'GET',
        data: '',
        success: function (response) {

            var nameHTML = response.user.first_name + ` ` + response.user.last_name
                + `<span id="usertype_span" class="text-muted">(` + response.user.usertype +
                `)</span>`;

            var addressHTML =
                response.user.street + `, ` + response.user.city + `
                <br>
                ` + response.user.country + ` ` + response.user.postal_code
                ;

            var jsonDate = response.user.created_at;
            var date = new Date(jsonDate);
            var options = { year: 'numeric', month: 'long' };
            var membersince = date.toLocaleString('en-US', options);

            $('#User_Fullname').html(nameHTML);
            $('#User_Username').text(response.user.username);
            $('#User_Email').text(response.user.email);
            $('#User_ContactNum').text(response.user.contact_number);
            $('#User_Address').html(addressHTML);
            $('#User_Member').text(membersince);

        },
        error: function (error) {
            if (error.status === 422) {
                var errors = error.responseJSON.errors;
                console.log(errors);
            } else {
                alert('Cannot view profile at the moment. Please try again later.');
            }
        }
    });


});