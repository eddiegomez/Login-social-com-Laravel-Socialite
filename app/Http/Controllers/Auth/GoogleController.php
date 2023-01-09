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
    public function handleGoogleCallback(){
        try {
          $user=Socialite::driver('google')->user();
          $userExisted=User::where('oauth_id',$user->id)->where('oauth_type','google')->first();

          if($userExisted){
            Auth::login($userExisted);
            return redirect()->route('home');
          }else{
            $newUser=User::create([
                'name'=>$user->name,
                'email'=>$user->email,
                'oauth_id'=>$user->id,
                'oauth_type'=>'google',
                'password'=>Hash::make($user->id),
            ]);
          }
          Auth::login($newUser);
          return redirect()->route('home');

        } catch (\Exception $ex) {
           dd($ex);
        }
    }
}
