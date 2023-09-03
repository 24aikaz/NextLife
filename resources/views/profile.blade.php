@extends('app')

@section('content')
    <div id="profile_content">

        <div class="card profiledetails_card mx-auto">
            <h3>{{ auth()->user()->first_name }} {{ auth()->user()->last_name }}
                <span id="usertype_span">({{ auth()->user()->usertype }})</span>
            </h3>
            <label>Username</label>
            <p>{{ auth()->user()->username }}</p>
            <label>Email</label>
            <p>{{ auth()->user()->email }}</p>
            <label>Contact Number</label>
            <p>{{ auth()->user()->contact_number }}</p>
            <label>Address</label>
            <p>{{ auth()->user()->street }}, {{ auth()->user()->city }}
                <br>
                {{ auth()->user()->country }} {{ auth()->user()->postal_code }}
            </p>
        </div>

        <div class="card profile_registered_card mx-auto">
            <p>Registered on: </p>
        </div>

        @if (auth()->user()->usertype == 'merchant')
                <form class="d-flex justify-content-center" action="{{ route('product') }}" method="GET">
                    <Button class="btn btn-outline-dark" title="Add product for sale!"><i
                            class="fa-solid fa-plus"></i></Button>
                </form>
        @endif

        @if (auth()->user()->usertype == 'bidder')
            <div class="card temp mx-auto">
                <p>Hey if you can see this then you're definitely a bidder!</p>
            </div>
        @endif

    </div>

    @vite(['resources/js/profile.js'])
@endsection
