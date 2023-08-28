<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
//use App\Providers\RouteServiceProvider;
use App\Models\User;
//use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function index()
    {
        return view('register');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'username' => 'required|max:255',
            'email' => 'required|email|max:255',
            'password' => 'required|confirmed',
           // 'first_name' => 'required',
           // 'last_name' => 'required',
             //'birth_date' => 'required|date',
            // 'contact_number' => 'required',
            // 'street' => 'required',
            // 'city' => 'required',
            // 'postal_code' => 'required',
            // 'country' => 'required',
            // 'usertype' => 'required',
        ]);

           // Debug: Display the incoming data for debugging
           dd($request->all());
    
           // Create a new User instance and populate its fields
           User::create([
               'username' => $request->input('username'),
               'email' => $request->input('email'),
               'password' => Hash::make($request->input('password')),
               'first_name' => $request->input('first_name'),
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

        // auth()->attempt($request->only('username', 'password'));

        auth()->attempt($request->only('username', 'password'));

        return redirect()->route('home');
    }
}