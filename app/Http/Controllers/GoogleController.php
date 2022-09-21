<?php

namespace App\Http\Controllers;

use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;
use Exception;

class GoogleController extends Controller
{
    //
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $user = Socialite::driver('google')->user();
            $finduser = User::where('google_id', $user->id)->orWhere('email', $user->email)->first();

            if($finduser){
                Auth::login($finduser);
                return redirect('/');
            } else {
                $newUser = User::create([
                    'nama' => $user->name,
                    'email' => $user->email,
                    'email_verified_at' => date("Y-m-d H:i:s"),
                    'google_id'=> $user->id,
                    'password' => Hash::make('password'),
                    'google_foto' => $user->avatar
                ]);

                Auth::login($newUser);
                return redirect('/');
            }

        } catch (Exception $e) {
            return view('error');
            dd($e->getMessage());
        }
    }
}
