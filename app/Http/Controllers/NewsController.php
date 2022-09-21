<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\News;
use Exception;
use Validator;
use Auth;

class NewsController extends Controller
{
    public function index()
    {
        try {
            $data = News::with('pembuat')->orderBy('created_at', 'desc')->paginate(6);
            $new = News::orderBy('created_at', 'desc')->limit(4)->get();
    
            return view('news.index', compact(['data', 'new']));
        } catch (Exception $e) {
            return view('error');
        }
    }

    public function search(Request $request)
    {
        try {
            $data = News::with('pembuat')->where('judul', 'like', '%' . $request->search . '%')->orderBy('created_at', 'desc')->paginate(6);
            $new = News::orderBy('created_at', 'desc')->limit(4)->get();
    
            return view('news.index', compact(['data', 'new']));
        } catch (Exception $e) {
            return view('error');
        }
    }

    public function detail($slug)
    {
        try {
            $data = News::with('pembuat')->where('slug', $slug)->first();
            $new = News::orderBy('created_at', 'desc')->limit(4)->get();

            return view('news.detail', compact(['data', 'new']));
        } catch (Exception $e) {
            return view('error');
        }
    }

    public function add()
    {
        $date = date("Y-m-d");

        return view('news.add', compact(['date']));
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'judul' => 'required|unique:berita,judul',
                'slug' => 'required|unique:berita,slug',
                'kategori' => 'required',
                'konten' => 'required',
                'thumbnail' => 'required',
            ]);

            if($validator->fails()) {
                return back()->withErrors($validator->errors());
            }

            $path = "images/berita/thumbnail/";
            $thumbnail = uploads($request->thumbnail, $path);

            $tag = implode(",", $request->kategori);

            $input = [
                'judul' => $request->judul,
                'slug' => $request->slug,
                'isi' => $request->konten,
                'tag' => $tag,
                'thumbnail' => $thumbnail,
                'id_admin' => Auth::user()->id_user
            ];

            News::create($input);

            return back()->with('success', 'Berita berhasil ditambahkan !');
        } catch (Exception $e) {
            return view('error');
            dd($e->getMessage());
        }
    }

    public function edit($slug)
    {
        try {
            $data = News::with('pembuat')->where('slug', $slug)->first();

            return view('news.edit', compact(['data']));
        } catch (Exception $e) {
            return view('error');
        }
    }

    public function update(Request $request, $slug)
    {
        try {
            $update = $request->except(['tag', 'thumbnail', 'kategori', 'konten', '_token', '_method']);
            $update['id_admin'] = Auth::user()->id_user;

            if($request->kategori) {
                $tag = implode(",", $request->kategori);
                $update['tag'] = $tag;
            }

            if($request->konten) {
                $update['isi'] = $request->konten;
            }

            if($request->thumbnail) {
                $data = News::select('thumbnail')->where('slug', $slug)->first();
                $path = "images/berita/thumbnail/";

                if (Storage::disk('public')->exists($path.$data->thumbnail)) {
                    Storage::disk('public')->delete($path.$data->thumbnail);
                }

                $thumbnail = uploads($request->thumbnail, $path);
                $update['thumbnail'] = $thumbnail;
            }

            News::where('slug', $slug)->update($update);

            return redirect('/news')->with('success', 'Berita berhasil diperbarui !');
        } catch (Exception $e) {
            return view('error');
        }
    }

    public function delete($id)
    {
        try {
            $data = News::find($id);
            $path = "images/berita/thumbnail/";

            if (Storage::disk('public')->exists($path.$data->thumbnail)) {
                Storage::disk('public')->delete($path.$data->thumbnail);
            }

            News::destroy($id);

            return redirect('/news')->with('success', 'Berita berhasil dihapus.');
        } catch (Exception $e) {
            return view('error');
        }
    }
}
