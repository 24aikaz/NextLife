@extends('app')

@section('content')
<section>
    <h1>Congratulations, {{ $bidder_username }}!</h1>
    <p>You have won the bid for the product with ID {{ $product_id }}.</p>
    <p>Price: ${{ $price }}</p>

    <h2>Select Payment Method:</h2>
    <form method="post" action="{{ route('checkout') }}">
        @csrf <!-- Add CSRF token for security -->
        <label for="paymentMethodVisa">Visa Card</label>
        <input type="radio" id="paymentMethodVisa" name="payment_method" value="Visa Card" required>
        <br>
        <label for="paymentMethodPayPal">PayPal</label>
        <input type="radio" id="paymentMethodPayPal" name="payment_method" value="PayPal" required>
        <br>
        <!-- Add more payment methods if needed -->
        <input type="submit" value="Submit">
    </form>
</section>


   @vite(['resources/js/viewproduct.js']) 
  @endsection