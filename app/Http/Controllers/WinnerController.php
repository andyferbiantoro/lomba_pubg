<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemenang;
use App\Models\Tournament;
use App\Models\PesertaTournament;
use Validator;
use Exception;
use Storage;
use Auth;
use Str;
use DB;

class WinnerController extends Controller
{
    public function index()
    {
        try {
            if(Auth::user()->role == 'admin') {
                $data = Pemenang::with('pembuat')->orderBy('created_at', 'desc')->paginate(6);
                $new = Pemenang::orderBy('created_at', 'desc')->limit(4)->get();
            } else {
                 // $data = Pemenang::with('pembuat')->leftJoin('user as u', 'u.id_user', '=', 'pemenang.id_user')->where('role', '=', 'peserta')->orderBy('pemenang.created_at', 'desc')->paginate(6);
                $data = DB::table('pemenang')
                         ->join('tournament' , 'pemenang.id_tournament', '=' , 'tournament.id_tournament')
                         ->join('user' , 'pemenang.id_peserta', '=' , 'user.id_user')
                         ->select('pemenang.*','user.foto','user.nama','user.role')
                         ->orderBy('pemenang.created_at', 'desc')
                         ->paginate(6);
                $new = Pemenang::leftJoin('user as u', 'u.id_user', '=', 'pemenang.id_user')->where('role', '!=', 'peserta')->orderBy('pemenang.created_at', 'desc')->limit(4)->get();
            }
            // dd($data);
            return view('winner.index', compact(['data', 'new']));
        } catch (Exception $e) {
            return view('error');
        }
    }

    public function detail($slug)
    {
        try {
            $data = Pemenang::with('pembuat')->where('slug', $slug)->first();
            $new = Pemenang::orderBy('created_at', 'desc')->limit(4)->get();

            return view('winner.detail', compact(['data', 'new']));
        } catch (Exception $e) {
            return view('error');
        }
    }

    public function add($slug)
    {
        $date = date("Y-m-d");

        $slug = Tournament::where('slug', $slug)->first();
        $peserta = PesertaTournament::where('id_tournament',$slug->id_tournament)->get();

        //dd($peserta);
        return view('winner.add', compact(['date','slug','peserta']));
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                // 'judul' => 'required|unique:pemenang,judul',
                'konten' => 'required',
                'thumbnail' => 'required',
                'team' => 'required',
                'norek_pemenang' => 'nullable',
                'bukti_point' => 'required',
            ]);

            if($validator->fails()) {
                return back()->withErrors($validator->errors());
            }

            $path = "images/pemenang/thumbnail/";
            $thumbnail = uploads($request->thumbnail, $path);

            $path = "images/pemenang/bukti-point/";
            $bukti_point = uploads($request->bukti_point, $path);
           

            $input = [
                
                'slug' => $request->slug,
                'isi' => $request->konten,
                'team' => $request->team,
                'bukti_point' => $bukti_point,
                'thumbnail' => $thumbnail,
                'id_user' => Auth::user()->id_user,
                'id_tournament' => $request->id_tournament,
            ];

            //Pemenang::create($input);
            $lastid = Pemenang::create($input)->id_pemenang;


            $peserta = PesertaTournament::where('team', $request->team)->first();
            //return $peserta->id_peserta;
            $update_id_peserta = Pemenang::where('id_pemenang', $lastid)->first();

            $input = [
             'id_peserta' => $peserta->id_peserta,
             'norek_pemenang' => $peserta->no_rekening,
           ];

           $update_id_peserta->update($input);

            return back()->with('success', 'Info Pemenang berhasil ditambahkan !');
        } catch (Exception $e) {
            dd($e->getMessage());
            return view('error');
        }
    }

    public function edit($slug)
    {
        try {
            $data = Pemenang::with('pembuat')->where('slug', $slug)->first();

            return view('winner.edit', compact(['data']));
        } catch (Exception $e) {
            return view('error');
        }
    }

    public function update(Request $request, $slug)
    {
        try {
            $update = $request->except(['thumbnail', 'konten', '_token', '_method']);
            $update['id_admin'] = Auth::user()->id_user;

            if($request->konten) {
                $update['isi'] = $request->konten;
            }

            if($request->thumbnail) {
                $data = Pemenang::select('thumbnail')->where('slug', $slug)->first();
                $path = "images/pemenang/thumbnail/";

                if (Storage::disk('public')->exists($path.$data->thumbnail)) {
                    Storage::disk('public')->delete($path.$data->thumbnail);
                }

                $thumbnail = uploads($request->thumbnail, $path);
                $update['thumbnail'] = $thumbnail;
            }

            Pemenang::where('slug', $slug)->update($update);

            return redirect('/pemenang')->with('success', 'Info Pemenang berhasil diperbarui !');
        } catch (Exception $e) {
            return view('error');
        }
    }

    public function delete($id)
    {
        try {
            $data = Pemenang::find($id);
            $path = "images/pemenang/thumbnail/";

            if (Storage::disk('public')->exists($path.$data->thumbnail)) {
                Storage::disk('public')->delete($path.$data->thumbnail);
            }

            Pemenang::destroy($id);

            return redirect('/pemenang')->with('success', 'Info Pemenang berhasil dihapus.');
        } catch (Exception $e) {
            return view('error');
        }
    }

     
}
