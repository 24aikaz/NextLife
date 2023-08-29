@extends('app')

@section('content')
    <div id="profile_content">
        <p>Profile details will appear here</p>
        <p>User: {{ auth()->user()->first_name}} {{ auth()->user()->last_name}}</p>
    </div>

    @vite(['resources/js/profile.js'])

@endsection
