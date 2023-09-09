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
                    <h4>{{ $product->pname }} <span class="text-muted">(ID: <span
                                id="productID">{{ $product->Product_ID }}</span>)</span></h4>
                    <p><span class="text-muted">By</span> {{ $product->seller->username }}</p>

                    <label class="text-muted">Category</label>
                    <p>{{ $product->category }}</p>

                    <label class="text-muted">Description</label>
                    <p>{{ $product->pdesc }}</p>

                    <label class="text-muted">Current bid</label>
                    <p id="current_bid">${{ $product->currentprice }}</p>

                    <p><span class="text-muted">Ends on</span> {{ $Date }} <span class="text-muted">at</span>
                        {{ $Time }}</p>

                    <div class="button-container mx-auto">
                        <button class="btn btn-outline-dark" title="Current bid count" id="bid_count_btn"><span
                                id="count_btn">{{ $product->bidcount }}</span> <i class="fa-solid fa-gavel"></i></button>

                        <!-- Button trigger modal -->
                        @auth
                            @if (auth()->user()->usertype == 'bidder')
                                <button type="button" class="btn btn-outline-dark" data-toggle="modal"
                                    data-target="#place_bid_modal">
                                    Bid Now!
                                </button>
                            @else
                                <button type="button" class="btn btn-outline-dark" title="You cannot bid">
                                    Ineligible
                                </button>
                            @endif
                        @endauth
                        @guest
                            <form action="{{ route('login') }}" method="get">
                                <button type="submit" class="btn btn-outline-dark" title="Log in to bid">
                                    Bid Now!
                                </button>
                            </form>
                        @endguest

                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="place_bid_modal" tabindex="-1" role="dialog">

                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">

                                <div class="modal-header">
                                    <h5 class="modal-title" id="place_bid_title">Place bid on product</h5>
                                    <button type="button" class="btn close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>

                                <div class="modal-body">
                                    <div class="d-flex justify-content-center">
                                        <form action="{{ route('place-bid', ['id' => $product->Product_ID]) }}"
                                            method="POST" id="add_bid">
                                            @csrf
                                            <h4>{{ $product->pname }}</h4>
                                            <p>Originally set at ${{ $product->startprice }} while the current bid is at
                                                ${{ $product->currentprice }}.</p>
                                            <label for="bid_now">Bid: </label>
                                            <input type="number" name="bid_price" class="bid_input" placeholder="$"
                                                id="bid_now">
                                            <button id="place_bid_btn" type="submit"
                                                class="btn btn-outline-dark">Bid</button>
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
