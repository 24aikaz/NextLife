<?php

namespace App\Http\Controllers;

use App\Models\Opinion;
use Illuminate\Http\Request;
use Opis\JsonSchema\{Validator, ValidationResult, Helper};

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

    public function makevalidate()
    {
        // Create a new validator
        $validator = new Validator();
        
        // Register our schema
        $schema = <<<'JSON'
        {
            "type": "object",
            "properties": {
                "feedback_type": {
                    "type": "string"
                },
                "categories": {
                    "type": "string"
                },
                "comment": {
                    "type": "string"
                }
            },
            "required": ["feedback_type", "categories", "comment"]
        }
        JSON;
        
        // $data = <<<'JSON'
        // {
        //     "feedback_type": "testing",
        //     "categories":  "test",
        //     "comment": "test"
        // }
        // JSON;
        
        // // Decode $data
        // $data = json_decode($data);
        
        // /** @var ValidationResult $result */
        // $result = $validator->validate($data, $schema);
        
        // Get the raw JSON data from the request body
        $inputJSON = file_get_contents('php://input');
        $data = json_decode($inputJSON);
        
        // Validate the data against the schema
        $result = $validator->validate($data, json_decode($schema));
        
        if ($result->isValid()) {
            echo 'Valid', PHP_EOL;
        } else {
            // Print errors
            echo 'Invalid', PHP_EOL;
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