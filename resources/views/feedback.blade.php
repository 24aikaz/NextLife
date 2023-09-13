@php
    use Opis\JsonSchema\{Validator, ValidationResult, Helper};
@endphp

@extends('app')

@section('content')
    <div id="feedback_content">

        <div id="button_containers">

            <h2>What brings you here today? </h2>

            <button id="suggestion_btn">
                Leave Suggestion
            </button>

            <button id="rate_btn">
                Rate Website
            </button>

            <button id="problem_btn">
                Report Problem
            </button>

        </div>

        <div id="suggestion">
            <form id="suggestion_form" action="{{ url('api/leavefeedback', ['username' => auth()->user()->id]) }}"
                method="post">
                @csrf
                <label id="type1" hidden>suggestion</label>

                <label for="category">Category</label>

                <select name="pets" id="category">
                    <option value="">Choose option below</option>
                    <option value="user interface">User Interface</option>
                    <option value="auction experience">Auction Experience</option>
                    <option value="payment process">Payment Process</option>
                    <option value="communication">Communication</option>
                    <option value="other">Other</option>
                </select>

                <br>

                <label for="comment">Provide us with more details:</label>
                <textarea name="comment" id="suggestion_comment" cols="30" rows="5"></textarea>

                <button id="submit_suggestion">Submit</button>
            </form>
        </div>

        <div id="rating">
            <form id="rating_form" action="{{ url('api/leavefeedback', ['username' => auth()->user()->id]) }}"
                method="post">
                @csrf
                <label id="type2" hidden>rating</label>

                <label for="stars">Stars:</label>
                <select name="stars-dropdown" id="stars">
                    <option value="">Choose option below</option>
                    <option value="0">0</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>

                <br>

                <label for="comment">Provide us with more details:</label>
                <textarea name="comment" id="rating_comment" cols="30" rows="5"></textarea>

                <button id="submit_rating">Submit</button>

            </form>
        </div>

        <div id="problem">
            <form id="problem_form" action="{{ url('api/leavefeedback', ['username' => auth()->user()->id]) }}"
                method="post">
                @csrf
                <label id="type3" hidden>problem</label>

                <label for="frequency">How often it happened?</label>
                <select name="frequency-dropdown" id="frequency">
                    <option value="">Choose option below</option>
                    <option value="once">Once</option>
                    <option value="often">Quite often</option>
                    <option value="always">Always</option>
                </select>

                <br>

                <label for="comment">Provide us with more details:</label>
                <textarea name="comment" id="problem_comment" cols="30" rows="5"></textarea>

                <button id="submit_problem">Submit</button>

            </form>
        </div>

    </div>

    @vite(['resources/js/feedback.js'])
@endsection
