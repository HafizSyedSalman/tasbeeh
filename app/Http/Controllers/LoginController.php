<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Exception;
use Hash;
use Session;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }
 // Google Callback

    public function handleGoogleCallback()
        {
        $user=Socialite::driver('google')->user();
         $this->registerOrLoginUser($user);
        //after login redirect to Home page
         return '<center><h1><b>Welcome to Login Google</h1></b></center>';
         }

    // Login--Facebook
         public function redirectToFacebook()                                                      
                {
                return Socialite::driver('facebook')->redirect();
                 }
                 // Facebook---Callback
         public function handleFacebookCallback()
                    {
                      $data=Socialite::driver('facebook')->user();
                      $this->registerOrLoginUser($data);
                      return '<center><h1><b>Welcome to Login Facebook</h1></b></center>';
                     }

             protected function registerOrLoginUser($data)
         {
         $user=User::where('email','=', $data->email)->first();
         if(!$user) {
             $user= new User;
             $user->name          =   $data->name;
             $user->email         =   $data->email;
             $user->password      =   Hash::make('000000');
             $user->provider_id   =   $data->id;
             $user->avatar        =   $data->avatar;
             $user->save();
         }
    Auth::login($user);
       }


       

      }

