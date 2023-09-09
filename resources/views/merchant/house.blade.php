@extends('app')

@section('content')

<div id="house_content">

    <div class="house_title_card card mx-auto">
        <h2 class="title text-center">Your Auction House</h2>
    </div>

    @if (auth()->user()->usertype == 'merchant')

    <form class="d-flex justify-content-end" action="{{ route('product') }}" method="GET">
        <button class="btn btn-outline-dark" title="Add product for sale!"><i class="fa-solid fa-plus"></i></button>
    </form>

    <h3>Items on sale:</h3>
    @if ($products->count())
    <div class="row row-cols-1">
        @foreach ($products as $product)
        <div class="col" id="product-{{ $product->Product_ID }}">
            <div class="card">
                {{-- <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->pname }}"
                    class="product-image"> --}}
                <h3 class="product_title">{{ $product->pname }}</h3>
                <h5>Current bid: $ {{ $product->currentprice }}</h5>
                <p>Status: <span id="product_status_{{ $product->Product_ID }}"></span></p>
                <p>
                    @if (now(4) > $product->enddate)
                    Ended {{ now(4)->diff($product->startdate)->format('%d d, %h h ago') }}
                    @else
                    @if (now(4) < $product->startdate)
                    Starting in {{ now(4)->diff($product->startdate)->format('%d d, %h h, and %i min') }}
                    @else
                    Countdown: {{ now(4)->diff($product->enddate)->format('%d d, %h h, and %i min') }}
                    @endif
                    @endif
                </p>
                
                <!-- Delete form -->
                <div class="delete-product-container">
                    <form class="delete-product-form" data-product-id="{{ $product->Product_ID }}">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-danger delete-product-btn">Delete</button>
                    </form>
                </div>
                
            </div>
            <a class="card-link" href="{{ route('viewproduct', ['Product_ID' => $product->Product_ID]) }}"></a>
        </div>
        @endforeach
    </div>
    @else
    <p>You have no items on sale.</p>
    @endif
    @else
    <div class="card mx-auto errormsg">
        <h2 class="title text-center">Access Denied!</h2>
    </div>
    @endif
</div>

<script>
    function updateProductStatus() {
        var products = @json($products); // Convert PHP products array to JavaScript
        var now = new Date();

        products.forEach(function(product) {
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
    }

    // // Call the function on page load
    // window.addEventListener('load', updateProductStatus);

    updateProductStatus();

    setInterval(updateProductStatus, 1000);
</script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Attach a click event listener to all delete buttons
    const deleteButtons = document.querySelectorAll('.delete-product-btn');

    deleteButtons.forEach(function(button) {
        button.addEventListener('click', function(event) {
            event.preventDefault(); // Prevent default behavior
            event.stopPropagation(); // Stop event propagation to the anchor tag
            const productId = button.parentElement.dataset.productId;

            // Send an AJAX request to delete the product
            fetch(`/product/${productId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
            })
            .then(response => {
                if (response.ok) {
                    // Product deleted successfully
                    document.getElementById(`product-${productId}`).remove();
                } else {
                    // Handle errors or show a message
                    console.error('Failed to delete the product.');
                }
            })
            .catch(error => {
                console.error('An error occurred:', error);
            });
        });
    });
});
</script>


@vite(['resources/js/house.js'])
@endsection
