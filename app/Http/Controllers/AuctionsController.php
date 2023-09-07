<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Auction;
use App\Models\Bid;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class AuctionsController extends Controller
{
    public function index()
    {
        $products = Product::get();
        // dd($products);

        return view('auctions', [
            'products' => $products  // Passing the products collection along for the view
        ]);

    }

    public function checkWinners(Request $request)
{
    // Get all active products that have reached their end date and have no winner
    $products = Product::where('status', 'active')
        ->where('enddate', '<=', now())
        ->whereNull('winner')
        ->get();

    if ($products->isEmpty()) {
        // If there are no products to be won, return a response with a message
        return response()->json(['message' => 'No products available for winner selection.']);
    }

    foreach ($products as $product) {
        $winningBid = Bid::where('product_id', $product->Product_ID)
            ->orderBy('bid_price', 'desc')
            ->first();

        if ($winningBid) {
            // Update product information
            $product->status = 'Inactive';
            $product->winner = $winningBid->bidder_id;
            $product->winning_bid = $winningBid->bid_price;
            $product->save();

            // Create a new entry in the auctions table
            Auction::create([
                'sellername' => $product->seller_id,
                'Winner_ID' => $product->winner,
                'Product_ID' => $product->Product_ID,
                'Win_Price' => $product->winning_bid,
                'Start_Date' => $product->startdate,
                'End_Date' => $product->enddate,
            ]);
        }
    }

    // Return a response with a success message
    return response()->json(['message' => 'Winners selected successfully', 'redirect' => '/paymentmethod']);
}


    public function checkout(Request $request)
    {
        // Get the logged-in user
        $user = auth()->user();

        // Check if the user is a bidder
        if ($user->usertype === 'bidder') {
            // Check if the bidder has won a bid
            $transaction = Transaction::where('Bidder_ID', $user->id)->first();

            if ($transaction) {
                // Retrieve additional data from related models
                $product = $transaction->product;
                $seller = $product->seller;

                // Check if the form is submitted (when the bidder selects the payment method)
                if ($request->isMethod('post')) {
                    // Get the selected payment method from the form submission
                    $payment_method = $request->input('payment_method');

                    // Create a new transaction
                    $newTransaction = new Transaction([
                        'Product_ID' => $product->id,
                        'Bidder_ID' => $user->id,
                        'Seller_ID' => $seller->id,
                        'Price' => $product->Win_Price,
                        'Payment_Method' => $payment_method,
                        'Seller_Address' => $seller->address,
                        'Bidder_Address' => $user->address, // Assuming you have an 'address' column in the 'users' table
                    ]);

                    if ($newTransaction->save()) {
                        // Display the congratulations message
                        return "Congratulations, {$user->username}! You have successfully bought the product.";
                    } else {
                        return "Error inserting transaction data.";
                    }
                }

                // Display the checkout form
                return view('transactions');
            }
        }

        // Handle the case where the user is not a bidder or has not won any bids
        return "You are not eligible for this action.";
    }

    public function paymentMethodView()
{
    return view('paymentmethod');
}


}
