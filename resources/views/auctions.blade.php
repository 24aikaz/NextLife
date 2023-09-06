@extends('app')

@section('content')

    <div id="auctions_content">
        <h2>Auctions</h2>

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
        <form method="POST" action="{{ route('select-winner') }}">
            @csrf
            <button type="submit" class="btn btn-primary">Select Winner</button>
        </form>

        @vite(['resources/js/auctions.js'])

    </div>
@endsection
