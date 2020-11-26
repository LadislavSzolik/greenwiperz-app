<x-app-layout>
    <x-slot name="header">
        <div class="inline-flex  items-center justify-between w-full">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Ratings ') }}
            </h2>

        </div>
    </x-slot>
    <div class="max-w-5xl mx-auto py-4 sm:px-6 lg:px-8  hidden sm:block">
        <x-table>
            <x-slot name="head">
                <x-table.heading>User/Name</x-table.heading>
                <x-table.heading>Level</x-table.heading>
                <x-table.heading>Comment</x-table.heading>  
                <x-table.heading>Entered</x-table.heading>    
                <x-table.heading> </x-table.heading>             
            </x-slot>
            <x-slot name="body">
                @forelse ($ratings as $rating)
                <x-table.row>
                    <x-table.cell>
                        {{ $rating->name_for_public }}
                    </x-table.cell>
                    <x-table.cell>
                        {{ $rating->level }}
                    </x-table.cell>
                    <x-table.cell>
                        {{ $rating->comment }}
                    </x-table.cell>
                    <x-table.cell>
                        {{ $rating->created_at }}
                    </x-table.cell>        
                    <x-table.cell>
                        TODO: Mark as favorite
                    </x-table.cell>                         
                </x-table.row>
                @empty
                <x-table.row>
                    <x-table.cell colspan="4" class="text-center">
                        <span class="text-gray-500">No ratings yet</span>
                    </x-table.cell>
                </x-table.row>
                @endforelse
            </x-slot>

        </x-table>
        <div class="mt-2">
            {{ $ratings->links() }}
        </div>
    </div>
    <x-footer />
</x-app-layout>