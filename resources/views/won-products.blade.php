@extends('app')

@section('content')
    <div class="container">
        <h1>My Won Products</h1>
        <div class="row">
            @foreach($wonProducts as $product)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->pname }}</h5>
                            <p class="card-text">{{ $product->pdesc}}</p>
                            <p class="card-text">Price: ${{ $product->winning_bid }}</p>
                             <form method="POST" action="{{ route('checkout') }}">
                                @csrf
                                <input type="hidden" name="Product_ID" value="{{ $product->Product_ID }}">
                                <button type="submit" class="btn btn-primary">Checkout</button>
                            </form>
                            
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    
    @vite(['resources/js/viewproduct.js'])
@endsection

