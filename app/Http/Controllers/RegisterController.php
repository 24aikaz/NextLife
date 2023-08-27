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
    public function index(){
        return view('register');
    }

  
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'name' => ['required', 'string', 'max:255'],
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
    }

    protected function create(array $data)
    {

         // Use dd() to debug the incoming data
         dd($data);
        
        return User::create([
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'name' => $data['name'],
            'last_name' => $data['last_name'],
            'birth_date' => $data['birth_date'],
            'contact_number' => $data['contact_number'],
            'street' => $data['street'],
            'city' => $data['city'],
            'postal_code' => $data['postal_code'],
            'country' => $data['country'],
            'usertype' => $data['usertype'], // Add the usertype field
            // Add other fields from your form
        ]);
    
        if ($user) {
            // Registration successful, you should define a 'success' route
            return redirect()->route('success')->with('message', 'Registration successful!');
        } else {
            // Registration failed
            return back()->withInput()->withErrors(['message' => 'Registration failed. Please try again.']);
        }
    }
}


