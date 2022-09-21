<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;
use Exception;
use Validator;

class RegisterController extends Controller
{
    //
    public function register(Request $request)
    {
        try {
            $validateData = Validator::make($request->all(), [
                'nama' => 'required',
                'email' => 'required|email|unique:user',
                'password' => 'required|confirmed',
            ]);

            if ($validateData->fails()) {
                return back()->withErrors($validateData->errors());
            }

            $newUser = User::create([
                'nama' => $request->nama,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            Auth::login($newUser);
            return redirect('/');

        } catch (Exception $e) {    
            return view('error');
            dd($e->getMessage());
        }
    }
}
