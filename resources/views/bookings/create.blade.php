<x-app-layout>
    <x-header>
        <x-slot name="title">{{ __('app.bookings') }}</x-slot>
        <x-slot name="actions">
        </x-slot>
    </x-header>


    <div class="max-w-7xl mx-auto py-4 sm:px-6 lg:px-8">

        <form method="POST" action="/bookings/store">
            @livewire('booking-form')
        </form>

    </div> 

</x-app-layout>