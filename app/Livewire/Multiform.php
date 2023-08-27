<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;

class Multiform extends Component
{

    public $step = 1;  // Track the current step of the registration process
    
    // Step 1: Registering Type
    public $usertype;

    // Step 2: Account Information
    public $username;
    public $email;
    public $password;
    public $password_confirmation;

    // Step 3: Personal Information
    public $name;
    public $last_name;
    public $birth_date;
    public $contact_number;

    // Step 4: Location Information
    public $street;
    public $city;
    public $postal_code;
    public $country;

    public $totalSteps=4;
    public $currentStep=1;
    public function mount(){
        $this->currentStep=1;
    }

    public function decreaseStep()
    {
        $this->currentStep--;
        $this->resetErrorBag();
        $this->validateData();
    }
    public function render()
    {
        return view('livewire.multiform');
    }

    public function submit()
{
    if ($this->currentStep == 1) {
        $this->validate([
            'usertype' => 'required',
        ]);
    } elseif ($this->currentStep == 2) {
        $this->validate([
            'username' => 'required|string',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
            'password_confirmation' => 'required',
        ]);
    } elseif ($this->currentStep == 3) {
        $this->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'birth_date' => 'required|date',
            'contact_number' => 'required|string',
        ]);
    } elseif ($this->currentStep == 4) {
        $this->validate([
            'street' => 'required|string',
            'city' => 'required|string',
            'postal_code' => 'required|string',
            'country' => 'required|string',
        ]);
        
        // Validate terms checkbox if it's on the last step
        if (!$this->terms) {
            $this->addError('terms', 'Please accept the terms and conditions.');
            return;
        }
        
        // Insert values into the database
        User::create([
            'usertype' => $this->usertype,
            'username' => $this->username,
            'email' => $this->email,
            'password' => bcrypt($this->password),
            'name' => $this->first_name,
            'last_name' => $this->last_name,
            'birth_date' => $this->birth_date,
            'contact_number' => $this->contact_number,
            'street' => $this->street,
            'city' => $this->city,
            'postal_code' => $this->postal_code,
            'country' => $this->country,
        ]);

        $this->currentStep = 5; // Move to the confirmation step after successful insertion
    }
}

}
