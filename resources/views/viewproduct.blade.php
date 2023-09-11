@php
    $enddate = $product->enddate;
    
    $Date = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $enddate)->format('d M Y');
    $Time = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $enddate)->format('H:i');
    
@endphp

@extends('app')

@section('content')
    <div id="viewproduct_content">


        <div class="row row-cols-2">

            <div class="col">
                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->pname }}" class="product_image">
            </div>

            <div class="col">

                <div class="card">
                    <h4 class="pname_title">{{ $product->pname }} <span class="text-muted productid_label">(ID: <span
                                id="productID">{{ $product->Product_ID }}</span>)</span></h4>
                    <p class="title"><span class="text-muted">By</span> 
                        <a class="merchant_username"
                            href="{{ route('viewuser', ['username' => $product->seller->username]) }}">{{ $product->seller->username }}
                        </a>
                    </p>

                    <label class="smol_label text-muted">Category</label>
                    <p>{{ $product->category }}</p>

                    <label class="smol_label text-muted">Description</label>
                    <p>{{ $product->pdesc }}</p>

                    <label class="smol_label text-muted">Current bid</label>
                    <p id="current_bid">${{ $product->currentprice }}</p>

                    <p><span class="text-muted">Ends on</span> {{ $Date }} <span class="text-muted">at</span>
                        {{ $Time }}</p>

                    <div class="button-container mx-auto">
                        <button class="btn" title="Current bid count" id="bid_count_btn"><span
                                id="count_btn">{{ $product->bidcount }}</span> <i class="fa-solid fa-gavel"></i></button>

                        <!-- Button trigger modal -->
                        @auth
                            @if (auth()->user()->usertype == 'bidder' && now(4) < $product->enddate)
                                <button type="button" class="btn button" data-toggle="modal" data-target="#place_bid_modal">
                                    Bid Now!
                                </button>
                            @endif
                        @endauth
                        @guest
                            <form action="{{ route('login') }}" method="get">
                                <button type="submit" class="btn button" title="Log in to bid">
                                    Bid Now!
                                </button>
                            </form>
                        @endguest

                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="place_bid_modal" tabindex="-1" role="dialog">

                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">

                                <div class="modal-body">
                                    <h5 class="modal_title">Place your bid on item: </h5>
                                    <div class="d-flex justify-content-center">
                                        <form action="{{ route('place-bid', ['id' => $product->Product_ID]) }}"
                                            method="POST" id="add_bid">
                                            @csrf
                                            <h4>{{ $product->pname }}</h4>
                                            <p>Current Highest Bid: ${{ $product->currentprice }}</p>
                                            <label for="bid_now">Your Bid: </label>
                                            <input type="number" name="bid_price" class="bid_input form-control underline"
                                                placeholder="$" id="bid_now">
                                            <p id="display_error" class="errormsg"></p>
                                            <div class="d-flex justify-content-end">
                                                <button id="place_bid_btn" type="submit" class="btn button"
                                                    title="Place bid"><i class="fa-solid fa-gavel"></i></button>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>

            </div>

        </div>

    </div>



    @vite(['resources/js/viewproduct.js'])
@endsection
