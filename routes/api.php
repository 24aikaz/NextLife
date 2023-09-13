<?php

use App\Http\Controllers\OpinionController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


// Defining an API to work with user data: Fetch, update and delete.
Route::get('user/{username}', [UserController::class, 'show']);
Route::put('user/{username}', [UserController::class, 'update']);
//Route::delete('user/{username}', [UserController::class, 'destroy']);
Route::delete('/user/{username}', [UserController::class,'destroy']);

//Defining an API to work with the feedback processes

Route::get('leavefeedback', [OpinionController::class, 'show']);
Route::post('leavefeedback/{id}', [OpinionController::class, 'store']);

Route::post('validateJSON', [OpinionController::class, 'validateJSON']);
Route::post('validaterating', [OpinionController::class, 'validaterating']);
Route::post('validateproblem', [OpinionController::class, 'validateproblem']);