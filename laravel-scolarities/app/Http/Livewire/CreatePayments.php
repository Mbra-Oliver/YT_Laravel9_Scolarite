<?php

namespace App\Http\Livewire;

use App\Models\Attribution;
use App\Models\Classe;
use App\Models\Payment;
use App\Models\SchoolYear;
use App\Models\Student;
use Exception;
use Livewire\Component;

class CreatePayments extends Component
{

    public $matricule;
    public $montant;
    public $fullname;
    public $student_id;
    public $success;
    public $haveSuccess = false;
    public $error;
    public $haveError = false;

    public function store(Payment $payment)
    {

        $totalPaid  = 0;

        $activeSchoolYear = SchoolYear::where('active', '1')->first();

        $getClasseQuery = Attribution::where('student_id', '=', $this->student_id)->where('school_year_id', $activeSchoolYear->id)->first();

        //Cond 1: Recuperer le montant de la scolarité d'une classe en fonction du niveau (classe)

        $studentClasseId = $getClasseQuery->classe_id;

        $classData = Classe::with('level')->find($studentClasseId);

        $montantScolarite = $classData->level->scolarite;



        //Cond 2: Faire le cumul des paiements déja efectué et le comparer au montant de la scolarité

        $studentPaymentsList = Payment::where('student_id', $this->student_id)->where('school_year_id', $activeSchoolYear->id)->get();

        foreach ($studentPaymentsList as $studentPayment) {

            $totalPaid = $totalPaid + $studentPayment->montant;
        }


        //Verifier que le montant total de la scolarité n'est pas inférieur au montant déja payé + le montant du paiement en cour

        $operatioResult = $totalPaid - $montantScolarite;
        if (($totalPaid + $this->montant) > $montantScolarite) {
            //erreur

            if ($operatioResult == 0) {
                $this->success = 'Félicitation; la Scolarité de cet élève est réglé.';

                $this->haveError = true;
            } else {
                $this->error = 'Attention. Il reste a payer ' . $montantScolarite - $totalPaid . ' Euro/Dollar';
                $this->haveError = true;
            }
        }

        if (!$this->haveError) {
            $this->validate([
                'matricule' => 'string|required',
                'montant' => 'string|required',
            ]);
            try {

                //Recuperer l'id de la classe de l'élève

                $payment->student_id = $this->student_id;
                $payment->classe_id = $getClasseQuery->classe_id;
                $payment->school_year_id = $activeSchoolYear->id;
                $payment->montant = $this->montant;

                $payment->save();
                return redirect()->route('payments')->with('success', 'Paiement de scolarité effectué');
            } catch (Exception $e) {
                //Sera pris en compte si on a un problème

                dd($e);
            }
        }
    }
    public function render()
    {

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
        return view('livewire.create-payments');
    }
}
