<?php

namespace App\Http\Controllers;

use App\Models\Opinion;
use Illuminate\Http\Request;

class OpinionController extends Controller
{
    public function store(Request $request)
    {
        $feedback = Opinion::create([
            'user_id' => $request->user_id, //should be auth()->user()->id
            'feedback_type' => $request->feedback_type,
            'categories' => $request->categories, 
            'stars' => $request->stars,
            'frequency' => $request->frequency,
            'comment' => $request->comment,
        ]);

        if ($feedback) {
            return response()->json([
                'status' => 200,
                'message' => 'Feedback Added Successfully'
            ]);
        } else {
            return response()->json([
                'status' => 400,
                'message' => 'Error in Adding Feedback'
            ]);
        }

    }

    public function show()
    {

        $feedback = Opinion::all();

        if ($feedback->count() > 0) {
            return response()->json([
                'status' => 200,
                'message' => 'Feedback(s) Found',
                'feedback' => $feedback
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No Feedback Found'
            ]);
        }

    }
}