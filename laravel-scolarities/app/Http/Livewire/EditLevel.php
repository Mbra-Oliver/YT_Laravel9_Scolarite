<?php

namespace App\Http\Livewire;

use App\Models\Level;
use Exception;
use Livewire\Component;

class EditLevel extends Component
{
    public $level;
    public $code;
    public $libelle;
    public $scolarite;

    //Etape ou composante est monté

    public function mount()
    {
        $this->code = $this->level->code;
        $this->libelle = $this->level->libelle;
        $this->scolarite = $this->level->scolarite;
    }

    public function store()
    {
        $level = Level::find($this->level->id);

        $this->validate([
            'code' => 'string|required',
            'libelle' => 'string|required',
            'scolarite' => 'integer|required',
        ]);
        try {

            $level->code = $this->code;
            $level->libelle = $this->libelle;
            $level->scolarite = $this->scolarite;

            $level->save();
            return redirect()->route('niveaux')->with('success', 'Niveau mis à jour');
        } catch (Exception $e) {
            //Sera pris en compte si on a un problème


            dd($e);
        }
    }

    

    public function render()
    {

        return view('livewire.edit-level');
    }
}
