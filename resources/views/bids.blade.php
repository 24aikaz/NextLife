@extends('app')

@section('content')
    <div id="bids_content">
        
        <div class="bids_title_card card mx-auto">
            <h2 class="title text-center">Bids Placed</h2>
        </div>

        @if ($bids->count())
            <div class="row row-cols-1">
                @foreach ($bids as $bid)
                    <div class="col">
                        <a class="card-link" href="{{ route('viewproduct', ['Product_ID' => $bid->product_id]) }}">
                            <div class="card">
                                <p>Product image should be displayed here</p>
                                <p>Product ID: {{ $bid->product_id }}</p>
                                <p>Bid price: ${{ $bid->bid_price }}</p>
                                <p>Date: {{ $bid->bid_time }}</p>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        @else
            <p>You have not placed any bids yet.</p>
        @endif
    </div>

    @vite(['resources/js/bids.js'])
@endsection
