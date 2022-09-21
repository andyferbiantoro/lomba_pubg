<?php

namespace App\Http\Controllers;

use Yajra\Datatables\Datatables;
use Illuminate\Http\Request;
use App\Models\User;
use Validator;
use Exception;
use Storage;
use Auth;

class UserController extends Controller
{
    public function index()
    {
        try {
            return view('user.index');
        } catch (Exception $e) {
            return view('error');
        }
    }

    public function reqPenyelenggara()
    {
        try {
            $datareq = User::where('role', '!=' ,'admin')->orderBy('updated_at', 'desc')->get();

            // return $datareq;
            return view('user.req-penyelenggara',compact(['datareq']));
        } catch (Exception $e) {
            return view('error');
            dd($e->getMessage());
        }
    }

    public function list(Request $request)
    {
        try {
            if($request->ajax()) {
                $data = User::where('role', $request->type)->orderBy('nama', 'asc')->get();

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

    public function listReqPenyelenggara(Request $request)
    {
        try {
            if($request->ajax()) {
                $data = User::where('role', 'peserta')->where('request_penyelenggara', 1)->orderBy('updated_at', 'desc')->get();

                // return $data;
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

    public function validasiReqPenyelenggara($id)
    {
        try {
            $user = User::find($id);
            $user->update([
                'role' => 'penyelenggara',
                'max_post' => 4,
                'request_penyelenggara' => 3,
                'biaya_request' => 150000,
            ]);

            return response()->json('success', 200);
        } catch (Exception $e) {
            return view('error');
        }
    }

    public function rejectReqPenyelenggara($id)
    {
        try {
            $user = User::find($id);
            $path = "images/bukti-penyelenggara/";

            if (Storage::disk('public')->exists($path.$user->bukti_tf)) {
                Storage::disk('public')->delete($path.$user->bukti_tf);
            }

            $user->update([
                'request_penyelenggara' => 2,
                'bukti_tf' => null
            ]);

            return response()->json('success', 200);
        } catch (Exception $e) {
            return view('error');
        }
    }

    public function show($id)
    {
        try {
            $data = User::findOrFail($id);

            return view('user.detail', compact(['data']));
        } catch (Exception $e) {
            return view('error');
        }
    }

    public function delete($id)
    {
        try {
            $data = User::find($id);
            $path = "images/profile/";

            if (Storage::disk('public')->exists($path.$data->thumbnail)) {
                Storage::disk('public')->delete($path.$data->thumbnail);
            }

            User::destroy($id);

            return response()->json('success', 200);
        } catch (Exception $e) {
            return view('error');
        }
    }

    public function editMaxPost(Request $request, $id)
    {
        try {
            $data = User::find($id);
            $maxpost = $request->maxpost;
            
            $data->update(['max_post' => $maxpost]);

            return response()->json('success', 200);
        } catch (Exception $e) {
            return view('error');
        }
    }

    public function statusPenyelenggara(Request $request, $id)
    {
        try {
            $data = User::find($id);
            $status = $request->status;
            
            $data->update(['active' => $status]);

            return response()->json('success', 200);
        } catch (Exception $e) {
            return view('error');
        }
    }

}
