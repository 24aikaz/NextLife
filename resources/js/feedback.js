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
        var data = {
            'feedback_type': $('#type1').text(),
            'categories': $('#category').val(),
            'stars': null,
            'frequency': null,
            'comment': $('#suggestion_comment').val()
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



    //Handling Rating Feedback
    $(document).on('click', '#rate_btn', function () {
        $("#MainView").hide();
        $("#rating").show();
    });
    $(document).on('click', '#submit_rating', function (event) {
        event.preventDefault();
        var data = {
            'feedback_type': $('#type2').text(),
            'categories': null,
            'stars': parseInt($('#stars').val()),
            'frequency': null,
            'comment': $('#rating_comment').val()
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

    //Handling Problem Feedback
    $(document).on('click', '#problem_btn', function () {
        $("#MainView").hide();
        $("#problem").show();
    });
    $(document).on('click', '#submit_problem', function (event) {
        event.preventDefault();
        var data = {
            'feedback_type': $('#type3').text(),
            'categories': null,
            'stars': null,
            'frequency': $('#frequency').val(),
            'comment': $('#problem_comment').val()
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


    $(document).on('click', '.cancel', function () {
        $("#MainView").show();
        $("#suggestion").hide();
        $("#rating").hide();
        $("#problem").hide();
    });

});