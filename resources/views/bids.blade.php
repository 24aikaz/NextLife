@extends('app')

@section('content')
    <div id="bids_content">
        @if (auth()->user()->usertype == 'bidder')


            <h2 class="page_title">Bids Placed</h2>


            {{-- <div id="bid_filter" class="card">
                <label class="filter_element text-center"><i class="fa-solid fa-filter"></i> Filters:</label>
                <button class="filter_element filter_btn btn" id="active_filter_btn">Active</button>
                <button class="filter_element filter_btn btn" id="ended_filter_btn">Ended</button>
                <button class="filter_element filter_btn btn" id="clear_filter_btn" title="Clear filters"><i
                        class="fa-solid fa-filter-circle-xmark"></i></button>
            </div> --}}

            <div id="all_bids">
                @if ($bids->count())
                    <div class="bid_row row row-cols-1">
                        @foreach ($bids as $bid)
                            @foreach ($products as $product)
                                @if ($bid->product_id == $product->Product_ID)
                                    <a class="card-link"
                                        href="{{ route('viewproduct', ['Product_ID' => $bid->product_id]) }}">
                                        <div class="card">
                                            <div class="row">

                                                <div class="col-2">
                                                    <img src="{{ asset('storage/' . $product->image) }}"
                                                        alt="{{ $product->pname }}" class="product-image">
                                                </div>

                                                <div class="col-10">

                                                    <h3>{{ $product->pname }}</h3>
                                                    <label class="text-muted">ID: 
                                                        <span class="product_id">{{ $bid->product_id }}</span>
                                                    </label>
                                                    <label class="d-flex justify-content-end">Bid placed:
                                                        ${{ $bid->bid_price }}</label>
                                                    <label><span>{{ $bid->created_at->diffForHumans() }}</span></label>
                                                    @if ($product->status == 'Inactive')
                                                        <label
                                                            class="product_status d-flex justify-content-end">Ended</label>
                                                    @else
                                                        <label
                                                            class="product_status d-flex justify-content-end">Active</label>
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

        @else

            <div class="mx-auto errormsg">
                <h1 class="text-center">ACCESS DENIED!</h1>
            </div>

        @endif

    </div>

    @vite(['resources/js/bids.js'])
@endsection
