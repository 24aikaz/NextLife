@extends('app')

@section('content')
    <div id="payment_content">

        <div class="payment_title_card card mx-auto">
            <h2 class="title text-center">Payment</h2>
        </div>

        <form method="post" action="{{ route('checkout') }}">
            @csrf

            <label for="paymentMethodVisa">Visa Card</label>
            <input class="form-check" type="radio" id="paymentMethodVisa" name="payment_method" value="Visa Card" required>
            <br>

            <label for="paymentMethodPayPal">PayPal</label>
            <input class="form-check" type="radio" id="paymentMethodPayPal" name="payment_method" value="PayPal" required>
            <br>

            <!-- Add more payment methods if needed -->
            <input class="btn btn-outline-dark" type="submit" value="Submit">
        </form>

    </div>

    @vite(['resources/js/payment.js'])
@endsection
