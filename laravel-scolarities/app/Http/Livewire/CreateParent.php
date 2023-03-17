<?php

namespace App\Http\Livewire;
use App\Models\Family;
use App\Notifications\SendParentRegistrationNotification;
use Exception;
use Livewire\Component;

class CreateParent extends Component
{
    public $email;
    public $nom;
    public $prenom;
    public $contact;

    public function store(Family $parent)
    {
        $this->validate([
            'email' => 'email|required|unique:parents,email',
            'nom' => 'string|required',
            'prenom' => 'string|required',
            'contact' => 'string|required',
        ]);
        try {


            $parent->nom = $this->nom;
            $parent->prenom = $this->prenom;
            $parent->email = $this->email;
            $parent->contact = $this->contact;

            $parent->save();


            //Envoyer un mail au parent une fois ajouté dans la bd

            //Verifier si le parent est inscrit dans la bd

            if ($parent) {
                $parent->notify(new SendParentRegistrationNotification());
            }

            return redirect()->route('parents')->with('success', 'Parent ajoutée');
        } catch (Exception $e) {
            //Sera pris en compte si on a un problème

            dd($e);
        }
    }

    public function render()
    {
        return view('livewire.create-parent');
    }
}
