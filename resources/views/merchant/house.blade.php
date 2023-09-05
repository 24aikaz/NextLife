@extends('app')

@section('content')

    <div style="padding: 4rem 7rem">

        <p>This will show the products that only the current merchant has put on sale.</p>

        @if (auth()->user()->usertype == 'merchant')

            <form class="d-flex justify-content-end" action="{{ route('product') }}" method="GET">
                <Button class="btn btn-outline-dark" title="Add product for sale!"><i class="fa-solid fa-plus"></i></Button>
            </form>

            <h3>Items on sale:</h3>
            @if ($products->count())
                <div class="row row-cols-3">
                    @foreach ($products as $product)
                        <div class="col">
                            <a class="card-link" href="{{ route('viewproduct', ['Product_ID' => $product->Product_ID]) }}">
                                <div class="card">
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->pname }}"
                                        class="product-image">
                                    <h3 class="product_title">{{ $product->pname }}</h3>
                                    <h5>Current bid: $ {{ $product->currentprice }}</h5>
                                    <p>Countdown: {{ now()->diff($product->enddate)->format('%dd') }}</p>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            @else
                <p>You have no items on sale.</p>
            @endif
        @endif
    </div>

@endsection
