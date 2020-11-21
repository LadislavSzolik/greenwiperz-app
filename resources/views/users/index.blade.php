<x-app-layout>
    <x-slot name="header">
        <div class="inline-flex  items-center justify-between w-full">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('app.users')}} (Greenwiperz)
            </h2>                    
        </div>
    </x-slot> 
    <div class="max-w-7xl mx-auto py-4 px-2 sm:px-6 lg:px-8">            
            @livewire('users')                
    </div>
    <x-footer />
</x-app-layout>