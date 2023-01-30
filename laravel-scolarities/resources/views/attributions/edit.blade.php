<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editer une inscription') }}
        </h2>
    </x-slot>

    <div class="py-2 px-12">
        @livewire('edit-inscription', ['attribution' => $attribution])
    </div>
</x-app-layout>
