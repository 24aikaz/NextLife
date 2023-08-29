@extends('app')

@section('content')
    <div id="auctions_content">
        <h2>Auctions</h2>

        <div class="container">

            {{-- formatting 2 columns per row automatically --}}
            <div class="row row-cols-2">

                <div class="col">
                    <div class="card">Item1</div>
                </div>

                <div class="col">
                    <div class="card">Item2</div>
                </div>

                <div class="col">
                    <div class="card">Item3</div>
                </div>

            </div>

        </div>

        @vite(['resources/js/register.js'])
        
    </div>

@endsection
