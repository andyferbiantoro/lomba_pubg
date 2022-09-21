<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tournament;
use Exception;

class GlobalController extends Controller
{
    //
    public function home()
    {
        try {
            $data = Tournament::with('penyelenggara')->orderBy('tgl_valid', 'desc')->limit(6)->get();

            return view('welcome', compact(['data']));
        } catch (Exception $e) {
            return view('error');
        }
    }
}
