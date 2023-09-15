<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ViewproductController extends Controller
{

    public function index()
    {
        return view('viewproduct');
    }

    public function display($Product_ID)
    {
        // Fetch the item data from the database based on the $id
        $product = Product::find($Product_ID);

        return view('viewproduct', ['product' => $product]);
    }
}