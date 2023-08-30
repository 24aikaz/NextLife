<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
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

    public function display()
    {
        dd("path okay");
    }
}
