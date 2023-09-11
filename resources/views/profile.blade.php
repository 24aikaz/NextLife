@extends('app')

@php
    $carbonDate = \Carbon\Carbon::parse(auth()->user()->created_at);
    $formattedDate = $carbonDate->format('F Y');
@endphp

@section('content')
    <div id="profile_content">

        <h2 class="page_title">Profile</h2>

        <div class="card profiledetails_card mx-auto">
            <h3>{{ auth()->user()->first_name }} {{ auth()->user()->last_name }}
                <span id="usertype_span">({{ auth()->user()->usertype }})</span>
            </h3>
            <label>Username</label>
            <p>{{ auth()->user()->username }}</p>
            <label>Email</label>
            <p>{{ auth()->user()->email }}</p>
            <label>Contact Number</label>
            <p>{{ auth()->user()->contact_number }}</p>
            <label>Address</label>
            <p>{{ auth()->user()->street }}, {{ auth()->user()->city }}
                <br>
                {{ auth()->user()->country }} {{ auth()->user()->postal_code }}
            </p>
            <label>Member Since</label>
            <p>{{ $formattedDate }}</p>

            <div class="d-flex justify-content-end">
                <button class="btn" title="Edit profile info" data-toggle="modal" data-target="#updateUserInfo">
                    <i class="fa-solid fa-user-pen"></i>
                </button>
            </div>

        </div>

        @if (auth()->user()->usertype == 'bidder')
            <div class="card temp mx-auto">
                <p>Hey if you can see this then you're definitely a bidder!</p>
            </div>
        @endif

        @if (auth()->user()->usertype == 'merchant')
            <div class="card temp mx-auto">
                <p>Wow you sell cool stuff!</p>
            </div>
        @endif

        <div class="d-flex justify-content-center">
            <form id="DeleteForm" action="{{ url('api/user', ['username' => auth()->user()->username]) }}" method="POST">
                @csrf
                @method('DELETE')
                <button class="btn delete_btn" title="Delete Account">
                    <i class="fa-solid fa-trash-can"></i>
                </button>
            </form>
        </div>

    </div>

    <!-- Update User Info Modal -->
    <div class="modal fade" id="updateUserInfo" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <form id="UpdateForm" action="{{ url('api/user', ['username' => auth()->user()->username]) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="modal-header">
                        <h5 class="modal-title" id="">
                            Edit Profile
                        </h5>
                    </div>

                    <div class="modal-body">

                        <label for="edit_email">Email:</label>
                        <input name="edit_email" type="email" id="edit_email" autocomplete="off" class="form-control"
                            value="{{ auth()->user()->email }}">

                        <label for="edit_num">Contact Number</label>
                        <input name="edit_num" type="number" id="edit_num" autocomplete="off" class="form-control"
                            value="{{ auth()->user()->contact_number }}">

                        <label for="edit_street">Street:</label>
                        <input name="edit_street" type="text" id="edit_street" autocomplete="off" class="form-control"
                            value="{{ auth()->user()->street }}">

                        <label for="edit_city">City:</label>
                        <input name="edit_city" type="text" id="edit_city" autocomplete="off" class="form-control"
                            value="{{ auth()->user()->city }}">

                        <label for="edit_country">Country:</label>
                        <input name="edit_country" type="text" id="edit_country" autocomplete="off" class="form-control"
                            value="{{ auth()->user()->country }}">

                        <label for="edit_postcode">Postal/Zip Code</label>
                        <input name="edit_postcode" type="number" id="edit_postcode" autocomplete="off"
                            class="form-control" value="{{ auth()->user()->postal_code }}">

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn" data-dismiss="modal">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                        <button id="Submit_Changes" type="submit" class="btn">
                            <i class="fa-solid fa-check"></i>
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>

    @vite(['resources/js/profile.js'])
@endsection
