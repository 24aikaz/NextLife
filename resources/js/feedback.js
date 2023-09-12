import '../css/feedback.css';

$(document).ready(function () {

    $("#suggestion").hide();
    $("#rating").hide();
    $("#problem").hide();

    $(document).on('click', '#suggestion_btn', function () {
        $("#button_containers").hide();
        $("#suggestion").show();
    });
    $(document).on('click', '#submit_suggestion', function(event) {
        event.preventDefault();
        var data = {
            'feedback_type': $('#type1').text(),
            'categories': $('#category').val(),
            'comment': $('#suggestion_comment').val()
        }
        console.log(data);

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var url = "api/validate"

        // Send the data to the PHP script for validation
        $.ajax({
            url: url, //api route
            type: 'POST',
            data: JSON.stringify(data),
            contentType: 'application/json',
            success: function(response) {
                console.log(response);
            },
            error: function(error) {
                console.error('Error:', error);
            }
        });
    });




    $(document).on('click', '#rate_btn', function (event) {
        $("#button_containers").hide();
        $("#rating").show();
    });
    $(document).on('click', '#submit_rating', function (event) {
        event.preventDefault();

        var data = {
            'feedback_type': $('#type2').text(),
            'stars': $('#stars').val(),
            'comment': $('#rating_comment').val()
        }
        console.log(data);

        const schema = {
            "type": "object",
            "properties": {
                "feedback_type": {
                    "type": "string"
                },
                "stars": {
                    "type": "integer"
                },
                "comment": {
                    "type": "string"
                }
            },
            "required": ["feedback_type", "stars", "comment"]
        };

    });




    $(document).on('click', '#problem_btn', function (event) {
        $("#button_containers").hide();
        $("#problem").show();
    });
    $(document).on('click', '#submit_problem', function (event) {
        event.preventDefault();

        var data = {
            'feedback_type': $('#type3').text(),
            'frequency': $('#frequency').val(),
            'comment': $('#problem_comment').val()
        }
        console.log(data);

        const schema = {
            "type": "object",
            "properties": {
                "feedback_type": {
                    "type": "string"
                },
                "frequency": {
                    "type": "string"
                },
                "comment": {
                    "type": "string"
                }
            },
            "required": ["feedback_type", "frequency", "comment"]
        };

    });

});
