import '../css/feedback.css';

$(document).ready(function () {

    $("#suggestion").hide();
    $("#rating").hide();
    $("#problem").hide();

    //Handling Suggestion Feedback
    $(document).on('click', '#suggestion_btn', function () {
        $("#MainView").hide();
        $("#suggestion").show();
    });
    $(document).on('click', '#submit_suggestion', function (event) {
        event.preventDefault();
        var comment = null;
        if ($('#suggestion_comment').val() == ''){
            comment = null;
        } else {
            comment = $('#suggestion_comment').val()
        }
        var data = {
            'feedback_type': $('#type1').text(),
            'categories': $('#category').val(),
            'stars': null,
            'frequency': null,
            'comment': comment
        }
        console.log(data);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var url = "api/validateJSON" //api route to validate JSON schema
        // Send the data to the PHP script for validation
        $.ajax({
            url: url, //api route
            type: 'POST',
            data: JSON.stringify(data),
            contentType: 'application/json',
            success: function (response) {
                console.log(response);
                var apiUrl = $('#suggestion_form').attr('action');
                console.log(apiUrl);
                var responseDATA = response.data;
                console.log(responseDATA);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: apiUrl,
                    type: 'POST',
                    data: JSON.stringify(responseDATA),
                    contentType: 'application/json',
                    dataType: 'JSON',
                    success: function (response) {
                        console.log(response);
                        $("#suggestion_form")[0].reset();
                        alert('Thank you for your feedback!');
                    },
                    error: function (error) {
                        console.error('Error:', error);
                        alert("You're required to fill all fields.");
                    }
                });
            },
            error: function (error) {
                console.error('Error:', error);
                alert('There was an error processing your feedback.');
            }
        });
    });



    //Handling Rating Feedback
    $(document).on('click', '#rate_btn', function () {
        $("#MainView").hide();
        $("#rating").show();
    });
    $(document).on('click', '#submit_rating', function (event) {
        event.preventDefault();
        var comment = null;
        if ($('#rating_comment').val() == ''){
            comment = null;
        } else {
            comment = $('#rating_comment').val()
        }
        var data = {
            'feedback_type': $('#type2').text(),
            'categories': null,
            'stars': parseInt($('#stars').val()),
            'frequency': null,
            'comment': comment
        }
        console.log(data);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var url = "api/validateJSON"
        $.ajax({
            url: url,
            type: 'POST',
            data: JSON.stringify(data),
            contentType: 'application/json',
            success: function (response) {
                console.log(response);
                var apiUrl = $('#rating_form').attr('action');
                console.log(apiUrl);
                var responseDATA = response.data;
                console.log(responseDATA);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: apiUrl,
                    type: 'POST',
                    data: JSON.stringify(responseDATA),
                    contentType: 'application/json',
                    dataType: 'JSON',
                    success: function (response) {
                        console.log(response);
                        $("#rating_form")[0].reset();
                        alert('Thank you for your feedback!');
                    },
                    error: function (error) {
                        console.error('Error:', error);
                        alert("You're required to fill all fields.");
                    }
                });
            },
            error: function (error) {
                console.error('Error:', error);
                alert('There was an error processing your feedback.');
            }
        });

    });

    //Handling Problem Feedback
    $(document).on('click', '#problem_btn', function () {
        $("#MainView").hide();
        $("#problem").show();
    });
    $(document).on('click', '#submit_problem', function (event) {
        event.preventDefault();
        var comment = null;
        if ($('#problem_comment').val() == ''){
            comment = null;
        } else {
            comment = $('#problem_comment').val()
        }
        var data = {
            'feedback_type': $('#type3').text(),
            'categories': null,
            'stars': null,
            'frequency': $('#frequency').val(),
            'comment': comment
        }
        console.log(data);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var url = "api/validateJSON"
        $.ajax({
            url: url,
            type: 'POST',
            data: JSON.stringify(data),
            contentType: 'application/json',
            success: function (response) {
                console.log(response);
                var apiUrl = $('#problem_form').attr('action');
                console.log(apiUrl);
                var responseDATA = response.data;
                console.log(responseDATA);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: apiUrl,
                    type: 'POST',
                    data: JSON.stringify(responseDATA),
                    contentType: 'application/json',
                    dataType: 'JSON',
                    success: function (response) {
                        console.log(response);
                        $("#problem_form")[0].reset();
                        alert('Thank you for your feedback!');
                    },
                    error: function (error) {
                        console.error('Error:', error);
                        alert("You're required to fill all fields.");
                    }
                });
            },
            error: function (error) {
                console.error('Error:', error);
                alert('There was an error processing your feedback.');
            }
        });
    });


    $(document).on('click', '.cancel', function () {
        $("#MainView").show();
        $("#suggestion").hide();
        $("#rating").hide();
        $("#problem").hide();
    });








    $(document).on('click', '#generate_list', function (event) {
        event.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var url = "api/leavefeedback"
        $.ajax({
            url: url,
            type: 'GET',
            data: '',
            contentType: 'application/json',
            success: function (response) {
                console.log(response);

                var apiUrl = "http://127.0.0.1:8000/api/validateIncoming";
                console.log(apiUrl);

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: apiUrl,
                    type: 'POST',
                    data: JSON.stringify(response),
                    contentType: 'application/json',
                    dataType: 'JSON',
                    success: function (response) {
                        console.log(response);

                        // Check if the response status is 200 and if there is feedback data
                        if (response.status === 200 && response.data && response.data.feedback) {
                            // Get a reference to the feedback container
                            var feedbackContainer = $('#feedbackContainer');

                            // Loop through the feedback items and create HTML elements for each
                            response.data.feedback.forEach(function (feedbackItem) {
                                // Create a div element to represent the feedback item
                                var feedbackDiv = $('<div class="feedback-item"></div>');

                                // Create HTML content for the feedback item
                                var feedbackContent = '<p>ID: ' + feedbackItem.id + '</p>' +
                                    '<p>User ID: ' + feedbackItem.user_id + '</p>' +
                                    '<p>Feedback Type: ' + feedbackItem.feedback_type + '</p>' +
                                    '<p>Categories: ' + (feedbackItem.categories || 'N/A') + '</p>' +
                                    '<p>Stars: ' + (feedbackItem.stars || 'N/A') + '</p>' +
                                    '<p>Comment: ' + (feedbackItem.comment || 'N/A') + '</p>' +
                                    '<hr>';

                                // Append the HTML content to the feedback div
                                feedbackDiv.html(feedbackContent);

                                // Append the feedback div to the container
                                feedbackContainer.append(feedbackDiv);
                            });
                        } else {
                            console.error('Invalid response:', response);
                        }


                    },
                    error: function (error) {
                        console.error('Error:', error);
                    }
                });
            },
            error: function (error) {
                console.error('Error:', error);
            }
        });
    });

});