<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Liste des frais de scolarité de l\'année en cour') }}
        </h2>
    </x-slot>

    <div class="py-2 px-12">

        @livewire('liste-frais')

    </div>
</x-app-layout>
