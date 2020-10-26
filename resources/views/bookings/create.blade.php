<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">        
            {{ __('New booking') }}                   
        </h2>
    </x-slot>

    <div>
        <div class="max-w-6xl mx-auto pt-5 sm:py-5 sm:px-6 lg:px-8">          
            @livewire('booking.create')           
        </div>
    </div>
</x-app-layout>