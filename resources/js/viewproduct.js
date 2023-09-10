import '../css/viewproduct.css';

$(document).ready(function () {

    //To view product on full screen
    //Source: https://stackoverflow.com/a/74505101
    $("img").click(function () {
        this.requestFullscreen()
    })

    //AJAX to place a bid without refreshing the page to update its contents
    //Source: https://youtu.be/cmmyrrdHb2M?si=HllZmTorpmF1-GaJ
    $(document).on('click', '#place_bid_btn', function (event) {

        event.preventDefault();

        var productID = $('#productID').text();

        var url = "/place-bid/" + productID;

        var data = {
            'bid_price': $('#bid_now').val()
        }

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: url,
            data: data,
            dataType: 'json',
            type: 'POST',

            success: function (response) {
                console.log(response);
                if (response.status == 400) {
                    console.log("AJAX fail with error 400");
                    $('#display_error').text(response.errors.bid_price);
                } else if (response.status == 401) {
                    $('#display_error').text(response.message);
                    console.log("AJAX fail with error 401");
                } else {
                    console.log("AJAX success");
                    $('#current_bid').text('$' + data.bid_price);
                    var incr = parseInt($('#count_btn').text()) + 1;
                    $('#count_btn').text(incr);
                }
            },

            error: function (response) {
                console.log("AJAX error", response.responseText);
            }
        })

    });

});