@extends('app')

@section('content')
    <div id="house_content">

        @if (auth()->user()->usertype == 'merchant')

            <h2 class="page_title">Your Auction House</h2>

            <div class="d-flex justify-content-end">

                <button class="btn checkoutlist_btn" data-toggle="modal" data-target="#PaidList">
                    Paid List
                </button>

                <form action="{{ route('product') }}" method="GET">
                    @csrf
                    <button class="btn" title="Add product for sale!" id="add_product_btn"><i
                            class="fa-solid fa-plus"></i></button>
                </form>

            </div>


            <div class="row">

                <div class="col-6">

                    <h4>All products</h4>
                    <div class="scroll">
                        @if ($products->count())
                            <div class="row row-cols-1">
                                @foreach ($products as $product)
                                    <div class="col" id="product-{{ $product->Product_ID }}">
                                        <a class="card-link"
                                            href="{{ route('viewproduct', ['Product_ID' => $product->Product_ID]) }}">
                                            <div class="card">
                                                <h3 class="product_title">{{ $product->pname }}</h3>
                                                <p class="prod_id text-muted">ID: {{ $product->Product_ID }}</p>
                                                <p>Status: <span id="product_status_{{ $product->Product_ID }}"></span></p>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p>You have no items on sale.</p>
                        @endif
                    </div>

                </div>

                <div class="col-6">

                    <h4>Active products</h4>
                    <div class="scroll_active">
                        @if ($products->count())
                            <div class="row row-cols-1">
                                @foreach ($products as $product)
                                    @if (now(4) < $product->enddate)
                                        <div class="col" id="product-{{ $product->Product_ID }}">
                                            <a class="card-link"
                                                href="{{ route('viewproduct', ['Product_ID' => $product->Product_ID]) }}">
                                                <div class="card">
                                                    <h3 class="product_title">{{ $product->pname }}</h3>
                                                    <p class="d-flex justify-content-end">Current bid: $
                                                        {{ $product->currentprice }}</p>
                                                    </p>
                                                    <p class="text-muted prod_time">
                                                        Ends in
                                                        {{ now(4)->diff($product->enddate)->format('%d d, %h h, and %i min') }}
                                                    </p>
                                                    {{-- Delete form
                                                     Allowing deletes only for products that haven't ended yet --}}
                                                    <div class="delete-product-container">
                                                        <form class="delete-product-form"
                                                            data-product-id="{{ $product->Product_ID }}">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="button"
                                                                class="btn btn-danger delete-product-btn">Delete</button>
                                                        </form>
                                                    </div>

                                                </div>
                                            </a>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        @else
                            <p>No active products.</p>
                        @endif
                    </div>

                    <h4 class="pt-4">Inactive products</h4>
                    <div class="scroll_inactive">
                        @if ($products->count())
                            <div class="row row-cols-1">
                                @foreach ($products as $product)
                                    @if (now(4) > $product->enddate || now(4) < $product->startdate)
                                        <div class="col" id="product-{{ $product->Product_ID }}">
                                            <a class="card-link"
                                                href="{{ route('viewproduct', ['Product_ID' => $product->Product_ID]) }}">
                                                <div class="card">
                                                    <h3 class="product_title">{{ $product->pname }}</h3>
                                                    <p class="d-flex justify-content-end">Lastest bid: $
                                                        {{ $product->currentprice }}</p>
                                                    </p>
                                                    <p class="text-muted prod_time">
                                                        @if (now(4) > $product->enddate)
                                                            Ended
                                                            {{ now(4)->diff($product->startdate)->format('%d d, %h h ago') }}
                                                        @else
                                                            @if (now(4) < $product->startdate)
                                                                Starting in
                                                                {{ now(4)->diff($product->startdate)->format('%d d, %h h, and %i min') }}
                                                            @else
                                                                Ends in
                                                                {{ now(4)->diff($product->enddate)->format('%d d, %h h, and %i min') }}
                                                            @endif
                                                        @endif
                                                    </p>
                                                </div>
                                            </a>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        @else
                            <p>No inactive products.</p>
                        @endif

                    </div>

                </div>
            @else
                <div class="mx-auto errormsg">
                    <h1 class="text-center">ACCESS DENIED!</h1>
                </div>
        @endif
    </div>


    <!-- Modal -->
    <div class="modal fade" id="PaidList" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Products Paid</h5>
                </div>
                <div class="modal-body">
                    <p>Not Implemented yet</p>
                    <p>Should display the list of users who
                        <br>
                        have already paid for the products they won.
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-dark" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>




    {{-- SCRIPTS  --}}
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
                                'X-CSRF-TOKEN': document.querySelector(
                                    'meta[name="csrf-token"]').getAttribute('content')
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
