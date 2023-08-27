@extends('app')

@section('content')
    <h2 class="register_header">Register</h2>

     <!--Step 1: choose registering type-->
     @if ($currentStep==1)
     <div class="step card" id="Registering_Type_Content">
        <h3>Step 1 out of 4: Select registering type</h3>
        <form wire:submit.prevent="submit" >
            <div>
                <p>I want to bid on items!</p>
                <input type="radio" class="radio_item" wire:model="usertype" value="bidder" id="usertype_bidder">
                <label class="label_item" for="usertype_bidder"> <i class="fa-solid fa-bag-shopping"></i> </label>
            </div>
            <div>
                <p>I have items to sell!</p>
                <input type="radio" class="radio_item" wire:model="usertype" value="merchant" id="usertype_merchant">
                <label class="label_item" for="usertype_merchant"> <i class="fa-solid fa-tag"></i> </label>
            </div>
            <div>
                <p>I want to expertise items!</p>
                <input type="radio" class="radio_item" wire:model="usertype" value="auctioneer" id="usertype_auctioneer">
                <label class="label_item" for="usertype_auctioneer"> <i class="fa-solid fa-user-tie"></i> </label>
            </div>

              <button class="btn btn-outline-dark" type="submit">Next</button>
        </form>
    </div>
    @endif

    <!--Step 2: account information-->
    @if ($currentStep==2)
    <div class="step card" id="Account_Information_Content">
        <h3>Step 2 out of 4: Add account details</h3>
        <form wire:submit.prevent="submit" >
            <label>Enter a username</label>
            <input type="text" wire:model="username">
            <label>Enter email</label>
            <input type="email" wire:model="email">
            <label>Enter password</label>
            <input type="password" wire:model="password">
            <label>Confirm password</label>
            <input type="password" wire:model="password_confirmation">
            <button class="btn btn-outline-dark" wire:click="decreaseStep" type="button">Back</button>
            <button class="btn btn-outline-dark" type="submit">Next</button>
        </form>
    </div>
    @endif

    <!--Step 3: personal information-->
    @if ($currentStep==3)
    <div class="step card" id="Personal_Information_Content">
        <h3>Step 3 out of 4: Add personal details</h3>
        <form wire:submit.prevent="submit" >
            <label>First name</label>
            <input type="text" wire:model="first_name">
            <label>Last name</label>
            <input type="text" wire:model="last_name">
            <label>Birth date</label>
            <input type="date" wire:model="birth_date">
            <label>Contact number</label>
            <input type="text" wire:model="contact_number">
            <button class="btn btn-outline-dark" wire:click="decreaseStep" type="button">Back</button>
            <button class="btn btn-outline-dark" type="submit">Next</button>
        </form>
    </div>
    @endif

    <!--Step 4: location information-->
    @if ($currentStep==4)
    <div class="step card" id="Location_Information_Content">
        <h3>Step 4 out of 4: Add location details</h3>
        <form wire:submit.prevent="submit">
            <label>Street</label>
            <input type="text" wire:model="street">
            <label>City</label>
            <input type="text" wire:model="city">
            <label>Postal/Zip Code</label>
            <input type="text" wire:model="postal_code">
            <label>Country</label>
            <input type="text" wire:model="country">
            <button class="btn btn-outline-dark" wire:click="decreaseStep" type="button">Back</button>
            <button class="btn btn-outline-dark" type="submit">Next</button>
        </form>
    </div>
@endif
    <!-- Confirming user registration -->
    <div class="step card" id="Confirmation">
        <p>Agree to terms and conditions</p>
        @if ($currentStep == 4)
            <label>
                <input type="checkbox" wire:model="terms"> I agree to the terms and conditions
            </label>
        @endif
        <p>Success of registration</p>
        <p>In the case of an auctioneer, need to wait for admin approval</p>
    </div>

    @vite(['resources/js/register.js'])
@endsection
