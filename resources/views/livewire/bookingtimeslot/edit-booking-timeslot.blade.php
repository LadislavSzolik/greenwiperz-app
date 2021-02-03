<div class="grid grid-cols-6 gap-4">




    <x-input.group class="col-span-6 sm:col-span-3" for="appointment.date_for_editing" label="{{ __('app.date') }}">
        <x-input.date id="{{$appointment->id}}" wire:model="appointment.date_for_editing" placeholder="DD.MM.YYYY" />
    </x-input.group>

    <!-- timeslots on day -->
    <x-input.group class="col-span-6 sm:col-span-6" for="timeslotOnDay" label="{{ __('Other bookings on')  }} {{$appointment->date_for_editing}}">
        <ul>
            @forelse($appointmentsOnDay as $timeslotOnDay)
            <li class="list-disc list-inside">{{ $timeslotOnDay->start_time }} - {{ $timeslotOnDay->end_time }}
                @isset($timeslotOnDay->booking)
                @if($timeslotOnDay->id === $appointment->id)
                <span class="text-orange-500 px-2">{{__('This booking')}}</span>
                @endif
                @endisset
            </li>
        </ul>
        @empty
        <p>{{__('No appointments yet')}}</p>
        @endforelse
    </x-input.group>

    <x-input.group class="col-span-3 sm:col-span-3" for="appointment.start_time" label="{{ __('app.from') }}">
        <select class="rounded-md flex-1 form-input block w-full" id="start" wire:model="appointment.start_time">
            <option value="" selected>-- {{ __('app.select')}}</option>
            @foreach($timeslots as $timeslot)
            <option value="{{$timeslot }}">{{$timeslot}}</option>
            @endforeach
        </select>
    </x-input.group>

    <x-input.group class="col-span-3 sm:col-span-3" for="appointment.end_time" label="{{ __('app.until') }}">
        <select class="rounded-md flex-1 form-input block w-full" id="end" wire:model="appointment.end_time">
            <option value="" selected>-- {{ __('app.select')}}</option>
            @foreach($timeslots as $timeslot)
            <option value="{{ Carbon\Carbon::parse($timeslot)->subMinute()->format('H:i:s') }}">{{ Carbon\Carbon::parse($timeslot)->subMinute()->format('H:i:s') }}</option>
            @endforeach
        </select>
    </x-input.group>

    <div class="col-span-6 flex">
        <x-div-button wire:click="deleteAppointment" buttonType="tertiaryDestructive">{{ __('Delete date')}}</x-div-button>

        <x-div-button wire:click="saveAppointment" buttonType="primary">{{ __('Save this date')}}</x-div-button>
        <x-jet-action-message class="ml-4 mt-2" on="saved">
            {{ __('Saved.') }}
        </x-jet-action-message>

    </div>


</div>