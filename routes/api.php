<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\TasbeehController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

    Route::post('tasbeeh', [TasbeehController::class, 'tasbeeh']);
    Route::post('reset', [TasbeehController::class,  'reset']);
	Route::get('tasbeehview', [TasbeehController::class, 'tasbeehview']);
	Route::delete('/deletebyid/{id}', [TasbeehController::class, 'deletebyid']);
	Route::post('signup', [TasbeehController::class, 'signup']);
	Route::post('login', [TasbeehController::class, 'login']);
	Route::get('/editprofile/{id}', [TasbeehController::class, 'editprofile']);
	Route::put('profileupdate', [TasbeehController::class, 'profileupdate']);
	Route::post('forgot_password', [TasbeehController::class,  'forgot_password']);
	Route::post('change_password', [TasbeehController::class,  'change_password']);
	Route::post('update_tasbeeh', [TasbeehController::class, 'update_tasbeeh']);


	//Login Google 
Route::get('login/google', [LoginController::class, 'redirectToGoogle'])->name('login.google');
Route::get('login/google/callback', [LoginController::class, 'handleGoogleCallback']);

//Login Facebook
Route::get('login/facebook', [LoginController::class, 'redirectToFacebook'])->name('login.facebook');
Route::get('login/facebook/callback', [LoginController::class, 'handleFacebookCallback']);