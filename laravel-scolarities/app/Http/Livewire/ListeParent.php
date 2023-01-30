<?php

namespace App\Http\Livewire;

use App\Models\StudentParent;
use Livewire\Component;
use Livewire\WithPagination;

class ListeParent extends Component
{

    use WithPagination;

    public $search = '';


    public function delete(StudentParent $parent)
    {
        $parent->delete();
        return redirect()->route('students')->with('success', 'Parent d\'élève supprimé');
    }


    public function render()
    {

        if (!empty($this->search)) {
            $parents = StudentParent::where('nom', 'like', '%' . $this->search . '%')->orWhere('prenom', 'like', '%' . $this->search . '%')->orWhere('email', 'like', '%' . $this->search . '%')->paginate(10);
        } else {



            $parents = StudentParent::paginate(10);
        }

        return view('livewire.liste-parent', compact('parents'));
    }
}
