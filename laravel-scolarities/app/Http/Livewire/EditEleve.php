<?php

namespace App\Http\Livewire;

use App\Models\Student;
use Exception;
use Livewire\Component;

class EditEleve extends Component
{
    public $eleve;
    public $matricule;
    public $nom;
    public $prenom;
    public $naissance;
    public $contact_parent;

    public function mount()
    {

        $this->matricule = $this->eleve->matricule;
        $this->nom = $this->eleve->nom;
        $this->prenom = $this->eleve->prenom;
        $this->naissance = $this->eleve->naissance;
        $this->contact_parent = $this->eleve->contact_parent;
    }

    public function update()
    {
        $student = Student::find($this->eleve->id);
        $this->validate([
            'matricule' => 'string|required',
            'nom' => 'string|required',
            'prenom' => 'string|required',
            'naissance' => 'string|required',
            'contact_parent' => 'string|required',
        ]);
        try {


            $student->matricule = $this->matricule;
            $student->nom = $this->nom;
            $student->prenom = $this->prenom;
            $student->naissance = $this->naissance;
            $student->contact_parent = $this->contact_parent;

            $student->save();

            return redirect()->route('students')->with('success', 'Information de l\'élève mis à jour');
        } catch (Exception $e) {
            //Sera pris en compte si on a un problème
        }
    }
    public function render()
    {
        return view('livewire.edit-eleve');
    }
}
