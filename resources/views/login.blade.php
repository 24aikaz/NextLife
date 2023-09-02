@extends('app')

@section('content')
    <div id="login_container">

        <form id="LogIn_Form" action="{{ route('login') }}" method="POST">

            @csrf

            <div id="LogIn_Form_Content" class="card">

                <h2 class="title text-center">Log in</h2>

                @if (session('status'))
                    <div class="loginfail">
                        <i class="fa-solid fa-triangle-exclamation"></i> {{ session('status') }}
                    </div>
                @endif

                <Label class="toppad" for="login_username">Username:</Label>
                <input class="login_input underline" name="username" id="login_username" type="text"
                    value="{{ old('username') }}" placeholder="Enter your username" autocomplete="off">
                @error('username')
                    <div class="errormsg">
                        {{ $message }}
                    </div>
                @enderror

                <Label class="toppad" for="login_pwd">Password:</Label>
                <input class="login_input underline" name="password" id="login_pwd" type="password"
                    value="{{ old('password') }}" placeholder="Enter your password">
                @error('password')
                    <div class="errormsg">
                        {{ $message }}
                    </div>
                @enderror

                <div class="form-check toppad">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember" checked
                        title="We will remember you next time you come!">
                    <label for="remember">Remember me</label>
                </div>

                <button id="login_btn" class="btn" type="submit">Log In</button>

                <p class="text-center">No account yet? <a class="clickable_stuff registernow"
                        href="{{ route('register') }}">Register Now</a></p>

            </div>

        </form>
    </div>

    @vite(['resources/js/login.js'])
@endsection
