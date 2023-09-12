import '../css/feedback.css';

$(document).ready(function () {

    $("#suggestion").hide();
    $("#rating").hide();
    $("#problem").hide();

    $(document).on('click', '#suggestion_btn', function () {
        $("#button_containers").hide();
        $("#suggestion").show();
    });
    $(document).on('click', '#submit_suggestion', function (event) {
        event.preventDefault();

        var data = {
            'feedback_type': $('#type1').text(),
            'categories': $('#category').val(),
            'comment': $('#suggestion_comment').val()
        }
        console.log(data);

        const schema = 
        {
            "type": "object",
            "properties": {
                "feedback_type": {
                    "type": "string"
                },
                "categories": {
                    "type": "string"
                },
                "comment": {
                    "type": "string"
                }
            },
            "required": ["feedback_type", "categories", "comment"]
        };

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
