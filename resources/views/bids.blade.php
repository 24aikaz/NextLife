@extends('app')

@section('content')
    <div id="bids_content">

        <div class="bids_title_card card mx-auto">
            <h2 class="title text-center">Bids Placed</h2>
        </div>

        <div id="bid_filter" class="card">
            <label class="filter_element text-center"><i class="fa-solid fa-filter"></i> Filters:</label>
            <button class="filter_element filter_btn btn" id="active_filter_btn">Active</button>
            <button class="filter_element filter_btn btn" id="ended_filter_btn">Ended</button>
            <button class="filter_element filter_btn btn" id="clear_filter_btn" title="Clear filters"><i
                    class="fa-solid fa-filter-circle-xmark"></i></button>
        </div>

        <div id="all_bids">
            @if ($bids->count())
                <div class="bid_row row row-cols-1">
                    @foreach ($bids as $bid)
                        @foreach ($products as $product)
                            @if ($bid->product_id == $product->Product_ID)
                                <a class="card-link" href="{{ route('viewproduct', ['Product_ID' => $bid->product_id]) }}">
                                    <div class="card">
                                        <div class="row">
                                            <div class="col-4">
                                                <img src="{{ asset('storage/' . $product->image) }}"
                                                    alt="{{ $product->pname }}" class="product-image">
                                            </div>

                                            <div class="col-8">
                                                <h3>{{ $product->pname }} <span
                                                        class="product_id">{{ $bid->product_id }}</span></h3>
                                                <h4></h4>
                                                <p>Bid placed: ${{ $bid->bid_price }}</p>
                                                <p>{{ $bid->created_at->diffForHumans() }}</p>
                                                @if ($product->status == 'Inactive')
                                                    <label class="product_status d-flex justify-content-end">Ended</label>
                                                @else
                                                    <label class="product_status d-flex justify-content-end">Active</label>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            @endif
                        @endforeach
                    @endforeach
                </div>
            @else
                <p>You have not placed any bids yet.</p>
            @endif
        </div>


        <div id="active_bids">
            <h1>Active</h1>
            @if ($bids->count())
                <div class="bid_row row row-cols-1">
                    @foreach ($bids as $bid)
                        @foreach ($products as $product)
                            @if ($bid->product_id == $product->Product_ID && $product->status == 'Active')
                                <a class="card-link" href="{{ route('viewproduct', ['Product_ID' => $bid->product_id]) }}">
                                    <div class="card">
                                        <div class="row">
                                            <div class="col-4">
                                                <img src="{{ asset('storage/' . $product->image) }}"
                                                    alt="{{ $product->pname }}" class="product-image">
                                            </div>

                                            <div class="col-8">
                                                <h3>{{ $product->pname }} <span
                                                        class="product_id">{{ $bid->product_id }}</span></h3>
                                                <h4></h4>
                                                <p>Bid placed: ${{ $bid->bid_price }}</p>
                                                <p>{{ $bid->created_at->diffForHumans() }}</p>
                                                @if ($product->status == 'Inactive')
                                                    <label class="product_status d-flex justify-content-end">Ended</label>
                                                @else
                                                    <label class="product_status d-flex justify-content-end">Active</label>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            @endif
                        @endforeach
                    @endforeach
                </div>
            @else
                <p>No active Bids.</p>
            @endif
        </div>

        <div id="inactive_bids">
            <h1>Inactive</h1>
            @if ($bids->count())
                <div class="bid_row row row-cols-1">
                    @foreach ($bids as $bid)
                        @foreach ($products as $product)
                            @if ($bid->product_id == $product->Product_ID && $product->status == 'Inactive')
                                <a class="card-link" href="{{ route('viewproduct', ['Product_ID' => $bid->product_id]) }}">
                                    <div class="card">
                                        <div class="row">
                                            <div class="col-4">
                                                <img src="{{ asset('storage/' . $product->image) }}"
                                                    alt="{{ $product->pname }}" class="product-image">
                                            </div>

                                            <div class="col-8">
                                                <h3>{{ $product->pname }} <span
                                                        class="product_id">{{ $bid->product_id }}</span></h3>
                                                <h4></h4>
                                                <p>Bid placed: ${{ $bid->bid_price }}</p>
                                                <p>{{ $bid->created_at->diffForHumans() }}</p>
                                                @if ($product->status == 'Inactive')
                                                    <label class="product_status d-flex justify-content-end">Ended</label>
                                                @else
                                                    <label class="product_status d-flex justify-content-end">Active</label>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            @endif
                        @endforeach
                    @endforeach
                </div>
            @else
                <p>No Inactive Bids.</p>
            @endif
        </div>

    </div>
    @vite(['resources/js/bids.js'])
@endsection
