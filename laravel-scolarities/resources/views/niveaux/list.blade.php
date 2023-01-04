<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Liste des Niveaux') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-full w-full mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-8">

                @livewire('liste-niveaux')

            </div>
        </div>
    </div>
</x-app-layout>
