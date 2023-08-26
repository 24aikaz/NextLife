@extends('app')

@section('content')
    <!--Registering with steps for better user experience-->
    <h2 class="register_header">Register</h2>

    <!--Step 1: choose registering type-->
    <div class="step card" id="Registering_Type_Content">
        <h3>Step 1 out of 4: Select registering type</h3>
        <form id="registering_type_form">
        <div>
            <p>I want to bid on items!</p>
            <input type="radio" class="radio_item" value="" name="usertype" id="usertype_bidder">
            <label class="label_item" for="usertype_bidder"> <i class="fa-solid fa-bag-shopping"></i> </label>
        </div>
        <div>
            <p>I have items to sell!</p>
            <input type="radio" class="radio_item" value="" name="usertype" id="usertype_merchant">
            <label class="label_item" for="usertype_merchant"> <i class="fa-solid fa-tag"></i> </label>
        </div>
        <div>
            <p>I want to expertise items!</p>
            <input type="radio" class="radio_item" value="" name="usertype" id="usertype_auctioneer">
            <label class="label_item" for="usertype_auctioneer"> <i class="fa-solid fa-user-tie"></i> </label>
        </div>

        <input class="btn btn-outline-dark" type="submit" value="Next">
    </form>
    </div>

    <!--Step 2: account information-->
    <div class="step card" id="Account_Information_Content">
        <h3>Step 2 out of 4: Add account details</h3>
        <form action="">
            <label>Enter a username</label>
            <input type="text">
            <label>Enter email</label>
            <input type="email">
            <label>Enter password</label>
            <input type="password">
            <label>Confirm password</label>
            <input type="password">

            <input class="btn btn-outline-dark" type="submit" value="Next">
        </form>
    </div>

    <!--Step 3: personal information-->
    <div class="step card" id="Personal_Information_Content">
        <h3>Step 3 out of 4: Add personal details</h3>
        <form action="">
            <label>First name</label>
            <input type="text">
            <label>Last name</label>
            <input type="text">
            <label>Birth date</label>
            <input type="date">
            <label>Contact number</label>
            <input type="text">
            <input type="number">

            <input class="btn btn-outline-dark" type="submit" value="Next">
        </form>
    </div>

    <!--Step 4: location information-->
    <div class="step card" id="Location_Information_Content">
        <h3>Step 4 out of 4: Add location details</h3>
        <form action="">
            <label>Street</label>
            <input type="text">
            <label>City</label>
            <input type="text">
            <label>Postal/Zip Code</label>
            <input type="text">
            <label>Country</label>
            <input type="text">

            <input class="btn btn-outline-dark" type="submit" value="Next">
        </form>
    </div>

    <!-- Confirming user registration -->
    <div class="step card" id="Confirmation">
        <p>Agree to terms and conditions</p>
        <p>sucess of registration</p>
        <p>case of auctioneer, need to wait for admin approval</p>
    </div>

    @vite(['resources/js/register.js'])
@endsection
