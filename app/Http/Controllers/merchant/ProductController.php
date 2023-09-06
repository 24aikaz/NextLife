<?php

namespace App\Http\Controllers\merchant;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        return view('merchant.product');
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        // Perform a search query on the products
        $products = Product::where('pname', 'like', '%' . $query . '%')
            ->orWhere('pdesc', 'like', '%' . $query . '%')
            ->get();

        return view('search', [
            'products' => $products
        ]);
    }

    public function addproduct(Request $request)
    {
        // dd($request);

        $validatedData = $request->validate([
            'pname' => 'required',
            'pdesc' => 'required',
            'startprice' => 'required|numeric',
            'category' => 'required',
            'image' => 'required|image',
            'status' => 'nullable|in:active,inactive',
            'startdate' => 'required',
            'enddate' => 'required',
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
            // 'status' => 'Inactive', // Set it to "Inactive" by default
            'bidcount' => 0,
            'category' => $request->input('category'),
            'startdate' => $request->input('startdate'),
            'enddate' => $request->input('enddate'),
            'seller_id' => auth()->id(), // Associate the product with the logged-in user
        ]);

        return redirect()->back();
    }

    public function getProducts(Request $request)
    {
        $products = Product::all();

        return response()->json($products);
    }
}