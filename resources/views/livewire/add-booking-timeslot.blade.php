<div class="grid grid-cols-6 gap-4">
    <!-- booking date -->
    <x-input.group class="col-span-6 sm:col-span-3" for="date" label="{{ __('app.date') }}">
        <x-input.date wire:model="booking.date" placeholder="DD.MM.YYYY" />
    </x-input.group>

    <!-- timeslots on day -->
    <x-input.group class="col-span-6 sm:col-span-3" for="timeslotOnDay" label="{{ __('Existing appointments') }}">
        @forelse($appointmentsOnDay as $timeslotOnDay)
        <div>{{ $timeslotOnDay->start_time }} - {{ $timeslotOnDay->end_time }}
            @isset($timeslotOnDay->booking)
            @if($timeslotOnDay->booking->id === $booking->id)
            <span class="text-orange-500 px-2">{{__('This booking')}}</span>
            @endif
            @endisset
        </div>

        @empty
        <p>{{__('No appointments')}}</p>
        @endforelse

    </x-input.group>


    <x-input.group class="col-span-3" for="time" label="{{ __('app.from') }}">
        <select class="rounded-md flex-1 form-input block w-full" id="start" wire:model="booking.time">
            <option value="" selected>-- {{ __('app.select')}}</option>
            @foreach($timeslots as $timeslot)
            <option value="{{$timeslot }}">{{$timeslot}}</option>
            @endforeach
        </select>
    </x-input.group>

    <x-input.group class="col-span-3" for="end_time" label="{{ __('app.until') }}">
        <select class="rounded-md flex-1 form-input block w-full" id="end" wire:model="end_time">
            <option value="" selected>-- {{ __('app.select')}}</option>
            @foreach($timeslots as $timeslot)
            <option value="{{$timeslot }}">{{$timeslot}}</option>
            @endforeach
        </select>
    </x-input.group>

    <div class="col-span-6 ">
        <x-div-button wire:click="saveAppointment" buttonType="primary">{{ __('Save')}}</x-div-button>                   
    </div>
</div>