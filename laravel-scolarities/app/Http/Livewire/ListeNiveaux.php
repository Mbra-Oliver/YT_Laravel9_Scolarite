<?php

namespace App\Http\Livewire;

use App\Models\Level;
use App\Models\SchoolFees;
use App\Models\SchoolYear;
use Livewire\Component;
use Livewire\WithPagination;

class ListeNiveaux extends Component
{
    use WithPagination;

    public $search = '';


    public function delete(Level $level)
    {
        $level->delete();
        return redirect()->route('niveaux')->with('success', 'Niveau supprimé');
    }


    public function getScolaritieAmount($levelId)
    {
        $activeSchoolYear = SchoolYear::where('active', '1')->first();
        $query = SchoolFees::where('level_id', $levelId)->where('school_year_id', $activeSchoolYear->id)->first();

        return $query->montant;
    }

    public function render()
    {
        if (!empty($this->search)) {
            $levels = Level::where('libelle', 'like', '%' . $this->search . '%')->orWhere('code', 'like', '%' . $this->search . '%')->paginate(10);
        } else {


            $activeSchoolYear = SchoolYear::where('active', '1')->first();

            $levels = Level::with('schoolFees')->paginate(10);
        }


        return view('livewire.liste-niveaux', compact('levels'));
    }
}
