<x-app-layout>
    <x-header>
        <x-slot name="title">{{ __('Terms & Conditions') }}</x-slot>
        <x-slot name="actions"></x-slot>
    </x-header>
    <div class="max-w-7xl mx-auto  sm:px-6 lg:px-8">
        <div class="sm:pb-6 bg-white rounded">
            <div class="mt-8 max-w-screen-xl mx-auto py-14 px-8 sm:px-24 lg:px-32 text-gray-700">
                <x-terms-content />
            </div>
        </div>
    </div>    
</x-app-layout>
