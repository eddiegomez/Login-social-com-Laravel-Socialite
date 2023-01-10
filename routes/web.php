<?php

use App\Http\Controllers\Auth\FacebookController;
use App\Http\Controllers\Auth\GoogleController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

/*Google Oauth Routes*/
Route::get('/auth/google/redirect',[GoogleController::class,'handleGoogleRedirect'])->name('handleGoogleRedirect');;
Route::get('/auth/google/callback',[GoogleController::class,'handleGoogleCallback'])->name('handleGoogleCallback');;

/*Facebook Oauth Routes*/
Route::get('/auth/facebook/redirect',[FacebookController::class,'handleGoogleRedirect'])->name('handleFacebookRedirect');;
Route::get('/auth/facebook/callback',[FacebookController::class,'handleGoogleCallback'])->name('handleFacebookCallback');;
