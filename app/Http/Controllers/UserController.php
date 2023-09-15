<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index($username)
    {
        return view('viewprofile', [
            'username' => $username
        ]);
    }

    public function show($username) // use $id instead to search and retrieve by id
    {
        // Option 1: Retrieves the user requested by their username
        $user = User::where('username', $username)->first();
        // Option 2: Retrieves the user requested by their id
        // $user = User::find($id);

        if ($user != null) {
            return response()->json([
                'message' => 'User Found',
                'user' => $user
            ]);
        } else {
            return response()->json([
                'message' => 'User NOT Found'
            ]);
        }

    }

    public function update(Request $request, string $username)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|max:255',
            'contact_number' => 'required',
            'street' => 'required',
            'city' => 'required',
            'postal_code' => 'required',
            'country' => 'required'
        ]);

        if ($validator->fails()) {

            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 422); //422 for input error

        } else {

            $finduser = User::where('username', $username)->first();

            if ($finduser) {

                $user = User::where('username', $username);
                $user->update([
                    'email' => $request->email,
                    'contact_number' => $request->contact_number,
                    'street' => $request->street,
                    'city' => $request->city,
                    'postal_code' => $request->postal_code,
                    'country' => $request->country,
                ]);
                return response()->json([
                    'status' => 200,
                    'message' => 'Details updated successfully'
                ], 200);

            } else {

                return response()->json([
                    'status' => 404,
                    'message' => 'User NOT found'
                ], 404);

            }

        }
    }

    // Soft delete user
    public function destroy($username)
    {
        $user = User::where('username', $username)->first();

        if (!$user) {
            return response()->json(['message' => 'User not found.'], 404);
        } else {
            $user->delete();
            return response()->json(['message' => 'Account has been deleted successfully.'], 200);
        }
    }

}