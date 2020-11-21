<div>
    <div>
        <div class="flex justify-end py-2">
            <x-div-button wire:click="create" buttonType="primary">{{ __('app.new') }}</x-div-button>
        </div>
        <x-table>
            <x-slot name="head">
                <x-table.heading>{{ __('app.date')}}</x-table.heading>
                <x-table.heading>{{ __('app.from')}}</x-table.heading>
                <x-table.heading>{{ __('app.until')}}</x-table.heading>
                <x-table.heading>Greenwiper</x-table.heading>
                <x-table.heading>{{ __('app.remarks') }}</x-table.heading>
                <x-table.heading></x-table.heading>
            </x-slot>
            <x-slot name="body">
                @forelse ($appointments as $appointment)
                <x-table.row>
                    <x-table.cell>
                        {{ $appointment->date }}
                    </x-table.cell>
                    <x-table.cell>
                        {{ $appointment->start_time }}
                    </x-table.cell>
                    <x-table.cell>
                        {{ $appointment->end_time }}
                    </x-table.cell>
                    <x-table.cell>
                        {{ $appointment->assignedTo->email }}
                    </x-table.cell>
                    <x-table.cell>
                        {{ $appointment->comment }}
                    </x-table.cell>
                    <x-table.cell>
                        <x-button.link wire:click="delete({{$appointment->id}})">
                            <span class="text-red-500">{{ __('app.delete') }}</span>
                        </x-button.link>
                    </x-table.cell>
                </x-table.row>
                @empty
                <x-table.row>
                    <x-table.cell colspan="6" class="text-center">
                        <span class="text-gray-500">{{ __('app.no_vacation') }}</span>
                    </x-table.cell>
                </x-table.row>
                @endforelse
            </x-slot>

        </x-table>
        <div class="mt-2">
            {{ $appointments->links() }}
        </div>

    </div>

    <form wire:submit.prevent="save">
        <x-jet-dialog-modal wire:model="showModal">
            <x-slot name="title">
                {{ __('app.new_vacation') }}
            </x-slot>
            <x-slot name="content">
                <div class="space-y-2">

                    <x-input.group for="date_for_editing" label="{{ __('app.date') }}">
                        <x-input.date wire:model="editing.date_for_editing" />
                    </x-input.group>

                    <x-input.group for="editing.start_time" label="{{ __('app.from') }}">
                        <select class="rounded-none rounded-r-md flex-1 form-input block w-full" id="start" wire:model="editing.start_time">
                            <option value="" selected>-- {{ __('app.select')}}</option>
                            @foreach($timeslots as $timeslot)
                            <option value="{{$timeslot }}">{{$timeslot}}</option>
                            @endforeach
                        </select>
                    </x-input.group>
                    <x-input.group for="editing.end_time" label="{{ __('app.until') }}">
                        <select class="rounded-none rounded-r-md flex-1 form-input block w-full" id="end" wire:model="editing.end_time">
                            <option value="" selected>-- {{ __('app.select')}}</option>
                            @foreach($timeslots as $timeslot)
                            <option value="{{$timeslot }}">{{$timeslot}}</option>
                            @endforeach
                        </select>
                    </x-input.group>
                    <x-input.group for="editing.comment" label="{{ __('app.remarks') }}">
                        <x-input.text wire:model="editing.comment" type="text" id="comment" placeholder="e.g holidays" />
                    </x-input.group>

                </div>
            </x-slot>

            <x-slot name="footer">
                <x-jet-secondary-button wire:click="$set('showModal', false)" wire:loading.attr="disabled">
                {{ __('app.cancel') }}
                </x-jet-secondary-button>
                <x-jet-button class="ml-2" wire:loading.attr="disabled">
                {{ __('app.save') }}
                </x-jet-button>
            </x-slot>
        </x-jet-dialog-modal>
    </form>

</div>