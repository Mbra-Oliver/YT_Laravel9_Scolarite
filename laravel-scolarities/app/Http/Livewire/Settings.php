<?php

namespace App\Http\Livewire;

use App\Models\SchoolYear;
use Livewire\Component;
use Livewire\WithPagination;

class Settings extends Component
{

    use WithPagination;

    public $search = '';

    public function render()
    {
        if (!empty($this->search)) {

            $schoolYearList = SchoolYear::where('school_year', 'like', '%' . $this->search . '%')->orWhere('current_Year', 'like', '%' . $this->search . '%')->paginate(10);
        } else {
            $schoolYearList = SchoolYear::paginate(10);
        }


        return view('livewire.settings', compact('schoolYearList'));
    }
}
