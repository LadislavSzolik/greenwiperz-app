<div class="space-y-4">
    <div class="space-y-4 sm:space-y-0 sm:space-x-4 sm:flex">

        <x-input.group for="date_for_editing" label="{{ __('app.date') }}">
            <x-input.date wire:model="editing.date_for_editing" />
        </x-input.group> 

        <x-input.group for="editing.start_time" label="{{ __('app.from') }}">
            <select class="rounded-md flex-1 form-input block w-full" id="start" wire:model="editing.start_time">
                <option value="" selected>-- {{ __('app.select')}}</option>
                @foreach($timeslots as $timeslot)
                <option value="{{$timeslot }}">{{$timeslot}}</option>
                @endforeach
            </select>
        </x-input.group>
        <x-input.group for="editing.end_time" label="{{ __('app.until') }}">
            <select class="rounded-md flex-1 form-input block w-full" id="end" wire:model="editing.end_time">
                <option value="" selected>-- {{ __('app.select')}}</option>
                @foreach($timeslots as $timeslot)
                <option value="{{$timeslot }}">{{$timeslot}}</option>
                @endforeach
            </select>
        </x-input.group>
    </div>
    
    <x-input.group for="editing.comment" label="{{ __('app.remarks') }}">
        <x-input.text wire:model="editing.comment" type="text" id="comment" placeholder="e.g holidays" />
    </x-input.group>
</div>