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

public function selectWinner()
{
    //dd('selectWinner is called');
    $products = Product::where('status', 'active')
        ->where('enddate', '<=', now())
        ->whereNull('winner')
        ->get();

    if ($products->isEmpty()) {
        // If there are no products to be won, return to the auctions page
        return redirect()->route('auctions')->with('info', 'No products available for selection.');
    }

    // Get the currently logged-in user's username
    $bidder_username = Auth::user()->username;

    foreach ($products as $product) {
        // Implement the logic to select a winner for each product
        $this->selectWinnerForProduct($product, $bidder_username);
    }
}

public function selectWinnerForProduct(Product $product, $bidder_username)
{      //dd('selectWinnerfoproduct is called');
    try {
        $winnerBid = $product->bids->sortByDesc('bid_price')->first();

        if ($winnerBid) {
            // Update product details
            $product->winner = $winnerBid->bidder_id;
            $product->winning_bid = $winnerBid->bid_price;
            $product->bidcount = $product->bids->count();
            $product->save();

            // Insert data into the auctions table
            Auction::create([
                'sellername' => $product->user->username,
                'Winner_ID' => $winnerBid->bidder_id,
                'Product_ID' => $product->Product_ID,
                'Win_Price' => $winnerBid->bid_price,
                'Start_Date' => $product->startdate,
                'End_Date' => $product->enddate,
            ]);
 
            // Redirect to the payment method selection view
            return view('paymentmethod');
        }

        return redirect()->route('auctions');

    } catch (\Exception $e) {
        // Log the exception
        Log::error($e);

        // Handle the exception or return an error response
        return 'An error occurred. Please try again later.';
    }
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
