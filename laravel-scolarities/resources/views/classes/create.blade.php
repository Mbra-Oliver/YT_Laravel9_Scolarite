<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Nouvelle classe') }}
        </h2>
    </x-slot>

    <div class="py-2 px-12">
        @livewire('create-classe')
    </div>
</x-app-layout>
