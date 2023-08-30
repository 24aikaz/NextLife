@extends('app')

@section('content')
    <div id="auctions_content">
        <h2>Auctions</h2>

        <div class="container">

            @if ($products->count())
                {{-- formatting 2 columns per row automatically --}}
                <div class="row row-cols-2">

                    @foreach ($products as $product)
                   
                    <div class="col">
                        
                        <a href="{{ route('viewproduct') }}" class='card-link'>

                            <div class="card">
                                <h3>{{ $product->pname }}</h3>
                                <p>{{ $product->pdesc }}</p>
                                <h4>{{ $product->user->first_name }}</h4>
                                <h5>$ {{ $product->currentprice }}</h5>
                            </div>

                        </a> 

                    </div>
                    
                    @endforeach

                </div>
            @else
                <p>There are currently no active auctions.</p>
            @endif

        </div>

        @vite(['resources/js/auctions.js'])

    </div>
@endsection
