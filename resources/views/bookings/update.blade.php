<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">    
                {{ __('app.modify_booking') }}                   
        </h2>
    </x-slot>

    <div>
        <div class="max-w-7xl mx-auto pt-5 sm:py-5 sm:px-6 lg:px-8">  
            
            <form method="POST" action="/bookings/{{ $booking->id }}">       
                @method('PATCH')         
                @livewire('booking-form', ['booking'=> $booking])                           
            </form>

        </div>
    </div>
</x-app-layout>