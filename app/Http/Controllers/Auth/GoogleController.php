<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    CONST GOOGLE_TYPE='google';

    public function handleGoogleRedirect(){
        return Socialite::driver('google')->redirect();
    }
    public function handleGoogleCallback()
    {
       $googleUser = Socialite::driver('google')->user();

       $user = User::updateOrCreate([
        'oauth_id' => $googleUser->id,
        ], [
        'name'=>$googleUser->name,
        'email'=>$googleUser->email,
        'password'=>Hash::make($googleUser->id)
    ]);

    Auth::login($user);

    return redirect('/home');

    }
}
