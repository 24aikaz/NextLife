@extends('app')

@section('content')
    <div id="auctions_content">
        <h2>Auctions</h2>

        <div class="container">

            @if ($products->count())
            <div class="row row-cols-2">
                @foreach ($products as $product)
                    <div class="col">
                        <div class="card">
                            <h3>{{ $product->pname }}</h3>
                            <p>{{ $product->pdesc }}</p>
                            <h4>{{ $product->user->name }}</h4>
                            <h5>Start Price: $ {{ $product->startprice }}</h5>
                            <h5>Current Price: $ {{ $product->currentprice }}</h5>
                            <p>Countdown: {{ now()->diff($product->enddate)->format('%dd') }}</p>
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->pname }}" class="product-image">
                            
                            <form action="{{ route('place-bid', ['id' => $product->Product_ID]) }}" method="POST">
                                @csrf
                                <input type="number" name="bid_price" class="form-control" placeholder="Enter bid price">
                                <button type="submit" class="btn btn-primary">Place Bid</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p>There are currently no active auctions.</p>
        @endif
        

                </div>
        
        @vite(['resources/js/auctions.js'])

    </div>
@endsection
