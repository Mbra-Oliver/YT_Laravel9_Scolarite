<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Effectuer un paiement') }}
        </h2>
    </x-slot>

    <div class="py-2 px-12">
        @livewire('create-payments')
    </div>
</x-app-layout>
