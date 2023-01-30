<?php

namespace App\Http\Livewire;

use App\Models\Attribution;
use App\Models\Classe;
use App\Models\Level;
use App\Models\SchoolYear;
use App\Models\Student;
use Exception;
use Livewire\Component;

class EditInscription extends Component
{

    public $attribution;
    public $student_id;
    public $level_id;
    public $matricule;
    public $classe_id;
    public $fullname;
    public $error;


    public function mount()
    {
        //Recuperer les informations de l'élève

        $defaultStudentId = $this->attribution->student_id;
        $query = Student::find($defaultStudentId);

        $this->matricule = $query->matricule;
        $this->student_id = $query->id;


        //recuperer le niveau concerner

        $selectedLevel = Classe::where('id', $this->attribution->classe_id)->first();

        $this->level_id = $selectedLevel->level_id;

        //Initialiser la valeur de classe_id;
        $this->classe_id = $this->attribution->classe_id;
    }


    public function update()
    {
        $attribution = Attribution::find($this->attribution->id);

        $this->validate([
            'matricule' => 'string|required',
            'level_id' => 'string|required',
            'classe_id' => 'string|required',
        ]);
        try {

            $attribution->student_id = $this->student_id;
            $attribution->classe_id = $this->classe_id;

            $attribution->save();

            return redirect()->route('inscriptions')->with('success', 'Inscription modifié');
        } catch (Exception $e) {
            //Sera pris en compte si on a un problème

            dd($e);
        }
    }

    public function render()
    {
        $activeSchoolYear = SchoolYear::where('active', '1')->first();

        $currentLevels = Level::where('school_year_id', $activeSchoolYear->id)->get();

        if (isset($this->matricule)) {
            $currentStudent = Student::where('matricule', $this->matricule)->first();

            if ($currentStudent) {

                //Retourner le nom complet
                $this->fullname = $currentStudent->nom . ' ' . $currentStudent->prenom;

                //Sauvegarder l'id de l'élève

                $this->student_id = $currentStudent->id;
            } else {
                $this->fullname = '';
            }
        }

        if (isset($this->level_id)) {

            $classeList = Classe::where('level_id', $this->level_id)->get();
        } else {
            $classeList = [];
        }
        return view('livewire.edit-inscription', compact('currentLevels', 'classeList'));
    }
}
