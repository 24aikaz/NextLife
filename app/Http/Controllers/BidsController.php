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
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {
        // This function returns the bids view to display the the current 
        // bids placed by the currently authenticated user 
        $user = Auth::user();
        $userBids = $user->bids()->orderBy('created_at', 'desc')->get(); //error isn't error
        $userProducts = Product::get();
        return view('bids', ['bids' => $userBids, 'products' => $userProducts]);
    }

    public function store(Request $request, $id)
    {

        $validator = Validator::make($request->all(), [
            'bid_price' => 'required|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages()
            ]);
        } else {
            $product = Product::findOrFail($id);

            $newBidPrice = $request->input('bid_price');

            // Check if the new bid price is greater than the current price
            if ($newBidPrice <= $product->currentprice) {
                return response()->json([
                    'status' => 401,
                    'message' => 'Bid price must be greater than the current price.'
                ]);
            } else {
                // Update the current price and bid count
                $product->currentprice = $newBidPrice;
                $product->bidcount += 1;
                $product->save();

                // Create a new bid entry using the Bid model
                $bid = new Bid();
                $bid->product_id = $product->Product_ID;
                $bid->bidder_id = auth()->user()->id;
                $bid->bid_price = $newBidPrice;
                $bid->bid_time = now(4);
                $bid->save();

                return response()->json([
                    'status' => 200,
                    'message' => 'Bid Added Successfully.'
                ]);
            }

        }

    }

}