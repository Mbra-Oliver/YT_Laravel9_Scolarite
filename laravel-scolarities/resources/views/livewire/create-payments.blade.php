<div class="p-2 bg-white shadow-sm">

    <form method="POST" wire:submit.prevent="store">
        @csrf
        @method('post')

        @if (Session::get('error'))
            <div class="p-5">
                <div class="p-4 border-red-500 bg-red-400 animate-bounce text-white">{{ Session::get('error') }}</div>
            </div>
        @endif

        @if ($error)
            <div class="p-5">
                <div class="p-4 border-red-700 bg-red-700 animate-bounce text-white rounded-sm">{{ $error }}</div>
            </div>
        @endif


        @if ($success)
        <div class="p-5">
            <div class="p-4 border-green-700 bg-green-700 animate-bounce text-white rounded-sm">{{ $success }}</div>
        </div>
    @endif


        <div class="p-5 flex flex-col gap-4">


            <div class="block mb-5">
                <x-jet-label value="{{ __('Matricule') }}" />
                <input type="text"
                    class="block mt-1 rounded-md border-gray-300 w-full @error('matricule')
            border-red-500 bg-red-100 animate-bounce
                @enderror"
                    wire:model="matricule" name="matricule">
                @error('matricule')
                    <div class="text text-red-500 mt-1">*Le champ Matricule est requis</div>
                @enderror
            </div>
            <div class="block mb-5">
                <x-jet-label value="{{ __('Eleve Trouvé') }}" />
                <input type="text" class="block mt-1 rounded-md border-gray-300 w-full" wire:model="fullname"
                    name="fullname" readonly>

            </div>

            <div class="block mb-5">
                <x-jet-label value="{{ __('Montant') }}" />
                <input type="text"
                    class="block mt-1 rounded-md border-gray-300 w-full @error('montant')
            border-red-500 bg-red-100 animate-bounce
                @enderror"
                    wire:model="montant" name="montant">
                @error('montant')
                    <div class="text text-red-500 mt-1">*Le champ Montant est requis</div>
                @enderror
            </div>
        </div>

        <div class="p-5 flex justify-between items-center bg-gray-100">
            <button class="bg-red-600 p-3 rounded-sm text-white text-sm">Annuler</button>
            <button class="bg-green-600 p-3 rounded-sm text-white text-sm" type="submit">Ajouter</button>
        </div>


    </form>
</div>
