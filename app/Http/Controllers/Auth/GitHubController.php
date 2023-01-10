<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class GitHubController extends Controller
{
    public function handleGitHubRedirect()
    {

        return Socialite::driver('github')->redirect();
    }
    public function handleGitHubCallback()
    {
        try {

            $user = Socialite::driver('github')->user();

            $finduser = User::where('social_id', $user->id)->first();

            if($finduser){

                Auth::login($finduser);

                return redirect()->route('home');

            }else{
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'social_id'=> $user->id,
                    'social_type'=> 'github',
                    'password' =>Hash::make('my-github')
                ]);

                Auth::login($newUser);

                return redirect()->route('home');
            }

        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }
}
