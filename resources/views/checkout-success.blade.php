@extends('app')

@section('content')
    <div id="success-content" class="center text-center">
        <h2 id="title" class="">Success</h2>

        <h3>Thank you @<span>{{ $username }}</span>,
            <br>
            your payment was successful.
        </h3>

        <div class="d-flex justify-content-center">
            <a href="{{ route('home') }}" class="btn button underline_middle">
                Back to Home
            </a>
        </div>

    </div>

    @vite(['resources/js/success-checkout.js'])
@endsection
