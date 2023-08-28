@extends('app')

@section('content')
    <div id="login_container">

        <h2>Log In</h2>

        <form id="LogIn_Form" action="{{ route('login') }}" method="POST">

            @csrf

            <div id="LogIn_Form_Content" class="card">

                @if (session('status'))
                    <div class="errormsg">
                        {{ session('status') }}
                    </div>
                @endif

                <Label for="login_username">Username:</Label>
                <input name="username" id="login_username" type="text" value="{{ old('username') }}"
                    placeholder="Enter your username">
                @error('username')
                    <div class="errormsg">
                        {{ $message }}
                    </div>
                @enderror

                <Label for="login_pwd">Password:</Label>
                <input name="password" id="login_pwd" type="password" value="{{ old('password') }}"
                    placeholder="Enter your password">
                @error('password')
                    <div class="errormsg">
                        {{ $message }}
                    </div>
                @enderror

                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember" checked>
                    <label for="remember">Remember me</label>
                </div>

                {{-- <input id="login_btn" class="btn" type="submit" value="Log In"> --}}
                <button id="login_btn" class="btn" type="submit">Log In</button>

                <p>No account yet? <a class="clickable_stuff" href="{{ route('register') }}">Register Now</a></p>

            </div>

        </form>
    </div>

    @vite(['resources/js/login.js'])
@endsection
