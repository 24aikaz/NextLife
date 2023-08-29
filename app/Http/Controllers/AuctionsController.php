<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuctionsController extends Controller
{
    public function index()
    {
        return view('auctions');
    }

    public function display()
    {
        dd("path okay");
    }
}
