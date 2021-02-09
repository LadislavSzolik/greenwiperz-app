<div>
    <form wire:submit.prevent="saveCar">
        <x-jet-dialog-modal wire:model="showCarModal">
            <x-slot name="title">
                {{ __('New car')}}
            </x-slot>
            <x-slot name="content">
                <div class="sm:px-6 space-y-2">

                    <x-input.group class="col-span-6" for="newCar.car_model" label="{{ __('app.car_model')}}">
                        <x-input.text wire:model="newCar.car_model" name="newCar.car_model" type="text" placeholder="e.g. Honda Civic" required />
                    </x-input.group>

                    <x-input.group class="col-span-6 sm:col-span-3" for="newCar.number_plate" label="{{ __('app.plate_number')}}">
                        <x-input.text wire:model="newCar.number_plate" name="newCar.number_plate" type="text" placeholder="e.g. ZH123452" required />
                    </x-input.group>

                    <!-- color -->
                    <x-input.group class="col-span-6 sm:col-span-3" for="newCar.car_color" label="{{ __('app.car_color') }}">
                        <x-input.color wire:model="newCar.car_color" name="newCar.car_color" />
                    </x-input.group>


                    <!-- car size -->
                    <x-input.group class="col-span-6" for="carSize" label="{{ __('app.car_category') }}">
                        <x-input.radio wire:model="newCar.car_size" name="carSize" value="small" text="{{ __('pricespage.carcategory1type') }}" subText="{{ __('pricespage.carcategory1examples') }}" />

                        <x-input.radio wire:model="newCar.car_size" name="carSize" value="medium" text="{{ __('pricespage.carcategory2type') }}" subText="{{ __('pricespage.carcategory2examples') }}">
                        </x-input.radio>

                        <x-input.radio wire:model="newCar.car_size" name="carSize" value="large" text="{{ __('pricespage.carcategory3type') }}" subText="{{ __('pricespage.carcategory3examples') }}">
                        </x-input.radio>

                        <x-input.radio wire:model="newCar.car_size" name="carSize" value="x-large" text="{{ __('pricespage.carcategory4type') }}" subText="{{ __('pricespage.carcategory4examples') }}">
                        </x-input.radio>
                    </x-input.group>

                </div>
            </x-slot>

            <x-slot name="footer">
                <x-jet-secondary-button wire:click="$set('showCarModal', false)" wire:loading.attr="disabled">
                    {{ __('app.cancel')}}
                </x-jet-secondary-button>
                <x-jet-button class="ml-2" wire:loading.attr="disabled">
                    {{ __('app.save')}}
                </x-jet-button>
            </x-slot>
        </x-jet-dialog-modal>
    </form>
</div>