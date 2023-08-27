<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function index()
    {
        return view('register');
    }

    public function insertData(Request $request)
    {
        $request->validate([
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'name' => ['required', 'string', 'max:255'], // Assuming the form field name is "name"
            'last_name' => ['required', 'string', 'max:255'],
            'birth_date' => ['required', 'date'],
            'contact_number' => ['required', 'string', 'max:255'],
            'street' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'postal_code' => ['required', 'string', 'max:255'],
            'country' => ['required', 'string', 'max:255'],
            'usertype' => ['required', 'string'],
            // Add other validation rules for your form fields
        ]);

        // Use dd() to debug the incoming data
        dd($request->all());
        
             User::create([
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'name' => $request->input('name'), // Change this line if needed
            'last_name' => $request->input('last_name'),
            'birth_date' => $request->input('birth_date'),
            'contact_number' => $request->input('contact_number'),
            'street' => $request->input('street'),
            'city' => $request->input('city'),
            'postal_code' => $request->input('postal_code'),
            'country' => $request->input('country'),
            'usertype' => $request->input('usertype'),
            // Add other fields from your form
        ]);

        echo 'reg successful';
    }
}
