import '../css/auctions.css';

$(document).ready(function () {
    $('#navsearch_form').on('submit', function (e) {
        e.preventDefault(); // Prevent the default form submission

        var url = "/search";

        // Get the search query or keyword
        var query = {
            'query': $('#search_input').val()
        };

        console.log(query);

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // Make an AJAX request to the search route
        $.ajax({
            type: 'GET',
            url: url,
            data: query,
            dataType: 'json',
            success: function (response) {
                console.log(response);
                var products = response.products;
                var eachProductContent = $('#each_product');

                var i = 0;
                var time = '';

                eachProductContent.empty();

                if (products.length > 0) {

                    console.log(products[i].Product_ID);

                    // Build and append HTML for each product
                    products.forEach(function (product) {
                        const endDate = new Date(products[i].enddate);
                        const currentDate = new Date();

                        if (currentDate > endDate) {
                            time = 'Ended'
                        } else {
                            var timediff = Math.floor((Date.now(products[i].enddate) - Date.now()) / (1000 * 60 * 60 * 24));
                            time = timediff + " day";
                        }

                        var productHtml = `
                        <div class="col" >
                        <a class="card-link" href="/viewproduct/`+ products[i].Product_ID + `">
                            <div class="card">
                                <img src="storage/`+ products[i].image + `" alt="` + products[i].pname + `" class="product-image">
                                <h3 class="product_title">`+ products[i].pname + `</h3>
                                <h5>Current Price: $ `+ products[i].currentprice + `</h5>
                                <p>Countdown: `+ time + `</p>
                            </div>
                        </a>
                        </div>`;
                        eachProductContent.append(productHtml);
                        i++;

                    });
                } else {

                    eachProductContent.append('<p class="text-center">No results found.</p>');

                }
            },
            error: function (response) {
                console.log('AJAX error');
            }
        });
    });
});
