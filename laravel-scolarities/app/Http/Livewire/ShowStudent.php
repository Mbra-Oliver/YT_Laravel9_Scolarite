<?php

namespace App\Http\Livewire;

use App\Models\Attribution;
use App\Models\Classe;
use App\Models\Payment;
use Livewire\Component;

class ShowStudent extends Component
{
    public $eleve;


    public function getCurrentClasse()
    {
        $query = Attribution::where('student_id', $this->eleve->id)->first();

        $currentClasseId = $query->classe_id;
        $classeQuery = Classe::find($currentClasseId);
        return $classeQuery->libelle;
    }

    public function render()
    {
        $studentsLastPayment = Payment::where('student_id', $this->eleve->id)->paginate(3);

        return view('livewire.show-student', compact('studentsLastPayment'));
    }
}
