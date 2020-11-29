<div>
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <div class="inline-flex  items-center justify-between w-full">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Clients') }}
                </h2>
            </div>
        </div>
    </header>

    <div class="max-w-7xl mx-auto py-4 sm:px-6 lg:px-8 ">
        <div class="hidden sm:block">
            <x-table>
                <x-slot name="head">
                    <x-table.heading sortable wire:click="sortBy('name')" :direction="$sortField == 'name' ? $sortDirection : null">{{ __('Name')}}</x-table.heading>
                    <x-table.heading sortable wire:click="sortBy('email')" :direction="$sortField == 'email' ? $sortDirection : null">{{ __('app.email')}}</x-table.heading>
                    <x-table.heading sortable wire:click="sortBy('created_at')" :direction="$sortField == 'created_at' ? $sortDirection : null">{{ __('Registered')}}</x-table.heading>
                    <x-table.heading sortable wire:click="sortBy('bookings_count')" :direction="$sortField == 'bookings_count' ? $sortDirection : null">{{ __('Bookings')}}</x-table.heading>
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
                        <x-table.cell>
                            {{ $user->bookings->count() }}
                        </x-table.cell>
                    </x-table.row>
                    @empty
                    <x-table.row>
                        <x-table.cell colspan="6" class="text-center">
                            <span class="text-gray-500">{{ __('No clients yet')}}</span>
                        </x-table.cell>
                    </x-table.row>
                    @endforelse
                </x-slot>
            </x-table>
        </div>

        <div class="block sm:hidden px-2 pb-4">
            <div class="w-full pb-2">
                <x-sort.dropdown>
                    <x-slot name="trigger">{{__('Sorted by') }} {{ __('app.'.$sortField)}}</x-slot>
                    <x-sort.item sortable wire:click="sortBy('name')" :direction="$sortField == 'name' ? $sortDirection : null">{{ __('Name')}}</x-sort.item>
                    <x-sort.item sortable wire:click="sortBy('email')" :direction="$sortField == 'email' ? $sortDirection : null">{{ __('app.email')}}</x-sort.item>
                    <x-sort.item sortable wire:click="sortBy('created_at')" :direction="$sortField == 'created_at' ? $sortDirection : null">{{ __('Registered')}}</x-sort.item>
                    <x-sort.item sortable wire:click="sortBy('bookings_count')" :direction="$sortField == 'bookings_count' ? $sortDirection : null">{{ __('Bookings')}}</x-sort.item>
                </x-sort.dropdown>
            </div>

            <x-grid.list>
                @forelse ($users as $user)
                <x-grid.list.card>
                    <x-slot name="information">
                        <div class="flex-1 truncate">
                            <p class="mt-1 text-gray-500 text-sm leading-5 truncate"> {{ __('Name')}}
                            </p>
                            <div class="text-gray-900 text-sm leading-5 font-medium truncate">
                            {{ $user->name }}
                            </div>                           

                            <p class="mt-2 text-gray-500 text-sm leading-5 truncate">{{ __('app.email')}}
                            </p>
                            <div class="text-gray-900 text-sm leading-5 font-medium truncate">
                            {{ $user->email }}
                            </div>

                            <p class="mt-2 text-gray-500 text-sm leading-5 truncate">{{ __('Registered')}}</p>
                            <div class="text-gray-900 text-sm leading-5 font-medium truncate">
                            {{ $user->created_at }}
                            </div>

                            <p class="mt-2 text-gray-500 text-sm leading-5 truncate">{{ __('Bookings')}}</p>
                            <div class="text-gray-900 text-sm leading-5 font-medium truncate">
                                <span> {{ $user->bookings->count() }}</span>
                            </div>
                      
                        </div>
                    </x-slot>
                    <x-slot name="actions">
                       
                    </x-slot>
                </x-grid.list.card>
                @empty
                <div class="bg-white shadow-sm rounded-md text-center py-6">
                    <span class="text-gray-500">{{ __('app.no_users') }} </span>
                </div>
                @endforelse
            </x-grid.list>
        </div>



        <div class="mt-2">
            {{ $users->links() }}
        </div>

    </div>
</div>