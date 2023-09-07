<?php

namespace App\Http\Controllers;

use App\Models\Bid;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class BidsController extends Controller
{
    public function index()
    {
        // This function returns the bids view to display the the current 
        // bids placed by the currently authenticated user 
        $user = Auth::user();
        $userBids = $user->bids;
        return view('bids', ['bids' => $userBids]);
    }

    public function store(Request $request, $id)
    {

        // return dd($request);

        $validator = Validator::make($request->all(), [
            'bid_price' => 'required|numeric|min:0',
        ]);

        if($validator->fails())
        {
            return response()->json([
                'status'=>400,
                'errors'=>$validator->messages()
            ]);
        }
        else
        {
            $product = Product::findOrFail($id);
            
            $newBidPrice = $request->input('bid_price');

            // Update the current price and bid count
            $product->currentprice = $newBidPrice;
            $product->bidcount += 1;
            $product->save();

            // Create a new bid entry using the Bid model
            $bid = new Bid();
            $bid->product_id = $product->Product_ID;
            $bid->bidder_id = auth()->user()->id;
            $bid->bid_price = $newBidPrice;
            $bid->bid_time = now();
            $bid->save();

            return response()->json([
                'status'=>200,
                'message'=>'Bid Added Successfully.'
            ]);
        }

    }

}