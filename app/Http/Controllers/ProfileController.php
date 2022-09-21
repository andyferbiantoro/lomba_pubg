<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Setting;
use Validator;
use Exception;
use Storage;
use Auth;

class ProfileController extends Controller
{
    //
    public function show()
    {
        try {
            $id_user = Auth::user()->id_user;
            $user = User::find($id_user);

            if(Auth::user()->role == 'peserta') {
                $setting = Setting::select('daftar_penyelenggara', 'info_bank')->first();
                return view('profile.show', compact(['user', 'setting']));
            }

            return view('profile.show', compact(['user']));
        } catch (Exception $e) {
            return view('error');
            return dd($e->getMessage());
        }
    }

    public function updateGeneral(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'nama' => 'required',
                'email' => 'required',
                'no_hp' => 'required|numeric',
                'alamat' => 'required',
                'request_penyelenggara' => 'nullable',
                'bukti_tf' => 'nullable'
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator);
            }

            $input = $request->except(['bukti_tf']);
            $input['updated_at'] = date("Y-m-d H:i:s");
            $user = User::find(Auth::user()->id_user);
            $message = 'Profile Berhasil diperbarui.';

            if($request->request_penyelenggara) {
                if(!$request->bukti_tf) {
                    return back()->with('error', 'Upload Bukti Transfer !');
                }

                $path = "images/bukti-penyelenggara/";
                $nameFile = uploads($request->bukti_tf, $path);
                $input['bukti_tf'] = $nameFile;
                $message = 'Profile Berhasil diperbarui. Tunggu validasi Admin terlebih dahulu.';
            }

            $user->update($input);

            return back()->with('success', $message);
        } catch (Exception $e) {
            return view('error');
            dd($e->getMessage());
        }
    }

    public function updateFoto(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'foto' => 'required|max:2048',
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator);
            }

            $path = "images/profile/";
            $user = User::find(Auth::user()->id_user);

            if (Storage::disk('public')->exists($path.$user->foto)) {
                Storage::disk('public')->delete($path.$user->foto);
            }
            
            $nameFile = uploads($request->foto, $path);
            $user->update([
                'foto' => $nameFile
            ]);

            return back()->with('success', 'Foto Profile berhasil diperbarui');
        } catch (Exception $e) {
            return view('error');
            dd($e->getMessage());
        }
    }

    public function updatePassword(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'old_password' => 'required',
                'password' => 'required|confirmed',
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator);
            }

            $user = User::find(Auth::user()->id_user);

            if (Hash::check($request->old_password, $user->password)) {
                $user->update([
                    'password' => Hash::make($request->password)
                ]);
                
                return back()->with('success', 'Password berhasil diperbarui');
            }

            return back()->with('error', 'Password lama tidak sesuai');
        } catch (Exception $e) {
            return view('error');
            dd($e->getMessage());
        }
    }

}
