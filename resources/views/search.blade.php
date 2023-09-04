@extends('app')

@section('content')

<div id="auctions_content">
    <h1>Search Results</h1>

    <div class="container">

        <!-- Add a search form -->
        <form method="GET" action="{{ route('search') }}">
            @csrf
            <div class="mb-3">
                <label for="query" class="form-label">Search</label>
                <input type="text" class="form-control" id="query" name="query" placeholder="Search for products">
            </div>
            <button type="submit" class="btn btn-primary">Search</button>
        </form>

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
                </div>
            </div>
            @endforeach
        </div>
        @else
            <p>There are currently no results for your search.</p>
        @endif
        @vite(['resources/js/auctions.js'])
    </div>
</div>

@endsection
