<?php

namespace App\Http\Livewire;

use App\Models\Payment;
use Livewire\Component;
use Livewire\WithPagination;

class ListePayments extends Component
{
    use WithPagination;
    public $search = '';

    public function render()
    {

        if (!empty($this->search)) {
            $payments = Payment::paginate(10);
        } else {

            $payments = Payment::with(['student', 'classe'])->paginate(10);
        }



        return view('livewire.liste-payments', compact('payments'));
    }
}
