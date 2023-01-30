<?php

namespace App\Http\Livewire;

use App\Models\Attribution;
use App\Models\Classe;
use Livewire\Component;
use Livewire\WithPagination;

class ListeInscription extends Component
{


    use WithPagination;

    public $search = '';
    public $selected_classe_id;




    public function render()
    {




        if (isset($this->selected_classe_id)) {

            if (!empty($this->search)) {

                $inscriptionsList = Attribution::where('nom', 'like', '%' . $this->search . '%')->orWhere('prenom', 'like', '%' . $this->search . '%')->paginate(10);

            } else {

                $inscriptionsList = Attribution::with(['student', 'classe'])->where('classe_id', $this->selected_classe_id)->paginate(10);
            }
        }else{
            if (!empty($this->search)) {
                $inscriptionsList = Attribution::where('nom', 'like', '%' . $this->search . '%')->orWhere('prenom', 'like', '%' . $this->search . '%')->paginate(10);
            } else {
                $inscriptionsList = Attribution::with(['student', 'classe'])->paginate(10);
            }
        }

        $classeList = Classe::all();
        return view('livewire.liste-inscription', compact('inscriptionsList', 'classeList'));
    }
}
