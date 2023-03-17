<?php

namespace App\Http\Livewire;

use App\Models\SchoolFees;
use App\Models\SchoolYear;
use Livewire\Component;
use Livewire\WithPagination;

class ListeFrais extends Component
{

    use WithPagination;

    public $search = '';


    public function delete(SchoolFees $fee)
    {
        $fee->delete();
        return redirect()->route('niveaux')->with('success', 'Scolarité supprimé');
    }

    public function render()
    {

        if (!empty($this->search)) {
            $fees = SchoolFees::where('libelle', 'like', '%' . $this->search . '%')->orWhere('code', 'like', '%' . $this->search . '%')->paginate(10);
        } else {

            $activeSchoolYear = SchoolYear::where('active', '1')->first();

            $fees = SchoolFees::with(['level', 'schoolyear'])->whereRelation('schoolyear', 'school_year_id', $activeSchoolYear->id)->paginate(10);
        }

        return view('livewire.liste-frais', compact('fees'));
    }
}
