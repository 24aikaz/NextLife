@extends('app')

@section('content')
    <!-- Registering with steps for better user experience -->
    <h2 class="register_header">Register</h2>
    
    <form id="registration_form" action="{{ route('register') }}" method="POST">
        @csrf

        <!-- Step 1: choose registering type -->
        <div class="step card" id="Registering_Type_Content">
            <h3>Step 1 out of 4: Select registering type</h3>
            <div>
                <p>I want to bid on items!</p>
                <input type="radio" class="radio_item" value="" name="usertype" id="usertype_bidder">
                <label class="label_item gentle-hover-shake" for="usertype_bidder"> <i class="fa-solid fa-bag-shopping"></i> </label>
            </div>
            <div>
                <p>I have items to sell!</p>
                <input type="radio" class="radio_item" value="" name="usertype" id="usertype_merchant">
                <label class="label_item gentle-hover-shake" for="usertype_merchant"> <i class="fa-solid fa-tag"></i> </label>
            </div>
            <div>
                <p>I want to expertise items!</p>
                <input type="radio" class="radio_item" value="" name="usertype" id="usertype_auctioneer">
                <label class="label_item gentle-hover-shake" for="usertype_auctioneer"> <i class="fa-solid fa-user-tie"></i> </label>
            </div>

            <button class="btn btn-outline-dark">Next</button>
        </div>

        <!-- Step 2: account information -->
        <div class="step card" id="Account_Information_Content">
            <h3>Step 2 out of 4: Add account details</h3>
            <label>Enter a username</label>
            <input type="text" name="username">
            <label>Enter email</label>
            <input type="email" name="email">
            <label>Enter password</label>
            <input type="password" name="password">
            <label>Confirm password</label>
            <input type="password" name="password_confirmation">
            <button type="button" class="btn btn-info">Previous</button>
            <button class="btn btn-outline-dark">Next</button>
        </div>

        <!-- Step 3: personal information -->
        <div class="step card" id="Personal_Information_Content">
            <h3>Step 3 out of 4: Add personal details</h3>
            <label>First name</label>
            <input type="text" name="name"> <!-- Change the name attribute to "name" -->
            <label>Last name</label>
            <input type="text" name="last_name">
            <label>Birth date</label>
            <input type="date" name="birth_date">
            <label>Contact number</label>
            <input type="text" name="contact_number">
            <button type="button" class="btn btn-info">Previous</button>
            <button class="btn btn-outline-dark">Next</button>
        </div>
        
        <!-- Step 4: location information -->
        <div class="step card" id="Location_Information_Content">
            <h3>Step 4 out of 4: Add location details</h3>
            <label>Street</label>
            <input type="text" name="street">
            <label>City</label>
            <input type="text" name="city">
            <label>Postal/Zip Code</label>
            <input type="text" name="postal_code">
            <label>Country</label>
            <input type="text" name="country">
            <button type="button" class="btn btn-info">Previous</button>
            <button class="btn btn-outline-dark">Next</button>
        </div>

        <!-- Confirming user registration -->
        <div class="step card" id="Confirmation">
            <p>Agree to terms and conditions</p>
            <p>Success of registration</p>
            <p>Case of auctioneer, need to wait for admin approval</p>
            <button type="button" class="btn btn-info">Previous</button>
            <input class="btn btn-outline-dark" type="submit" value="Confirm">
        </div>

    </form>

    @vite(['resources/js/register.js'])
@endsection