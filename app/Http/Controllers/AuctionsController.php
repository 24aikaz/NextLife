<?php

namespace App\Http\Controllers;

use App\Models\Bid;
use App\Models\User;
use App\Models\Order;
use App\Models\Auction;
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
            'products' => $products // Passing the products collection along for the view
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
        return response()->json(['message' => 'Winners selected successfully']);
    }


    
    public function search(Request $request)
    {
        $query = $request->input('query');

        $products = Product::where('pname', 'like', '%' . $query . '%')
            ->orWhere('pdesc', 'like', '%' . $query . '%')
            ->get();

        return response()->json([
            // 'status' => 200,
            'products' => $products
        ]);
    }


}