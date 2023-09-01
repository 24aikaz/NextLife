<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Auction;
use App\Models\Product;
use Illuminate\Http\Request;

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
        $products = Product::where('status', 'active')
            ->where('enddate', '<=', now())
            ->whereNull('winner')
            ->get();

        foreach ($products as $product) {
            // Implement the logic to select a winner for each product
            $this->selectWinnerForProduct($product);
        }
    }

    public function selectWinnerForProduct(Product $product)
    {
        $winnerBid = $product->bids->sortByDesc('bid_price')->first();

        if ($winnerBid) {
            // Update product details
            $product->winner = $winnerBid->bidder_name;
            $product->winning_bid = $winnerBid->bid_price;
            $product->bidcount = $product->bids->count();
            $product->save();

            // Insert data into the auctions table
            Auction::create([
                'sellername' => $product->user->name,
                'Winner_ID' => $winnerBid->bidder_name,
                'Product_ID' => $product->Product_ID,
                'Win_Price' => $winnerBid->bid_price,
                'Start_Date' => $product->startdate,
                'End_Date' => $product->enddate,
            ]);
        }
    }

    public function display()
    {
        dd("path okay");
    }
}
