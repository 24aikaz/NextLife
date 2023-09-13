@php
    use Opis\JsonSchema\{Validator, ValidationResult, Helper};
@endphp

@extends('app')

@section('content')
    <div id="feedback_content">

        <div id="MainView" class="center">

            <h2 class="title text-center">What brings you here today? </h2>

            <div id="button_containers">
                <button id="suggestion_btn" class="btn button">
                    Leave Suggestion
                </button>

                <button id="rate_btn" class="btn button">
                    Rate Website
                </button>

                <button id="problem_btn" class="btn button">
                    Report Problem
                </button>
            </div>

            <div class="d-flex justify-content-center">
                {{-- <form action="" method="get">
                    @csrf --}}
                    <button id="generate_list" class="btn list_btn" title="Generate list of feedbacks"
                    data-toggle="modal" data-target="#feebacklist_modal">
                        <i class="fa-regular fa-file-lines"></i>
                    </button>
                {{-- </form> --}}
            </div>

        </div>

        <div id="suggestion" class="feedback_form">
            <form id="suggestion_form" action="{{ url('api/leavefeedback', ['username' => auth()->user()->id]) }}"
                method="post">
                @csrf
                <label id="type1" hidden>suggestion</label>

                <h3 class="title text-center">We'd be happy to hear your suggestion!</h3>

                <label for="category">Category</label>

                <select name="category-dropdown" id="category" class="form-control somethinginput underline">
                    <option value="">Click to choose option</option>
                    <option value="user interface">User Interface</option>
                    <option value="auction experience">Auction Experience</option>
                    <option value="payment process">Payment Process</option>
                    <option value="communication">Communication</option>
                    <option value="other">Other</option>
                </select>

                <label for="comment">Provide us with more details:</label>
                <textarea name="comment" id="suggestion_comment" class="form-control somethinginput underline" cols="30"
                    rows="5"></textarea>

                <div class="d-flex justify-content-center">
                    <button id="submit_suggestion" class="btn button  submit">
                        Submit
                    </button>
                </div>

            </form>

            <div class="d-flex justify-content-center">
                <button class="cancel btn">Nevermind</button>
            </div>
        </div>

        <div id="rating" class="feedback_form">
            <form id="rating_form" action="{{ url('api/leavefeedback', ['username' => auth()->user()->id]) }}"
                method="post">
                @csrf
                <label id="type2" hidden>rating</label>

                <h3 class="title text-center">Tell us how you feel when using our website!</h3>

                <label for="stars">Stars:</label>
                <select name="stars-dropdown" id="stars" class="form-control somethinginput underline">
                    <option value="">Click to choose option</option>
                    <option value="0">0</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>

                <label for="comment">Provide us with more details:</label>
                <textarea name="comment" id="rating_comment" class="form-control somethinginput underline" cols="30"
                    rows="5"></textarea>

                <div class="d-flex justify-content-center">
                    <button id="submit_rating" class="btn button submit">
                        Submit
                    </button>
                </div>

            </form>

            <div class="d-flex justify-content-center">
                <button class="cancel btn">Nevermind</button>
            </div>
        </div>

        <div id="problem" class="feedback_form">
            <form id="problem_form" action="{{ url('api/leavefeedback', ['username' => auth()->user()->id]) }}"
                method="post">
                @csrf
                <label id="type3" hidden>problem</label>

                <h3 class="title text-center">Tell us your problem so we can help you!</h3>

                <label for="frequency">How often it happened?</label>
                <select name="frequency-dropdown" id="frequency" class="form-control somethinginput underline">
                    <option value="">Click to choose option</option>
                    <option value="once">Once</option>
                    <option value="often">Quite often</option>
                    <option value="always">Always</option>
                </select>

                <label for="comment">Provide us with more details:</label>
                <textarea name="comment" id="problem_comment" class="form-control somethinginput underline" cols="30"
                    rows="5"></textarea>

                <div class="d-flex justify-content-center">
                    <button id="submit_problem" class="btn button submit">
                        Submit
                    </button>
                </div>

            </form>

            <div class="d-flex justify-content-center">
                <button class="cancel btn">Nevermind</button>
            </div>
        </div>

    </div>



    <!-- Modal -->
    <div class="modal fade" id="feebacklist_modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    @vite(['resources/js/feedback.js'])
@endsection
