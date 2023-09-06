@extends('app')

@section('content')
    <div id="viewproduct_content">

        <div class="row row-cols-2">

            <div class="col">
                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->pname }}" class="product_image">
            </div>

            <div class="col">
                <h4>{{ $product->pname }}</h4>
                <p>Description: {{ $product->pdesc }}</p>
                <p>Starting bid: ${{ $product->startprice }}</p>
                <p>Current bid: ${{ $product->currentprice }}</p>
                <p>Bids placed: {{ $product->bidcount }}</p>
                <p>Category: {{ $product->category }}</p>
                <p>End date: {{ $product->enddate }}</p>

                <form action="{{ route('place-bid', ['id' => $product->Product_ID]) }}" method="POST">
                    @csrf
                    <input type="number" name="bid_price" class="form-control" placeholder="Enter bid price">
                    <button type="submit" class="btn btn-outline-dark">Place Bid</button>
                </form>
            </div>

        </div>

    </div>

    @vite(['resources/js/viewproduct.js'])
@endsection
