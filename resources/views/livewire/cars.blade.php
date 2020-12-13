<div>
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <div class="inline-flex  items-center justify-between w-full">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Cars') }}
                </h2>
                <x-div-button wire:click="create" buttonType="primary">{{ __('New')}}</x-div-button>
            </div>
        </div>
    </header>

    <div class="max-w-7xl mx-auto py-4 sm:px-6 lg:px-8 ">

        <div class="hidden sm:block">
            <x-table>
                <x-slot name="head">
                    <x-table.heading>{{ __('app.car_model')}}</x-table.heading>
                    <x-table.heading>{{ __('app.plate_number')}}</x-table.heading>
                    <x-table.heading>{{ __('app.car_color')}}</x-table.heading>
                    <x-table.heading>{{ __('app.car_category')}}</x-table.heading>
                    <x-table.heading> </x-table.heading>
                    <x-table.heading> </x-table.heading>
                </x-slot>
                <x-slot name="body">
                    @forelse ($cars as $car)
                    <x-table.row>
                        <x-table.cell>
                            {{ $car->car_model }}
                        </x-table.cell>
                        <x-table.cell>
                            {{ $car->number_plate }}
                        </x-table.cell>
                        <x-table.cell>
                            <span class="capitalize">{{ __($car->car_color) }}</span>
                        </x-table.cell>
                        <x-table.cell>
                            <span class="capitalize">{{ __($car->car_size) }}</span>
                        </x-table.cell>
                        <x-table.cell>
                            <x-button.link wire:click="edit({{$car->id}})">
                                {{ __('Edit') }}
                            </x-button.link>
                        </x-table.cell>
                        <x-table.cell>
                            <x-button.link wire:click="delete({{$car->id}})">
                                <span class="text-red-500 hover:text-red-700 hover:underline">{{ __('Delete') }}</span>
                            </x-button.link>
                        </x-table.cell>
                    </x-table.row>
                    @empty
                    <x-table.row>
                        <x-table.cell colspan="6" class="text-center">
                            <span class="text-gray-500">{{ __('No cars saved yet')}}</span>
                        </x-table.cell>
                    </x-table.row>
                    @endforelse
                </x-slot>
            </x-table>
        </div>

        <div class="block sm:hidden px-2 pb-4">
            <x-grid.list>
                @forelse ($cars as $car)
                <x-grid.list.card>
                    <x-slot name="information">
                        <div class="flex-1 truncate">
                            <p class="mt-1 text-gray-500 text-sm leading-5 truncate"> {{ __('app.car_model')}}</p>
                            <div class="text-gray-900 text-sm leading-5 font-medium truncate">
                                {{ $car->car_model }}
                            </div>

                            <p class="mt-1 text-gray-500 text-sm leading-5 truncate"> {{ __('app.plate_number')}}</p>
                            <div class="text-gray-900 text-sm leading-5 font-medium truncate">
                                {{ $car->number_plate }}
                            </div>

                            <p class="mt-1 text-gray-500 text-sm leading-5 truncate"> {{ __('app.car_color')}}</p>
                            <div class="text-gray-900 text-sm leading-5 font-medium truncate">
                                <span class="capitalize">{{ __($car->car_color) }}</span>
                            </div>

                            <p class="mt-1 text-gray-500 text-sm leading-5 truncate"> {{ __('app.car_category')}}</p>
                            <div class="text-gray-900 text-sm leading-5 font-medium truncate">
                                <span class="capitalize">{{ __($car->car_size) }}</span>
                            </div>
                        </div>
                    </x-slot>
                    <x-slot name="actions">
                        <div class="flex flex-no-wrap h-12 px-4 justify-end items-center w-full space-x-8">
                            <x-button.link wire:click="edit({{$car->id}})">
                                {{ __('Edit') }}
                            </x-button.link>

                            <x-button.link wire:click="delete({{$car->id}})">
                                <span class="text-red-500 hover:text-red-700 hover:underline">{{ __('Delete') }}</span>
                            </x-button.link>
                        </div>
                    </x-slot>
                </x-grid.list.card>
                @empty
                <div class="bg-white shadow-sm rounded-md text-center py-6">
                    <span class="text-gray-500">{{ __('No cars saved yet') }} </span>
                </div>
                @endforelse
            </x-grid.list>
        </div>


        <div class="mt-2">
            {{ $cars->links() }}
        </div>

    </div>

    <form wire:submit.prevent="save">
        <x-jet-dialog-modal wire:model="showModal">
            <x-slot name="title">
                {{ __('New car')}}
            </x-slot>
            <x-slot name="content">
                <div class="sm:px-6 space-y-2">

                    <x-input.group for="editing.car_model" label="{{ __('app.car_model')}}">
                        <x-input.text wire:model="editing.car_model" id="car_model" type="text" placeholder="e.g. Honda Civic" required />
                    </x-input.group>

                    <x-input.group for="editing.number_plate" label="{{ __('app.plate_number')}}">
                        <x-input.text wire:model="editing.number_plate" id="number_plate" type="text" placeholder="e.g. ZH123452" required />
                    </x-input.group>

                    <x-input.group for="editing.car_color" label="{{ __('app.car_color') }}">
                        <x-input.color wire:model="editing.car_color" id="car_color" />
                    </x-input.group>
                    
                    <x-input.group for="editing.car_size" label="{{ __('app.car_category') }}">
                        <x-input.radio wire:model="editing.car_size" value="small" text="{{ __('pricespage.carcategory1type') }}" subText="{{ __('pricespage.carcategory1examples') }}" />

                        <x-input.radio wire:model="editing.car_size" value="medium" text="{{ __('pricespage.carcategory2type') }}" subText="{{ __('pricespage.carcategory2examples') }}">
                        </x-input.radio>

                        <x-input.radio wire:model="editing.car_size" value="large" text="{{ __('pricespage.carcategory3type') }}" subText="{{ __('pricespage.carcategory3examples') }}">
                        </x-input.radio>

                        <x-input.radio wire:model="editing.car_size" value="x-large" text="{{ __('pricespage.carcategory4type') }}" subText="{{ __('pricespage.carcategory4examples') }}">
                        </x-input.radio>
                    </x-input.group>     
                </div>
            </x-slot>

            <x-slot name="footer">
                <x-jet-secondary-button wire:click="$set('showModal', false)" wire:loading.attr="disabled">
                    {{ __('app.cancel')}}
                </x-jet-secondary-button>
                <x-jet-button class="ml-2" wire:loading.attr="disabled">
                    {{ __('app.save')}}
                </x-jet-button>
            </x-slot>
        </x-jet-dialog-modal>
    </form>
</div>