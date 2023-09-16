<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
//use App\Providers\RouteServiceProvider;
use App\Models\User;
//use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class RegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware(['guest']);
    }
    public function index()
    {
        return view('register');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'username' => 'unique:users,username',
            'email' => 'required|email|max:255',
            'password' => [
                'required',
                'min:8',
                'confirmed',
            ],
            'first_name' => 'required',
            'last_name' => 'required',
            'birth_date' => 'required|date',
            'contact_number' => 'required|numeric|digits:10',
            'street' => 'required',
            'city' => 'required',
            'postal_code' => 'required',
            'country' => 'required',
            'usertype' => 'required',
        ]);


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
        ]);

        auth()->attempt($request->only('username', 'password'));

        return redirect()->route('home');
    }
}