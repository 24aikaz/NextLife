<?php

namespace App\Http\Controllers;

use App\Models\Opinion;
use Illuminate\Http\Request;
use Illuminate\Auth\Access\Response;
use Opis\JsonSchema\{Validator, ValidationResult, Helper};
use Illuminate\Support\Facades\Auth;

class OpinionController extends Controller
{
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

    public function store(Request $request, $id)
    {
        $requestData = $request->json()->all();

        $userId = intval($id);
        $feedbackType = $requestData['feedback_type'];
        $categories = $requestData['categories'];
        $stars = $requestData['stars'];
        $frequency = $requestData['frequency'];
        $comment = $requestData['comment'];

        $feedback = Opinion::create([
            'user_id' => $userId,
            'feedback_type' => $feedbackType,
            'categories' => $categories,
            'stars' => $stars,
            'frequency' => $frequency,
            'comment' => $comment,
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

    public function validateJSON()
    {
        // Create a new validator
        $validator = new Validator();

        // Register our schema
        $schema = <<<'JSON'
            {
                "type": "object",
                "properties": {
                    "feedback_type": {
                        "type": "string",
                        "enum": ["suggestion", "rating", "problem"]
                    },
                    "categories": {
                        "anyOf": [
                            {
                                "type": "string",
                                "enum": ["user interface", "auction experience", "payment process", "communication", "other"]
                            },
                            {
                                "type": "null"
                            }
                            ]
                        },
                        "stars": {
                            "anyOf": [
                                {
                                    "type": "integer",
                                    "minimum": 0,
                                    "maximum": 5
                                },
                                {
                                    "type": "null"
                                }
                                ]
                            },
                            "frequency": {
                                "anyOf": [
                                    {
                                        "type": "string",
                                        "enum": ["once", "often", "always"]
                                    },
                                    {
                                        "type": "null"
                                    }
                                    ]
                                },
                                "comment": {
                                    "type": "string"
                                }
                            }
                        }
        JSON;

        // Get the raw JSON data from the request body
        $inputJSON = file_get_contents('php://input');
        $data = json_decode($inputJSON);

        // Validate the data against the schema
        $result = $validator->validate($data, json_decode($schema));

        if ($result->isValid()) {
            // echo 'Valid', PHP_EOL;
            return response()->json([
                'status' => 200,
                'message' => 'Valid JSON',
                'data' => $data
            ]);
        } else {
            // Print errors
            // echo 'Invalid', PHP_EOL;
            return response()->json([
                'message' => 'Invalid JSON',
                'status' => 400
            ]);
        }
    }

    public function validateIncoming()
    {
        // Create a new validator
        $validator = new Validator();

        // Register our schema
        $schema = <<<'JSON'
                    {
                        "type": "object",
                        "properties": {
                            "status": {
                                "type": "integer"
                            },
                            "message": {
                                "type": "string"
                            },
                            "feedback": {
                                "type": "array",
                                "items": {
                                    "type": "object",
                                    "properties": {
                                        "id": {
                                            "type": "integer"
                                        },
                                        "user_id": {
                                            "type": "integer"
                                        },
                                        "feedback_type": {
                                            "type": "string",
                                            "enum": ["suggestion", "rating", "problem"]
                                        },
                                        "categories": {
                                            "type": ["string", "null"]
                                        },
                                        "stars": {
                                            "type": ["integer", "null"]
                                        },
                                        "frequency": {
                                            "type": ["string", "null"]
                                        },
                                        "comment": {
                                            "type": "string"
                                        },
                                        "created_at": {
                                            "type": "string",
                                            "format": "date-time"
                                        },
                                        "updated_at": {
                                            "type": "string",
                                            "format": "date-time"
                                        }
                                    },
                                    "required": ["id", "user_id", "feedback_type", "comment", "created_at", "updated_at"]
                                }
                            }
                        },
                        "required": ["status", "message"]
                    }
        JSON;

        // Get the raw JSON data from the request body
        $inputJSON = file_get_contents('php://input');
        $data = json_decode($inputJSON);

        // Validate the data against the schema
        $result = $validator->validate($data, json_decode($schema));

        if ($result->isValid()) {
            // echo 'Valid', PHP_EOL;
            return response()->json([
                'status' => 200,
                'message' => 'Valid JSON',
                'data' => $data
            ]);
        } else {
            // Print errors
            // echo 'Invalid', PHP_EOL;
            return response()->json([
                'message' => 'Invalid JSON',
                'status' => 400
            ]);
        }
    }

}