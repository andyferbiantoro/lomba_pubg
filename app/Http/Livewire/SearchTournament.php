<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Tournament;

class SearchTournament extends Component
{
    public $tournament, $search;
   
    public $limit = 20;

    public function render()
    {
        $this->tournament = Tournament::where('nama', 'like', '%' . $this->search . '%')->latest()->limit($this->limit)->get();

        return view('livewire.search-tournament');
    }
}
