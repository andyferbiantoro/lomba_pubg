<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Exception;

class LoginController extends Controller
{
    //
    public function login(Request $request)
    {
        try {
            $user = User::where('email', $request->email)->first();
            if($user) {
                if(Hash::check($request->password, $user->password)) {
                    Auth::login($user);
                    return redirect('/');
                } else {
                    return back()->with('error', 'Password salah!');
                }
            } else {
                return back()->with('error', 'User tidak ada, silahkan mendaftar!');
            }
        } catch (Exception $e) {
            return view('error');
            dd($e->getMessage());
        }
    }
}
