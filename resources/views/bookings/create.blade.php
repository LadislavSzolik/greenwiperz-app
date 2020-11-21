<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('app.new_booking') }}
        </h2>
    </x-slot>

    <div>
        <div class="max-w-7xl mx-auto pt-5 sm:py-5 sm:px-6 lg:px-8">

            @if (session()->has('message'))
            <div class="col-span-6 bg-red-100 text-red-800 rounded p-4">
                {{ session('message') }}
            </div>
            @endif   

            <form method="POST" action="/bookings/store">
                @livewire('booking-form')
            </form>

        </div> 
    </div>
</x-app-layout>