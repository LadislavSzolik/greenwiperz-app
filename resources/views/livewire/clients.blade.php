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
        <x-table>
            <x-slot name="head">
                <x-table.heading>{{ __('Name')}}</x-table.heading>
                <x-table.heading>{{ __('app.email')}}</x-table.heading>
                <x-table.heading>{{ __('Registered')}}</x-table.heading>      
                <x-table.heading>{{ __('Bookings')}}</x-table.heading>          
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
        <div class="mt-2">
            {{ $users->links() }}
        </div>

    </div>
</div>