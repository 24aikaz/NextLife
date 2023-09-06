@extends('app')

@php
    $carbonDate = \Carbon\Carbon::parse(auth()->user()->created_at);
    $formattedDate = $carbonDate->format('F Y');
@endphp

@section('content')
    <div id="profile_content">

        <div class="profile_title_card card mx-auto">
            <h2 class="title text-center">Profile</h2>
        </div>

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
            <label>Member Since</label>
            <p>{{ $formattedDate }}</p>
        </div>

        @if (auth()->user()->usertype == 'bidder')
            <div class="card temp mx-auto">
                <p>Hey if you can see this then you're definitely a bidder!</p>
            </div>
        @endif

    </div>

    @vite(['resources/js/profile.js'])
@endsection
