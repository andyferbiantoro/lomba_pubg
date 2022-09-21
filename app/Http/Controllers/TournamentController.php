<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tournament;
use App\Models\Transaksi;
use App\Models\Setting;
use App\Models\PesertaTournament;
use Exception;
use Validator;
use Storage;
use Auth;
use Str;
use DB;
use Carbon\Carbon;

class TournamentController extends Controller
{
    public function index()
    {
        try {

            $now = Carbon::now()->format('y-m-d');
            $data = Tournament::with('penyelenggara')->orderBy('tgl_valid', 'desc')->where('tgl_valid','>=',$now)->paginate(9);
            $turnament_now = Tournament::with('penyelenggara')->orderBy('tgl_valid', 'desc')->where('tgl_valid','=',$now)->paginate(9);
             $turnament_done = Tournament::with('penyelenggara')->orderBy('tgl_valid', 'desc')->where('tgl_valid','<=',$now)->paginate(9);

            return view('tournament.index', compact(['data','turnament_now','turnament_done']));
        } catch (Exception $e) {
            return view('error');
            dd($e->getMessage());
        }
    }

    public function follow()
    {
        try {
            $data = Tournament::select('tournament.*', 'transaksi.status')->with('penyelenggara')
            ->join('transaksi', 'transaksi.id_tournament', 'tournament.id_tournament')
            ->where('transaksi.id_peserta', Auth::user()->id_user)
            ->orderBy('tournament.tgl_valid', 'desc')
            ->paginate(9);

            return view('tournament.follow', compact(['data']));
        } catch (Exception $e) {
            return view('error');
            dd($e->getMessage());
        }
    }

    public function detail($slug)
    {
        try {
            $data = Tournament::with('penyelenggara')->where('slug', $slug)->first();

            if(Auth::check()) {
                $id_user = Auth::user()->id_user;

                if($id_user == $data->id_penyelenggara) {
                    $data['peserta_tournament'] = PesertaTournament::join('transaksi', 'transaksi.id_transaksi', 'peserta_tournament.id_transaksi')
                    ->where('peserta_tournament.id_tournament', $data->id_tournament)
                    ->where('transaksi.status', 'valid')
                    ->get();
                }

                $transaksi = Transaksi::where([
                    ['id_peserta', $id_user],
                    ['id_tournament', $data->id_tournament]
                ])->count();
                
                if($transaksi) {
                    $status = 1; // sudah login dan sudah daftar tournament
                } else {
                    if(Auth::user()->email_verified_at == null) {
                        $status = 3; // sudah login dan belum daftar tournament dan email belum verifikasi
                    } else  {
                        $status = 2; // sudah login dan belum daftar tournament
                    }
                }
            } else {
                $status = 0; // belum login
            }
            
            // return $data;
            return view('tournament.detail', compact(['data', 'status']));
        } catch (Exception $e) {
            return view('error');
            dd($e->getMessage());
        }
    }

    public function add()
    {
        try {
            if(Auth::user()->role == 'penyelenggara' && Auth::user()->active == 0) {
                return back()->with('error', 'Tidak dapat membuat postingan, silahkan hubungi Admin.');
            }

            $date = date("Y-m-d");
            $setting = Setting::find(1);

            return view('tournament.add', compact(['date', 'setting']));
        } catch (Exception $e) {
            return view('error');
        }
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'nama' => 'required|unique:tournament,nama',
                'lokasi' => 'required',
                'biaya_pendaftaran' => 'required|numeric',
                'jumlah_slot' => 'required|numeric',
                'type' => 'required',
                'tgl_valid' => 'required',
                'tgl_tournament' => 'required',
                'deskripsi' => 'required',
                'thumbnail' => 'required',
                'file_poster' => 'required',
            ]);

            if($validator->fails()) {
                return back()->withErrors($validator->errors());
            }

            $total_tournament = Tournament::where('id_penyelenggara', Auth::user()->id_user)->whereYear('created_at', date('Y'))->whereMonth('created_at', date('m'))->count(); 
            if(Auth::user()->max_post > $total_tournament) {
                $pathThumbnail = "images/tournament/thumbnail/";
                $pathFile = "images/tournament/file/";
                $thumbnail = uploads($request->thumbnail, $pathThumbnail);
                $file = uploads($request->file_poster, $pathFile);

                $input = [
                    'nama' => $request->nama,
                    'slug' => Str::slug($request->nama),
                    'lokasi' => $request->lokasi,
                    'jumlah_slot' => $request->jumlah_slot,
                    'sisa_slot' => $request->jumlah_slot,
                    'biaya_pendaftaran' => $request->biaya_pendaftaran,
                    'tgl_valid' => $request->tgl_valid,
                    'tgl_tournament' => $request->tgl_tournament,
                    'deskripsi' => $request->deskripsi,
                    'thumbnail' => $thumbnail,
                    'file' => $file,
                    'type' => $request->type,
                    'id_penyelenggara' => Auth::user()->id_user
                ];

                Tournament::create($input);

                return back()->with('success', 'Tournament berhasil diposting !');
            }

            return back()->with('error', 'Limit posting tournament per bulan sudah mencapai batas !');
        } catch (Exception $e) {
            return view('error');
            dd($e->getMessage());
        }
    }

    public function edit($slug)
    {
        try {
            $data = Tournament::with('penyelenggara')->where('slug', $slug)->first();

            return view('tournament.edit', compact(['data']));
        } catch (Exception $e) {
            return view('error');
        }
    }

    public function update(Request $request, $slug)
    {
        try {
            $update = $request->except(['thumbnail', 'file_poster', '_token', '_method']);

            if($request->thumbnail) {
                $data = Tournament::select('thumbnail')->where('slug', $slug)->first();
                $pathThumbnail = "images/tournament/thumbnail/";

                if (Storage::disk('public')->exists($pathThumbnail.$data->thumbnail)) {
                    Storage::disk('public')->delete($pathThumbnail.$data->thumbnail);
                }

                $thumbnail = uploads($request->thumbnail, $pathThumbnail);
                $update['thumbnail'] = $thumbnail;
            }

            if($request->file_poster) {
                $data = Tournament::select('file')->where('slug', $slug)->first();
                $pathFile = "images/tournament/file/";

                if (Storage::disk('public')->exists($pathFile.$data->file)) {
                    Storage::disk('public')->delete($pathFile.$data->file);
                }

                $file = uploads($request->file_poster, $pathFile);
                $update['file'] = $file;
            }

            Tournament::where('slug', $slug)->update($update);

            return redirect('/tournament')->with('success', 'Tournament berhasil diperbarui !');
        } catch (Exception $e) {
            return view('error');
            dd($e->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            $data = Tournament::find($id);
            $pathThumbnail = "images/tournament/thumbnail/";
            $pathFile = "images/tournament/file/";

            if(Storage::disk('public')->exists($pathThumbnail.$data->thumbnail)) {
                Storage::disk('public')->delete($pathThumbnail.$data->thumbnail);
            }

            if(Storage::disk('public')->exists($pathFile.$data->file)) {
                Storage::disk('public')->delete($pathFile.$data->file);
            }

            Tournament::destroy($id);

            return redirect('/tournament')->with('success', 'Tournament berhasil dihapus.');
        } catch (Exception $e) {
            return view('error');
        }
    }

    public function daftar(Request $request, $slug)
    {
        DB::beginTransaction();
        try {
            $tournament = Tournament::where('slug', $slug)->first();

            $pathLogo = "images/transaksi/logo/";
            $logo = uploads($request->logo, $pathLogo);
            $input = [
                'team' => $request->team,
                'logo' => $logo,
                'tournament' => $tournament->nama,
                'peserta' => Auth::user()->nama,
                'penyelenggara' => $request->penyelenggara,
                'id_tournament' => $tournament->id_tournament,
                'id_penyelenggara' => $tournament->id_penyelenggara,
                'id_peserta' => Auth::user()->id_user,
            ];

            $tr = Transaksi::create($input);

            $input = [
                'team' => $request->team,
                'logo' => $logo,
                'anggota_1' => $request->anggota_1,
                'anggota_3' => $request->anggota_3,
                'anggota_4' => $request->anggota_4,
                'anggota_5' => $request->anggota_5,
                'type' => $request->type,
                'no_rekening' => $request->no_rekening,
                'id_tournament' => $tournament->id_tournament,
                'id_transaksi' => $tr->id_transaksi,
                'id_peserta' => Auth::user()->id_user,
            ];

            if($request->anggota_2) {
                $input['anggota_2'] = $request->anggota_2;
            }

            if($request->anggota_3) {
                $input['anggota_3'] = $request->anggota_3;
            }

            if($request->anggota_4) {
                $input['anggota_4'] = $request->anggota_4;
            }

            if($request->anggota_5) {
                $input['anggota_5'] = $request->anggota_5;
            }

            PesertaTournament::create($input);
            DB::commit();

            return back()->with('success', 'Berhasil, silahkan lunasi Pembayaran !');
        } catch (Exception $e) {
            DB::rollback();
            return view('error');
            dd($e->getMessage());
        }
    }

    public function addWinner($slug)
    {
        try {
            $data = Tournament::with('penyelenggara')->where('slug', $slug)->first();
            if($data->id_penyelenggara != Auth::user()->id_user) {
                return back()->with('error', 'Anda tidak punya akses !');
            }

            $date = date("Y-m-d");

            return view('winner.add', compact(['date', 'data']));
        } catch (Exception $e) {
            return view('error');
        }
    }


    public function update_link(Request $request, $slug)
    {
        try {
            $data_update = Tournament::where('slug', $slug)->first();

            $input = [
               'link_room' => $request->link_room,
           ];

           $data_update->update($input);

            return back()->with('success', 'link berhasil diupload');
        } catch (Exception $e) {
            return view('error');
            dd($e->getMessage());
        }
    }

}
