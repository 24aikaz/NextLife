
<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('index');
})->name('home');

Route::get('login', function () {
    return view('login');
})->name('login'); // Name the login route


Route::get('register', [RegisterController::class, 'index'])->name('register'); // Display the registration form
Route::post('register', [RegisterController::class, 'insertData']); // Handle form submission

//Route::get('register', [RegisterController::class, 'index'])->name('register'); // Display the registration form
//Route::post('register/insert', [RegisterController::class, 'insertData'])->name('register.insert'); // Handle form submission
Route::get('login', [LoginController::class, 'index']) ->name('login');
Route::post('login', [LoginController::class, 'retrieve']);

Route::get('register', [RegisterController::class, 'index']) ->name('register');
