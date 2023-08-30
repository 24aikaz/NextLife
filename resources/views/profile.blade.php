@extends('app')

@section('content')
    <div id="profile_content">
        <p>Profile details will appear here</p>
        <p>User: {{ auth()->user()->first_name}} {{ auth()->user()->last_name}}</p>


        <form action="{{ route('product') }}" method="GET">
            <Button title="Add product for sale!"><i class="fa-solid fa-plus"></i></Button>
        </form>

    </div>

    @vite(['resources/js/profile.js'])

@endsection
