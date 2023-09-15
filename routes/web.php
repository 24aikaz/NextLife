
<?php

use App\Http\Controllers\AuctionsController;
use App\Http\Controllers\BidsController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\merchant\HouseController;
use App\Http\Controllers\merchant\ItemController;
use App\Http\Controllers\merchant\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\StripePaymentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ViewproductController;
use Illuminate\Auth\Middleware\Authenticate;

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


// The home page
Route::get('/', function () {
    return view('index');
})->name('home');

// Login
Route::get('login', [LoginController::class, 'index'])->name('login');
Route::post('login', [LoginController::class, 'retrieve']);
Route::post('logout', [LogoutController::class, 'store'])->name('logout');

// Register
Route::get('register', [RegisterController::class, 'index'])->name('register');
Route::post('register', [RegisterController::class, 'store']);

// Auctions
Route::get('auctions', [AuctionsController::class, 'index'])->name('auctions');
Route::get('viewproduct/{Product_ID}', [ViewproductController::class, 'display'])->name('viewproduct');

// Profile
Route::get('profile', [ProfileController::class, 'index'])->name('profile');
Route::get('viewuser/{username}', [UserController::class, 'index'])->name('viewuser'); 

// Bids
Route::get('bids', [BidsController::class, 'index']) ->name('bids');
Route::post('/place-bid/{id}', [BidsController::class, 'store'])->name('place-bid');
Route::post('/check-winners', [AuctionsController::class, 'checkWinners'])->name('check-winners');
Route::get('won-products', [ProductController:: class, 'getWonProducts'])->name('my-won-products');

// Merchant Related Routes
Route::get('merchant/product', [ProductController::class, 'index'])->name('product');
Route::post('merchant/product', [ProductController::class, 'addproduct']);
Route::get('/get-products', [ProductController::class, 'getProducts']); //Testing
Route::get('merchant/house', [HouseController::class, 'index']) ->name('auctionhouse');
Route::delete('/product/{Product_ID}', [ProductController::class, 'destroy'])->name('product.delete');

// Search bar
Route::get('/search', [AuctionsController::class, 'search'])->name('search');

// For Stripe
Route::controller(StripePaymentController::class)->group(function(){
    Route::get('stripe', 'stripe');
    Route::post('stripe', 'stripePost')->name('stripe.post');
}); //Testing
Route::post('/checkout', [ProductController::class, 'checkout'])->name('checkout');
Route::get('/checkout-success', [ProductController::class, 'success'])->name('checkout.success');
Route::get('/cancel', [ProductController::class, 'cancel'])->name('checkout.cancel');
Route::post('/webhook', [ProductController::class, 'webhook'])->name('checkout.webhook');

// Feedback
Route::get('feedback', [FeedbackController::class, 'index'])->name('feedback');