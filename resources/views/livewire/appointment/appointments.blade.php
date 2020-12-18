<div>
    <x-header>
        <x-slot name="title">{{ __('Vacations') }}</x-slot>
        <x-slot name="actions">
            <x-div-button wire:click="create" buttonType="primary">{{ __('New')}}</x-div-button>
        </x-slot>
    </x-header>

    <div class="max-w-7xl mx-auto py-4 px-2 sm:px-6 lg:px-8">        
        <x-table>
            <x-slot name="head">
                <x-table.heading sortable wire:click="sortBy('date')" :direction="$sortField == 'date' ? $sortDirection : null" >{{ __('app.date')}}</x-table.heading>
                <x-table.heading sortable wire:click="sortBy('start_time')" :direction="$sortField == 'start_time' ? $sortDirection : null">{{ __('app.from')}}</x-table.heading>
                <x-table.heading sortable wire:click="sortBy('end_time')" :direction="$sortField == 'end_time' ? $sortDirection : null">{{ __('app.until')}}</x-table.heading>
                <x-table.heading sortable wire:click="sortBy('comment')" :direction="$sortField == 'comment' ? $sortDirection : null">{{ __('app.remarks') }}</x-table.heading>
                <x-table.heading></x-table.heading>
            </x-slot>
            <x-slot name="body">
                @forelse ($appointments as $appointment)
                <x-table.row>
                    <x-table.cell>
                        {{   Carbon\Carbon::parse($appointment->date)->format('Y-m-d') }}
                    </x-table.cell>
                    <x-table.cell>
                        {{ $appointment->start_time }}
                    </x-table.cell>
                    <x-table.cell>
                        {{ $appointment->end_time }}
                    </x-table.cell>
                    <x-table.cell>
                        {{ $appointment->comment }}
                    </x-table.cell>
                    <x-table.cell>
                        <x-button.link wire:click="delete({{$appointment->id}})">
                            <span class="text-red-500">{{ __('Delete') }}</span>
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

                    <div class="w-full border-cool-gray-300 border-b mb-4">
                        <button 
                            type="button" 
                            wire:click="$set('showSingle', false)" 
                            class="px-4 py-2 text-sm font-medium transition duration-150 ease-in-out border-b-2 @if(!$showSingle) border-green-400 @else text-gray-500 border-transparent  hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300  @endif" >
                            {{__('Multiple days')}}
                        </button>
                        <button 
                            type="button"
                            wire:click="$set('showSingle', true)"
                            class="px-4 py-2 text-sm font-medium transition duration-150 ease-in-out border-b-2 @if($showSingle) border-green-400 @else text-gray-500 border-transparent hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300  @endif"
                        >{{__('Single day')}}</button>
                    </div>

                    <div class="@if(!$showSingle) hidden @endif" >
                        <livewire:appointment.add-single-day/>
                    </div>
                    <div class="@if($showSingle) hidden @endif" >
                        <livewire:appointment.add-multiple-days/>
                    </div>                    
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