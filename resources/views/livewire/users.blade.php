<div>
    <div>
        <div class="flex justify-end py-2">
            <x-div-button wire:click="create" buttonType="primary">{{ __('app.new')}}</x-div-button>
        </div>
        <x-table>
            <x-slot name="head">
                <x-table.heading>{{ __('app.name')}}</x-table.heading>
                <x-table.heading>{{ __('app.email')}}</x-table.heading>
                <x-table.heading>{{ __('app.added_on_date')}}</x-table.heading>                
            </x-slot>
            <x-slot name="body">
                @forelse ($users as $user)
                <x-table.row>
                    <x-table.cell>
                        {{ $user->name }}
                    </x-table.cell>
                    <x-table.cell>
                        {{ $user->email }}
                    </x-table.cell>
                    <x-table.cell>
                        {{ $user->created_at }}
                    </x-table.cell>                   
                </x-table.row>
                @empty
                <x-table.row>
                    <x-table.cell colspan="6" class="text-center">
                        <span class="text-gray-500">{{ __('app.no_users')}}</span>
                    </x-table.cell>
                </x-table.row>
                @endforelse
            </x-slot>
        </x-table>
        <div class="mt-2">
            {{ $users->links() }}
        </div>

    </div>

    <form wire:submit.prevent="save">
        <x-jet-dialog-modal wire:model="showModal">
            <x-slot name="title">
            {{ __('app.new_user')}}
            </x-slot>
            <x-slot name="content">
                <div class="px-6 space-y-2">

                    <x-input.group for="editing.name" label="{{ __('app.name')}}">
                        <x-input.text wire:model="editing.name" name="name" />
                    </x-input.group>

                    <x-input.group for="editing.email" label="{{ __('app.email')}}">
                        <x-input.text wire:model="editing.email" name="email" />
                    </x-input.group>

                    <x-input.group for="editing.password" label="{{ __('app.password')}}">
                        <x-input.text wire:model="editing.password" name="password" />
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