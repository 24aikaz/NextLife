@extends('app')

@section('content')

<h1>Success</h1>
<p>{{ $username }}</p>

<a href="{{ route('index') }}" class="btn btn-primary">Back to Home</a>

@vite(['resources/js/auctions.js'])

@endsection

