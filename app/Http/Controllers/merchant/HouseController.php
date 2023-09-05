<?php

namespace App\Http\Controllers\merchant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HouseController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Retrieve the bids associated with the user
        $userProducts = $user->products; // Assuming you have defined a relationship in your User model

        return view('merchant.house', ['products' => $userProducts]);
    }
}