@extends('app')

@section('content')
    <div>

        <!-- Registering with steps for better user experience -->
        {{-- credits for template: https://levelup.gitconnected.com/create-a-multi-step-form-using-html-css-and-javascript-30aca5c062fc --}}

        <h2 class="register_header">Register</h2>

        <div id="multi-step-form-container">

            <!-- Form Steps / Progress Bar -->
            <ul class="form-stepper form-stepper-horizontal">
                <!-- Step 1 -->
                <li class="form-stepper-active form-stepper-list" step="1">
                    <a>
                        <span class="form-stepper-circle">
                            <span>1</span>
                        </span>
                        <div>Registering Type</div>
                    </a>
                </li>
                <!-- Step 2 -->
                <li class="form-stepper-unfinished form-stepper-list" step="2">
                    <a>
                        <span class="form-stepper-circle text-muted">
                            <span>2</span>
                        </span>
                        <div class="text-muted">Basic Account Details</div>
                    </a>
                </li>
                <!-- Step 3 -->
                <li class="form-stepper-unfinished form-stepper-list" step="3">
                    <a>
                        <span class="form-stepper-circle text-muted">
                            <span>3</span>
                        </span>
                        <div class="text-muted">Personal Details</div>
                    </a>
                </li>
                <!-- Step 4 -->
                <li class="form-stepper-unfinished form-stepper-list" step="4">
                    <a>
                        <span class="form-stepper-circle text-muted">
                            <span>4</span>
                        </span>
                        <div class="label text-muted">Location Details</div>
                    </a>
                </li>
                <!-- Confirmation -->
                <li class="form-stepper-unfinished form-stepper-list" step="5">
                    <a>
                        <span class="form-stepper-circle text-muted">
                            <span>5</span>
                        </span>
                        <div class="text-muted">Confirmation</div>
                    </a>
                </li>
            </ul>



            <!-- Step Wise Form Content -->
            <form id="registration_form" action="{{ route('register') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Step 1 Content -->
                <section id="step-1" class="form-step">
                    <h3>Choose your registration type</h3>
                    <!-- Step 1 input fields -->
                    <div class="d-flex">
                        <div>
                            <p>I want to bid on items!</p>
                            <input type="radio" class="radio_item" value="bidder" name="usertype" id="usertype_bidder">
                            <label class="label_item gentle-hover-shake" for="usertype_bidder"> <i
                                    class="fa-solid fa-bag-shopping"></i> </label>
                        </div>
                        <div>
                            <p>I have items to sell!</p>
                            <input type="radio" class="radio_item" value="merchant" name="usertype"
                                id="usertype_merchant">
                            <label class="label_item gentle-hover-shake" for="usertype_merchant"> <i
                                    class="fa-solid fa-tag"></i>
                            </label>
                        </div>
                        <div>
                            <p>I want to expertise items!</p>
                            <input type="radio" class="radio_item" value="auctioneer" name="usertype"
                                id="usertype_auctioneer">
                            <label class="label_item gentle-hover-shake" for="usertype_auctioneer"> <i
                                    class="fa-solid fa-user-tie"></i> </label>
                        </div>
                    </div>
                    <div>
                        <button class="button btn-navigate-form-step" type="button" step_number="2">Next</button>
                    </div>
                </section>

                <!-- Step 2 Content, default hidden on page load. -->
                <section id="step-2" class="form-step d-none">
                    <h3>Set up your account credentials</h3>
                    <!-- Step 2 input fields -->
                    <div>
                        <label>Enter a username</label>
                        <input type="text" name="username">
                        <label>Enter email</label>
                        <input type="email" name="email">
                        <label>Enter password</label>
                        <input type="password" name="password">
                        <label>Confirm password</label>
                        <input type="password" name="password_confirmation">
                    </div>
                    <div>
                        <button class="button btn-navigate-form-step" type="button" step_number="1">Prev</button>
                        <button class="button btn-navigate-form-step" type="button" step_number="3">Next</button>
                    </div>
                </section>

                <!-- Step 3 Content, default hidden on page load. -->
                <section id="step-3" class="form-step d-none">
                    <h3>Add your personal details</h3>
                    <!-- Step 3 input fields -->
                    <div>
                        <label>First name</label>
                        <input type="text" name="first_name">
                        <label>Last name</label>
                        <input type="text" name="last_name">
                        <label>Birth date</label>
                        <input type="date" name="birth_date">
                        <label>Contact number</label>
                        <input type="text" name="contact_number">
                    </div>
                    <div>
                        <button class="button btn-navigate-form-step" type="button" step_number="2">Prev</button>
                        <button class="button btn-navigate-form-step" type="button" step_number="4">Next</button>
                    </div>
                </section>

                <!-- Step 4 Content, default hidden on page load. -->
                <section id="step-4" class="form-step d-none">
                    <h3>Add your location details</h3>
                    <!-- Step 4 input fields -->
                    <div>
                        <label>Street</label>
                        <input type="text" name="street">
                        <label>City</label>
                        <input type="text" name="city">
                        <label>Postal/Zip Code</label>
                        <input type="text" name="postal_code">
                        <label>Country</label>
                        <input type="text" name="country">
                    </div>
                    <div>
                        <button class="button btn-navigate-form-step" type="button" step_number="3">Prev</button>
                        <button class="button btn-navigate-form-step" type="button" step_number="5">Next</button>
                    </div>
                </section>

                <!-- Step 5 Content, default hidden on page load. -->
                <section id="step-5" class="form-step d-none">
                    <h3>Confirm your registration</h3>
                    <!-- Step 5 input fields -->
                    <div>
                        <p>Agree to terms and conditions</p>
                        <p>Success of registration</p>
                        <p>Case of auctioneer, need to wait for admin approval</p>
                    </div>
                    <div>
                        <button class="button btn-navigate-form-step" type="button" step_number="4">Prev</button>
                        <button class="button submit-btn" type="submit">Save</button>
                    </div>
                </section>

            </form>

        </div>

    </div>

    @vite(['resources/js/register.js'])
@endsection
