<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use App\Models\Opinion;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {
        return view('feedback');
    }
    
}