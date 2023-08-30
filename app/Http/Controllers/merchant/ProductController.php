<?php

namespace App\Http\Controllers\merchant;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        return view('merchant.product');
    }

    public function addproduct(Request $request)
    {
        $this->validate($request, [
            'pname' => 'required',
            'pdesc' => 'required',
            'startprice' => 'required',
            'category' => 'required',
        ]);
    
        Product::create([
            'pname' => $request->input('pname'),
            'pdesc' => $request->input('pdesc'),
            'startprice' => $request->input('startprice'),
            'currentprice' => $request->input('startprice'),
            'status' => $request->input('status'),
            'category' => $request->input('category'),
            'seller' => auth()->id(),
        ]);

        return redirect()->route('bids');
    }
}
