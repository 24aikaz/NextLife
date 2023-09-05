<?php

namespace App\Http\Controllers;

use App\Models\Bid;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BidsController extends Controller
{
    public function index()
    { {
            // $bids = Bid::get();
            // // dd($bids);

            // return view('bids', [
            //     'bids' => $bids // Passing the bids collection along for the view
            // ]);

            // Get the currently authenticated user
            $user = Auth::user();

            // Retrieve the bids associated with the user
            $userBids = $user->bids; // Assuming you have defined a relationship in your User model

            return view('bids', ['bids' => $userBids]);

        }
    }

    public function placeBid(Request $request, $id)
    {
        $validatedData = $request->validate([
            'bid_price' => 'required|numeric|min:0',
        ]);

        $product = Product::findOrFail($id);
        $newBidPrice = $validatedData['bid_price'];

        if ($newBidPrice > $product->currentprice) {
            // Update the current price
            $product->currentprice = $newBidPrice;
            $product->bidcount += 1;
            $product->save();

            // Create a new bid entry using the Bid model
            $bid = new Bid();
            $bid->product_id = $product->Product_ID; // Correct this based on your database schema
            $bid->bidder_id = auth()->user()->id;
            $bid->bid_price = $newBidPrice;
            $bid->bid_time = now();
            $bid->save();

            return back()->with('success', 'Bid placed successfully!');
        }

        return back()->with('error', 'Bid must be higher than the current price.');
    }


}