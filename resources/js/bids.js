import '../css/bids.css';

$(document).ready(function () {

    $("#active_bids").hide();
    $("#inactive_bids").hide();

    $(document).on('click', '#active_filter_btn', function (event) {

        event.preventDefault();

        $('#active_filter_btn').addClass('active');
        $('#ended_filter_btn').removeClass('active');

        $("#all_bids").hide();
        $("#active_bids").show();
        $("#inactive_bids").hide();

    });

    $(document).on('click', '#ended_filter_btn', function (event) {

        event.preventDefault();

        $('#active_filter_btn').removeClass('active');
        $('#ended_filter_btn').addClass('active');

        $("#all_bids").hide();
        $("#active_bids").hide();
        $("#inactive_bids").show();

    });

    $(document).on('click', '#clear_filter_btn', function (event) {

        event.preventDefault();

        $('#active_filter_btn').removeClass('active');
        $('#ended_filter_btn').removeClass('active');

        $("#all_bids").show();
        $("#active_bids").hide();
        $("#inactive_bids").hide();

    });

});