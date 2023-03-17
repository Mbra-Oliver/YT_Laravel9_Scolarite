<?php

namespace App\Http\Livewire;

use App\Models\Family;
use Livewire\Component;
use Livewire\WithPagination;

class ListeParent extends Component
{

    use WithPagination;

    public $search = '';


    public function delete(Family $parent)
    {
        $parent->delete();
        return redirect()->route('students')->with('success', 'Parent d\'élève supprimé');
    }


    public function render()
    {

        if (!empty($this->search)) {
            $parents = Family::where('nom', 'like', '%' . $this->search . '%')->orWhere('prenom', 'like', '%' . $this->search . '%')->orWhere('email', 'like', '%' . $this->search . '%')->paginate(10);
        } else {



            $parents = Family::paginate(10);
        }

        return view('livewire.liste-parent', compact('parents'));
    }
}
