<?php

namespace App\Http\Controllers\merchant;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index()
    {
        return view('merchant.product');
    }

    public function search(Request $req)
    {
        $data= Product::where('pname', 'like', '%'.$req->input('query').'%')->get();
        return view('search',['products'=>$data]);
    }

    public function addproduct(Request $request)
    {
        $validatedData = $request->validate([
            'pname' => 'required',
            'pdesc' => 'required',
            'startprice' => 'required|numeric',
            'category' => 'required',
            'image' => 'required|image',
            'status' => 'nullable|in:active,inactive',
        ]);

        // Handle image upload
        $imageName = $request->file('image')->getClientOriginalName();
        $imageData = $request->file('image')->store('images', 'public');

        // Create and save the product using create method
        $product = Product::create([
            'pname' => $validatedData['pname'],
            'pdesc' => $validatedData['pdesc'],
            'name' => $imageName,
            'image' => $imageData,
            'startprice' => $validatedData['startprice'],
            'currentprice' => $validatedData['startprice'],
            // Assuming current price is the same as starting price initially
            'status' => 'active',
            // Set it to "active" by default
            'bidcount' => 0,
            'category' => $request->input('category'),
            'startdate' => now(),
            'enddate' => now()->addDays(1),
            'seller_id' => auth()->id(), // Associate the product with the logged-in user
        ]);

        return redirect()->back();
    }
}