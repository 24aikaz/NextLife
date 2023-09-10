@extends('app')

@section('content')

    <div class="wonproducts_content">

        @if (auth()->user()->usertype == 'bidder')

            <h2 class="page_title">Bids Won</h2>

            @if ($wonProducts->count())
                <div class="row row-cols-1">
                    @foreach ($wonProducts as $product)
                        <div class="card">

                            <div class="row">
                                <div class="col-4">
                                    <img class="product-image" src="{{ asset('storage/' . $product->image) }}"
                                        alt="{{ $product->name }}">
                                </div>

                                <div class="col-4">
                                    <h3 class="product_title">{{ $product->pname }}</h5>
                                        <p class="text-muted product_para">{{ $product->category }}</p>
                                        <p class="product_para">{{ $product->pdesc }}</p>
                                        <p class="product_para">{{ $product->updated_at->diffForHumans() }}</p>
                                </div>

                                <div class="col-4 d-flex flex-column justify-content-between align-items-center">
                                    <div>
                                        <p>Starting price: ${{ $product->startprice }}</p>
                                        <p>Won at: ${{ $product->winning_bid }}</p>
                                    </div>

                                    <div>
                                        <form method="POST" action="{{ route('checkout') }}">
                                            @csrf
                                            <input type="hidden" name="Product_ID" value="{{ $product->Product_ID }}">
                                            <button type="submit" class="btn btn-success">Checkout</button>
                                        </form>
                                    </div>

                                </div>
                            </div>

                        </div>
                    @endforeach
                </div>
            @else
                <p>You have not won any bids yet.</p>
            @endif
        @else
            <div class="mx-auto errormsg">
                <h1 class="text-center">ACCESS DENIED!</h1>
            </div>

        @endif

    </div>

    @vite(['resources/js/wonproducts.js'])

@endsection
