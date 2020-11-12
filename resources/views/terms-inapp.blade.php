<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Terms & Conditions') }}
        </h2>
    </x-slot>
    <div class="max-w-7xl mx-auto py-2 sm:px-6 lg:px-8">
        <div class="sm:pb-6 bg-white rounded">
            <div class="mt-8 max-w-screen-xl mx-auto py-14 px-8 sm:px-24 lg:px-32 text-gray-700">
                <x-terms-content />
            </div>
        </div>
    </div>
    <x-footer />
</x-app-layout>
