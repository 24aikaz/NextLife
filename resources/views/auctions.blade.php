@extends('app')

@section('content')

    <div id="auctions_content">

        <div class="auction_title_card card mx-auto">
            <h2 class="title text-center">Auctions</h2>
        </div>

        <div class="container">

            @if ($products->count())
                <div class="row row-cols-2">
                    @foreach ($products as $product)
                        <div class="col">
                            <a class="card-link" href="{{ route('viewproduct', ['Product_ID' => $product->Product_ID]) }}">
                                <div class="card">
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->pname }}"
                                        class="product-image">
                                    <h3 class="product_title">{{ $product->pname }}</h3>
                                    <h5>Current Price: $ {{ $product->currentprice }}</h5>
                                    <p>Countdown: 
                                        @if (now() > $product->enddate)
                                            0 days
                                        @else
                                            {{ now()->diff($product->enddate)->format('%dd') }}
                                        @endif
                                    </p>
                                    
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            @else
                <p>There are currently no active auctions.</p>
            @endif


        </div>
@auth
        <!-- Assuming you have a Blade template for displaying the product details -->
        <form id="checkWinnerForm" method="post" action="{{ route('check-winners') }}">
            @csrf
            <button type="submit" id="checkWinnerBtn">Check Winner</button>
        </form>
        
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            $(document).ready(function () {
                $("#checkWinnerBtn").click(function (e) {
                    e.preventDefault(); // Prevent the form submission
        
                    $.ajax({
                        type: "POST",
                        url: "{{ route('check-winners') }}",
                        data: {
                            _token: "{{ csrf_token() }}",
                        },
                        success: function (response) {
                alert(response.message);
                if (response.redirect) {
                    // Redirect to the payment method page
                    window.location.href = response.redirect;
                } else {
                    // Display an error message if no redirect is provided
                    alert('Error: Could not redirect to payment method page.');
                }
            },
            error: function (xhr, status, error) {
                console.error(error);
                        },
                    });
                });
            });
        </script>
  @endauth      

        @vite(['resources/js/auctions.js'])

    </div>
@endsection
