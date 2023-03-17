<div>

    <div class="w-full flex">
        <div class="w-2/3">
            <div class="custom_card p-3 bg-white rounded-md flex flex-col">
                <div class="title pb-2 border-b-2 border-b-red-500">Information de l'élève</div>
                <section class="flex mt-2 flex-row">
                    <div class="div w-24 ">

                        <img src="https://ui-avatars.com/api/?name={{ $eleve->nom }}+{{ $eleve->prenom }}"
                            alt="" class="w-24">
                    </div>
                    <section class="flex flex-col">

                        <div class="flex flex-row pl-3">
                            <div class="name  mr-2 uppercase">Matricule: </div>
                            <div class="name  text-md uppercase"> {{ $eleve->matricule }}</div>
                        </div>

                        <div class="flex flex-row pl-3">
                            <div class="name font-bold mr-2">{{ $eleve->nom }} </div>
                            <div class="name font-bold text-md"> {{ $eleve->prenom }}</div>
                        </div>
                        <div class="flex flex-row pl-3">
                            <div class="name  mr-2">Classe actuelle: </div>
                            <div class="name  text-md"> {{ $this->getCurrentClasse() }}</div>
                        </div>
                    </section>
                </section>

                <div class="title pb-2 border-b-2 border-b-red-500">Derniers paiement effectués</div>

                @forelse ($studentsLastPayment as $payment)
                    <div class="shadow-sm p-2 border-b-1 mt-2 border-b-red-200 ">
                        <span>{{ $payment->montant }} Euro /Dollar /FCFA</span>
                        <span>Payé le :{{ $payment->created_at }}</span>
                    </div>


                @empty
                    <p>Aucun paiement effectué !</p>
                @endforelse
                <div>{{ $studentsLastPayment->links() }}</div>
            </div>
        </div>
        <div class="w-1/3">


        </div>
    </div>
</div>
