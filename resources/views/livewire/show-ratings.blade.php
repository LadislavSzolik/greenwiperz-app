<div>
    <x-header>
        <x-slot name="title">{{ __('Ratings') }}</x-slot>
        <x-slot name="actions">
            <x-div-button wire:click="create" buttonType="primary">{{ __('New')}}</x-div-button>
        </x-slot>
    </x-header>

    <div class="max-w-7xl mx-auto py-4 sm:px-6 lg:px-8">
        <x-table>
            <x-slot name="head">
                <x-table.heading>User/Name</x-table.heading>
                <x-table.heading>Level</x-table.heading>
                <x-table.heading>Comment</x-table.heading>
                <x-table.heading>Entered</x-table.heading>
                <x-table.heading>Homepage</x-table.heading>
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
                        @if($rating->is_favorite === 0)
                        <x-button.link wire:click="markAsFavorite({{ $rating->id }})" >{{ __('Show') }}</x-button.link> 
                        @else
                        <x-button.link wire:click="removeAsFavorite({{ $rating->id }})" >{{ __('Hide') }}</x-button.link> 
                        @endif
                    </x-table.cell>
                    <x-table.cell>                        
                        <x-button.link wire:click="delete({{ $rating->id }})" ><span class="text-red-500" >{{ __('Delete') }} <span></x-button.link> 
                    </x-table.cell>
                </x-table.row>
                @empty
                <x-table.row>
                    <x-table.cell colspan="6" class="text-center">
                        <span class="text-gray-500">{{__('No ratings yet')}}</span>
                    </x-table.cell>
                </x-table.row>
                @endforelse
            </x-slot>

        </x-table>
        <div class="mt-2">
            {{ $ratings->links() }}
        </div>
    </div>

    <form wire:submit.prevent="save">
        <x-jet-dialog-modal wire:model="showModal">
            <x-slot name="title">
                {{ __('New Rating')}}
            </x-slot>
            <x-slot name="content">
                <div class="px-6 space-y-2">

                    <x-input.group for="editing.display_name" label="{{ __('Name')}}">
                        <x-input.text wire:model="editing.display_name" name="name" />
                    </x-input.group>

                    <x-input.group for="editing.level" label="{{ __('Level')}}">
                        <select class="rounded-none rounded-r-md flex-1 form-input block w-full" name="level" wire:model="editing.level">
                            <option value="" selected>-</option>
                            @foreach(App\Models\Rating::LEVELS as $level)
                            <option value="{{$loop->index }}">{{$level}}</option>
                            @endforeach
                        </select>
                    </x-input.group>

                    <x-input.group for="editing.comment" label="{{ __('Comment')}}">
                        <textarea wire:model="editing.comment" name="comment" class="mt-1 block w-full form-input" rows="4" cols="50"></textarea>
                    </x-input.group>
                </div>
            </x-slot>

            <x-slot name="footer">
                <x-jet-secondary-button wire:click="$set('showModal', false)" wire:loading.attr="disabled">
                    {{ __('Cancel')}}
                </x-jet-secondary-button>
                <x-jet-button class="ml-2" wire:loading.attr="disabled">
                    {{ __('Save')}}
                </x-jet-button>
            </x-slot>
        </x-jet-dialog-modal>
    </form>


</div>