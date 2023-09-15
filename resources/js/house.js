import '../css/house.css';

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
          statusElement.classList.add('scheduled_class');
        } else if (now >= startdate && now <= enddate) {
          statusElement.textContent = 'Active';
          statusElement.classList.add('active_class');
        } else {
          statusElement.textContent = 'Ended';
          statusElement.classList.add('ended_class');
        }
      });
    })
    .catch(error => console.error(error));
}

updateProductStatus();

setInterval(updateProductStatus, 1000); 