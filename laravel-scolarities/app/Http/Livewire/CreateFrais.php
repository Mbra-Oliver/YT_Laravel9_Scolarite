<?php

namespace App\Http\Livewire;

use App\Models\Level;
use App\Models\SchoolFees;
use App\Models\SchoolYear;
use Exception;
use Livewire\Component;

class CreateFrais extends Component
{

    public $amount;
    public $level_id;
    public $error;


    public function store(SchoolFees $fee)
    {

        $activeSchoolYear = SchoolYear::where('active', '1')->first();


        $this->validate([
            'amount' => 'integer|required',
            'level_id' => 'string|required',
        ]);

        //Condition pour éviter les doublons

        $query = SchoolFees::where('level_id', $this->level_id)->where('school_year_id', $activeSchoolYear->id)->get();

        if (count($query) < 1) {
            try {
                $fee->level_id = $this->level_id;
                $fee->school_year_id = $activeSchoolYear->id;
                $fee->montant = $this->amount;

                $fee->save();

                return redirect()->route('fees')->with('success', 'Frais de scolarité ajoutée');
            } catch (Exception $e) {
                //Sera pris en compte si on a un problème
            }
        } else {
            $this->error = 'Ce niveau a déja une scolarité. Veuillez la modifié !';
        }
    }

    public function render()
    {

        //Charger les niveaux qui appartiennent a l'anné en cour
        $currentLevels = Level::all();
        return view('livewire.create-frais', compact('currentLevels'));
    }
}
