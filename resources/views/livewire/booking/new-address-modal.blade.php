<div>    
    <form wire:submit.prevent="saveAddress">
        <x-jet-dialog-modal wire:model="showAddressModal">
            <x-slot name="title">
                {{ __('New Address')}}
            </x-slot>
            <x-slot name="content">
                <div class="sm:px-6 space-y-2">

                    <x-input.group class="col-span-6 sm:col-span-3" for="billFirstName" label="{{ __('app.first_name') }}">
                        <x-input.text wire:model="newAddress.first_name" name="billFirstName" type="text" placeholder="e.g. Andrea" required />
                    </x-input.group>                    

                    <x-input.group class="col-span-6 sm:col-span-3" for="billLastName" label="{{ __('app.last_name') }}">
                        <x-input.text wire:model="newAddress.last_name" name="billLastName" type="text" placeholder="e.g. Muster" required />
                    </x-input.group>

                    @if($isCompany === 1)
                    <x-input.group class="col-span-6 sm:col-span-3" for="billCompanyName" label="{{ __('app.company_name') }}">
                        <x-input.text wire:model="newAddress.company_name" name="billCompanyName" type="text" placeholder="e.g. SBB" required />
                    </x-input.group>
                    @endif
                    

                    <x-input.group class="col-span-6 sm:col-span-3" for="billStreet" label="{{ __('app.street') }}">
                        <x-input.text wire:model="newAddress.street" name="billStreet" type="text" placeholder="e.g. Hauptstrasse 12" required />
                    </x-input.group>

                    <x-input.group class="col-span-6 sm:col-span-3" for="billPostalCode" label="{{ __('app.postal_code') }}">
                        <x-input.text wire:model="newAddress.postal_code" name="billPostalCode" type="text" placeholder="e.g. 8046" required />
                    </x-input.group>

                    <x-input.group class="col-span-6 sm:col-span-3" for="billCity" label="{{ __('app.city') }}">
                        <x-input.text wire:model="newAddress.city" name="billCity" type="text" placeholder="e.g. Zurich" required />
                    </x-input.group>

                    <x-input.group class="col-span-6 sm:col-span-3" for="billCountry" label="{{ __('app.country') }}">
                        <x-input.text wire:model="newAddress.country" name="billCountry" type="text" placeholder="Schweiz" />
                    </x-input.group>
                </div>
            </x-slot>
            <x-slot name="footer">
                <x-jet-secondary-button wire:click="$set('showAddressModal', false)" wire:loading.attr="disabled">
                    {{ __('app.cancel')}}
                </x-jet-secondary-button>
                <x-jet-button class="ml-2" wire:loading.attr="disabled">
                    {{ __('app.save')}}
                </x-jet-button>
            </x-slot>
        </x-jet-dialog-modal>
    </form>
</div>