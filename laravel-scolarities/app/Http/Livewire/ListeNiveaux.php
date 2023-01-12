<?php

namespace App\Http\Livewire;

use App\Models\Level;
use Livewire\Component;
use Livewire\WithPagination;

class ListeNiveaux extends Component
{
    use WithPagination;

    public $search = '';
    public function render()
    {
        if (!empty($this->search)) {

            $levels = Level::where('libelle', 'like', '%' . $this->search . '%')->orWhere('code', 'like', '%' . $this->search . '%')->paginate(10);
        } else {
            $levels = Level::paginate(10);
        }

        return view('livewire.liste-niveaux', compact('levels'));
    }
}
