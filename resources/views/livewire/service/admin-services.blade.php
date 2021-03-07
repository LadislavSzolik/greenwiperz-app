<div>
    <x-header>
        <x-slot name="title">{{ __('Services') }}</x-slot>
        <x-slot name="actions">
            <x-div-button wire:click="create" buttonType="primary">{{ __('New')}}</x-div-button>
        </x-slot>
    </x-header>

    <div class="max-w-7xl mx-auto py-4 sm:px-6 lg:px-8">
        Todo...
    </div>
</div>
