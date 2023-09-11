@extends('app')

@section('content')

    <div id="auctions_content">

        <h2 class="page_title">Auctions</h2>

        <div class="container" id="all_products">

            @if ($products->count())
                <div class="row row-cols-3" id="each_product">
                    @foreach ($products as $product)
                        <div class="col">
                            <a class="card-link" href="{{ route('viewproduct', ['Product_ID' => $product->Product_ID]) }}">
                                <div class="card">
                                    
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->pname }}"
                                        class="product-image">
                                    <h3 class="product_title">{{ $product->pname }}</h3>
                                    <p class="product_para">Current Bid: $ {{ $product->currentprice }}</p>
                                    <p class="product_para text-muted d-flex justify-content-end">
                                        @if (now() > $product->enddate)
                                            Ended
                                        @else
                                            Ends in {{ now()->diff($product->enddate)->format('%d d') }}
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

            {{-- For pagination --}}
            {{ $products->links() }}

        </div>
        @auth
            <!-- Assuming you have a Blade template for displaying the product details -->
            <form id="checkWinnerForm" method="post" action="{{ route('check-winners') }}">
                @csrf
                <button type="submit" id="checkWinnerBtn">Check Winner</button>
            </form>

            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script>
                $(document).ready(function() {
                    $("#checkWinnerBtn").click(function(e) {
                        e.preventDefault(); // Prevent the form submission

                        $.ajax({
                            type: "POST",
                            url: "{{ route('check-winners') }}",
                            data: {
                                _token: "{{ csrf_token() }}",
                            },
                            success: function(response) {
                                alert(response.message);
                            },
                            error: function(xhr, status, error) {
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
