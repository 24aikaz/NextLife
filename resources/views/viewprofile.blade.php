@extends('app')

@section('content')
    <p id="carry_value" hidden>{{ $username }}</p>

    <div id="user_profile_content">

        <h2 class="user_page_title">Profile</h2>

        <div class="card profiledetails_card mx-auto">

            <h3 id="User_Fullname"></h3>

            <label>Username</label>
            <p id="User_Username"></p>

            <label>Email</label>
            <p id="User_Email"></p>

            <label>Contact Number</label>
            <p id="User_ContactNum"></p>

            <label>Address</label>
            <p id="User_Address"></p>

            <label>Member Since</label>
            <p id="User_Member"></p>

        </div>

    </div>


    @vite(['resources/js/viewprofile.js'])
@endsection
