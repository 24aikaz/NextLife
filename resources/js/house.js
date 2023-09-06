//Not working yet

function updateProductStatus() {
    // Fetch product data using Ajax
    fetch('/get-products')
        .then(response => response.json())
        .then(products => {
            var now = new Date();

            products.forEach(function (product) {
                var startdate = new Date(product.startdate);
                var enddate = new Date(product.enddate);
                var statusElement = document.querySelector('#product_status_' + product.Product_ID);

                if (now < startdate) {
                    statusElement.textContent = 'Scheduled';
                } else if (now >= startdate && now <= enddate) {
                    statusElement.textContent = 'Active';
                } else {
                    statusElement.textContent = 'Ended';
                }
            });
        })
        .catch(error => console.error(error));
}

updateProductStatus();

setInterval(updateProductStatus, 1000); 