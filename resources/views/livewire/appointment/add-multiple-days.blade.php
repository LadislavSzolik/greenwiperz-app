<div class="space-y-4" >
    <div class="space-y-4 sm:space-y-0 sm:flex sm:justify-between">
        <x-input.group for="date_from" label="{{ __('app.from')}}">
            <x-input.date wire:model="date_from" />
        </x-input.group>
    
        <x-input.group for="date_to" label="{{ __('app.until')}}">
            <x-input.date wire:model="date_to" />
        </x-input.group>
    </div>

    <x-input.group for="comment" label="{{ __('app.remarks') }}">
        <x-input.text wire:model="comment" type="text" id="comment" placeholder="e.g holidays" />
    </x-input.group>
</div>
