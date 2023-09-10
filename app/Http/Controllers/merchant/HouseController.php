<?php

namespace App\Http\Controllers\merchant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HouseController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }
    public function index()
    {
        $user = Auth::user();

        // Retrieve the bids associated with the user
        //Shows error here but isn't an error
        $userProducts = $user->products()->orderBy('created_at', 'desc')->get();

        return view('merchant.house', ['products' => $userProducts]);
    }
}