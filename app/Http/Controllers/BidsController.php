<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bid;
use App\Models\Product;

class BidsController extends Controller
{
    public function index()
    {
        return view('bids');
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
            $product->save();
    
            // Create a new bid entry using the Bid model
            $bid = new Bid();
            $bid->product_id = $product->Product_ID; // Correct this based on your database schema
            $bid->bidder_id= auth()->user()->id;
            $bid->bid_price = $newBidPrice;
            $bid->bid_time = now();
            $bid->save();
    
            return back()->with('success', 'Bid placed successfully!');
        }
    
        return back()->with('error', 'Bid must be higher than the current price.');
    }
}    