<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Models\Tournament;
use App\Models\Transaksi;
use App\Models\User;
use Validator;
use Exception;
use Storage;
use Auth;

class TransactionController extends Controller
{
    public function index()
    {
        try {
            $user = User::where('id_user', Auth::user()->id_user)->get();

            // return $req;
            return view('transaction.index', compact(['user']));
        } catch (Exception $e) {
            return view('error');
        }
    }


    public function transaksi_admin()
    {
        try {
            $transaksi = User::where('request_penyelenggara',3)->orderby('updated_at','desc')->get();
            

            return view('transaction.tr_admin', compact(['transaksi']));
        } catch (Exception $e) {
            return view('error');
        }
    }


    public function list(Request $request)
    {
        try {
            if($request->ajax()) {
                $role = Auth::user()->role;
                $id_user = Auth::user()->id_user;
                switch($role) {
                    case 'peserta':
                        $data = Transaksi::where('id_peserta', $id_user)->latest()->get();
                        break;
                    case 'penyelenggara':
                        $data = Transaksi::where('id_penyelenggara', $id_user)->latest()->get();
                        break;
                    case 'admin':
                        $data = Transaksi::latest()->get();
                        break;
                }

                return DataTables::of($data)
                        ->addIndexColumn()
                        ->make(true);
            }
        } catch (Exception $e) {
            return response()->json([
                'data' => 'error'
            ], 500);
        }
    }

    public function detail($id)
    {
        try {
            $transaksi = Transaksi::findOrFail($id);
            $peserta = User::find($transaksi->id_peserta);
            $penyelenggara = User::find($transaksi->id_penyelenggara);
            $tournament = Tournament::find($transaksi->id_tournament);

            return view('transaction.detail', compact(['transaksi', 'peserta', 'penyelenggara', 'tournament']));
        } catch (Exception $e) {
            return view('error');
        }
    }

    public function uploadBukti(Request $request, $id)
    {
        try {
            $transaksi = Transaksi::find($id);

            $path = "images/transaksi/bukti/";
            $bukti = uploads($request->bukti, $path);

            if (Storage::disk('public')->exists($path.$transaksi->bukti)) {
                Storage::disk('public')->delete($path.$transaksi->bukti);
            }

            $transaksi->update([
                'status' => 'waiting',
                'bukti' => $bukti
            ]);

            return back()->with('success', 'Upload bukti transfer berhasil, tunggu validasi !');
        } catch (Exception $e) {
            return view('error');
        }
    }

    public function reject($id)
    {
        try {
            $transaksi = Transaksi::find($id);

            $transaksi->update([
                'status' => 'reject',
            ]);

            return back()->with('success', 'Reject pembayaran berhasil !');
        } catch (Exception $e) {
            return view('error');
        }
    }

    public function valid($id)
    {
        try {
            $transaksi = Transaksi::find($id);
            $tournament = Tournament::find($transaksi->id_tournament);
            $sisa_slot = $tournament->sisa_slot;
            
            if($sisa_slot > 0) {
                $tournament->update([
                    'sisa_slot' => $tournament->sisa_slot - 1
                ]);
    
                $transaksi->update([
                    'status' => 'valid',
                ]);

                return back()->with('success', 'Validasi pembayaran berhasil !');
            }
            
            return back()->with('failed', 'Sisa slot sudah penuh !');
        } catch (Exception $e) {
            return view('error');
        }
    }


    
}
