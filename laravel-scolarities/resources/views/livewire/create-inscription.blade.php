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


        <div class="p-5 flex flex-col gap-4">

            <div class="block mb-5">
                <x-jet-label value="{{ __('Matricule') }}" />
                <input type="text"
                    class="block mt-1 rounded-md border-gray-300 w-full @error('matricule')
            border-red-500 bg-red-100 animate-bounce @enderror"
                    wire:model="matricule" name="matricule">
                @error('libelle')
                    <div class="text text-red-500 mt-1">*Le champ Matricule est requis</div>
                @enderror
            </div>
            <div class="block mb-5">
                <x-jet-label value="{{ __('Nom Complet ') }}" />
                <input type="text" class="block mt-1 rounded-md border-gray-300 w-full" wire:model="fullname"
                    readonly>
            </div>


            <div class="block mb-5">
                <x-jet-label value="{{ __('Choix du niveau') }}" />
                <select name="" id="" class="block mt-1 rounded-md border-gray-300 w-full"
                    wire:model='level_id' name="level_id">
                    <option value=""></option>
                    @foreach ($currentLevels as $item)
                        <option value="{{ $item->id }}">{{ $item->libelle }}</option>
                    @endforeach
                </select>
                @error('level_id')
                    <div class="text text-red-500 mt-1">*Le Niveau est requis</div>
                @enderror
            </div>

            <div class="block mb-5">
                <x-jet-label value="{{ __('Selectionner la classe') }}" />
                <select name="" id="" class="block mt-1 rounded-md border-gray-300 w-full"
                    wire:model='classe_id' name="classe_id">
                    <option value=""></option>
                    @foreach ($classeList as $item)
                        <option value="{{ $item->id }}">{{ $item->libelle }}</option>
                    @endforeach
                </select>
                @error('classe_id')
                    <div class="text text-red-500 mt-1">*La classe est requise</div>
                @enderror
            </div>


        </div>

        <div class="p-5 flex justify-between items-center bg-gray-100">
            <button class="bg-red-600 p-3 rounded-sm text-white text-sm">Annuler</button>
            <button class="bg-green-600 p-3 rounded-sm text-white text-sm" type="submit">Ajouter</button>
        </div>


    </form>
</div>
