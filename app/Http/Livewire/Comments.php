<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Comment;
use Auth;

class Comments extends Component
{
    public $comments, $id_berita, $komentar; 

    public function render()
    {
        $this->comments = Comment::with('pembuat')->where('id_berita', $this->id_berita)->orderBy('created_at', 'desc')->get();

        return view('livewire.comments');
    }

    private function resetInputFields(){
        $this->komentar = '';
    }

    public function store()
    {
        $this->validate([
            'komentar' => 'required',
        ]);
   
        Comment::create([
            'komentar' => $this->komentar,
            'id_berita' => $this->id_berita,
            'id_user' => Auth::user()->id_user
        ]);
  
        session()->flash('success', 'Komentar berhasil diposting');

        $this->resetInputFields();
    }
}
