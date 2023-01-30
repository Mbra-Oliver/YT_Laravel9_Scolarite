<?php

namespace App\Http\Livewire;

use App\Models\Attribution;
use App\Models\Classe;
use App\Models\Level;
use App\Models\SchoolYear;
use App\Models\Student;
use Exception;
use Livewire\Component;

class CreateInscription extends Component
{
    public $student_id;
    public $level_id;
    public $matricule;
    public $classe_id;
    public $fullname;
    public $error;


    public function store(Attribution $attribution)
    {
        $activeSchoolYear = SchoolYear::where('active', '1')->first();


        //COndition personnalisé pour empecher un élève d'être inscrit deux fois la meme année.

        $query = Attribution::where('student_id', $this->student_id)->where('school_year_id', $activeSchoolYear->id)->get();


        if ($query->count() > 0) {
            //Alors ne pas faire l'inscription

            $this->error = 'Cet élève est déja inscrit. Modifier les informations si nécéssaire';
        } else {

            $this->validate([
                'matricule' => 'string|required',
                'level_id' => 'string|required',
                'classe_id' => 'string|required',
            ]);
            try {

                $attribution->student_id = $this->student_id;
                $attribution->classe_id = $this->classe_id;
                $attribution->school_year_id = $activeSchoolYear->id;

                $attribution->save();

                return redirect()->route('inscriptions')->with('success', 'Inscription effectué');
            } catch (Exception $e) {
                //Sera pris en compte si on a un problème

                dd($e);
            }
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

        return view('livewire.create-inscription', compact('currentLevels', 'classeList'));
    }
}
