@extends('app')

@section('content')
    <!--Registering with steps for better user experience-->
    <h2 class="register_header">Register</h2>

    <!--Step 1: choose registering type-->
    <div class="card" id="Registering_Type_Content">
        <h3>Select registering type</h3>
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
    <div class="card" id="Account_Information_Content">
        <h3>Account details</h3>
        <form action=" /register" method= "POST">
            @csrf
            <label>Enter a username</label>
            <input name=username type="text">
            <label>Enter email</label>
            <input name=email type="email">
            <label>Enter password</label>
            <input name=password type="password">
            <label>Confirm password</label>
            <input type="password">
            <input type="submit" value="Next">
        </form>
    </div>

    <!--Step 3: personal information-->
    <div class="card" id="Personal_Information_Content">
        <h3>Personal details</h3>
        <form action=" /register" method= "POST">
            @csrf
            <label>name</label>
            <input name=name type="text">
            <label>Last name</label>
            <input name=last_name type="text">
            <label>Birth date</label>
            <input name=birth_date type="date">
            <label>Contact number</label>
            <input type="text">
            <input type="number">
            <label>Security question</label>
            <select name="questions" id="security_questions">
                <option value="">Choose</option>
                <option value="Q1">q1</option>
                <option value="Q2">q2</option>
                <option value="Q3">q3</option>
                <option value="Q4">q4</option>
                <option value="Q5">q5</option>
                <option value="Q6">q6</option>
                <option value="Q7">q7</option>
                <option value="Q8">q8</option>
                <option value="Q9">q9</option>
                <option value="Q10">q10</option>
            </select>
            <label>Security answer</label>
            <input type="text">
            <input type="submit" value="Next">
        </form>
    </div>

    <!--Step 4: location information-->
    <div class="card" id="Location_Information_Content">
        <h3>Location details</h3>
        <form action=" /register" method= "POST">
            @crsf
            <label>Street</label>
            <input name=street type="text">
            <label>City</label>
            <input name=city type="text">
            <label>Postal/Zip Code</label>
            <input name=postal_code type="text">
            <label>Country</label>
            <input type="text">
            <input type="submit" value="Next">
        </form>
    </div>

    @vite(['resources/js/register.js'])
@endsection
