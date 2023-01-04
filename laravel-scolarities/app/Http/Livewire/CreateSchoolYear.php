<?php

namespace App\Http\Livewire;

use App\Models\SchoolYear;
use Carbon\Carbon;
use Exception;
use Livewire\Component;

class CreateSchoolYear extends Component
{
    public $libelle;


    public function store(SchoolYear $schoolYear)
    {
        $this->validate([
            'libelle' => 'string|required|unique:school_years,school_year'
        ]);
        try {


            $currentYear = Carbon::now()->format('Y');

            $check = SchoolYear::where('current_Year', $currentYear)->get();

            $alreadyExist = $check->count();

            if ($alreadyExist >= 1) {

                return redirect()->back()->with('error', 'L\'année en cour a déja été ajouté');
            } else {
                $schoolYear->school_year = $this->libelle;
                $schoolYear->current_Year = $currentYear;

                $schoolYear->save();

                if ($schoolYear) {
                    $this->libelle = '';
                }
                return redirect()->route('settings')->with('success', 'Année scolaire ajouté');
            }
        } catch (Exception $e) {
            //Sera pris en compte si on a un problème
        }
    }

    public function render()
    {
        return view('livewire.create-school-year');
    }
}
