<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ViewproductController extends Controller
{
    public function index()
    {
        return view('viewproduct');
    }
}
