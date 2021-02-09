<div>
    <x-header>
        <x-slot name="title">{{ __('Ratings') }}</x-slot>
        <x-slot name="actions">
            <x-div-button wire:click="create" buttonType="primary">{{ __('New')}}</x-div-button>
        </x-slot>
    </x-header>

    <div class="max-w-7xl mx-auto py-4 sm:px-6 lg:px-8">
        <div class="hidden sm:block">
            <x-table>
                <x-slot name="head">
                    <x-table.heading sortable wire:click="sortBy('display_name')" :direction="$sortField == 'display_name' ? $sortDirection : null">Visiable name</x-table.heading>
                    <x-table.heading sortable wire:click="sortBy('level')" :direction="$sortField == 'level' ? $sortDirection : null">Level</x-table.heading>
                    <x-table.heading sortable wire:click="sortBy('comment')" :direction="$sortField == 'comment' ? $sortDirection : null">Comment</x-table.heading>
                    <x-table.heading sortable wire:click="sortBy('created_at')" :direction="$sortField == 'created_at' ? $sortDirection : null">Entered</x-table.heading>
                    <x-table.heading sortable wire:click="sortBy('is_favorite')" :direction="$sortField == 'is_favorite' ? $sortDirection : null">Homepage</x-table.heading>
                    <x-table.heading> </x-table.heading>
                    <x-table.heading> </x-table.heading>
                </x-slot>
                <x-slot name="body">
                    @forelse ($ratings as $rating)
                    <x-table.row>
                        <x-table.cell>
                            {{ $rating->display_name}}
                            @isset($rating->user)
                            <p class="text-cool-gray-400">({{ $rating->user->name}})</p>
                            @endisset
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
                            <x-button.link wire:click="markAsFavorite({{ $rating->id }})">{{ __('Show') }}</x-button.link>
                            @else
                            <x-button.link wire:click="removeAsFavorite({{ $rating->id }})">{{ __('Hide') }}</x-button.link>
                            @endif
                        </x-table.cell>
                        <x-table.cell>
                            <x-button.link wire:click="edit({{ $rating->id }})"><span>{{ __('app.modify') }} <span></x-button.link>
                        </x-table.cell>
                        <x-table.cell>
                            <x-button.link wire:click="delete({{ $rating->id }})"><span class="text-red-500 underline">{{ __('Delete') }} <span></x-button.link>
                        </x-table.cell>
                    </x-table.row>
                    @empty
                    <x-table.row>
                        <x-table.cell colspan="7" class="text-center">
                            <span class="text-gray-500">{{__('No ratings yet')}}</span>
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
                    <x-sort.item sortable wire:click="sortBy('display_name')" :direction="$sortField == 'display_name' ? $sortDirection : null">{{ __('Visiable name')}}</x-sort.item>
                    <x-sort.item sortable wire:click="sortBy('level')" :direction="$sortField == 'level' ? $sortDirection : null">{{ __('Level')}}</x-sort.item>
                    <x-sort.item sortable wire:click="sortBy('comment')" :direction="$sortField == 'comment' ? $sortDirection : null">{{ __('Comment')}}</x-sort.item>
                    <x-sort.item sortable wire:click="sortBy('created_at')" :direction="$sortField == 'created_at' ? $sortDirection : null">{{ __('Entered')}}</x-sort.item>
                </x-sort.dropdown>
            </div>

            <x-grid.list>
                @forelse ($ratings as $rating)
                <x-grid.list.card>
                    <x-slot name="information">
                        <div class="flex-1 truncate">
                            <p class="mt-1 text-gray-500 text-sm leading-5 truncate"> {{ __('Visiable name')}}
                            </p>
                            <div class="text-gray-900 text-sm leading-5 font-medium truncate">
                                {{ $rating->display_name}}
                                @isset($rating->user)
                                <p class="text-cool-gray-400">({{ $rating->user->name}})</p>
                                @endisset
                            </div>

                            <p class="mt-2 text-gray-500 text-sm leading-5 truncate">{{ __('Level')}}
                            </p>
                            <div class="text-gray-900 text-sm leading-5 font-medium truncate">
                                {{ $rating->level }}
                            </div>

                            <p class="mt-2 text-gray-500 text-sm leading-5 truncate">{{ __('Comment')}}</p>
                            <div class="text-gray-900 text-sm leading-5 font-medium truncate">
                                {{ $rating->comment }}
                            </div>

                            <p class="mt-2 text-gray-500 text-sm leading-5 truncate">{{ __('Entered')}}</p>
                            <div class="text-gray-900 text-sm leading-5 font-medium truncate">
                                {{ $rating->created_at }}
                            </div>

                            <p class="mt-2 text-gray-500 text-sm leading-5 truncate">{{ __('Bookings')}}</p>
                            <div class="text-gray-900 text-sm leading-5 font-medium truncate">
                                @if($rating->is_favorite === 0)
                                <x-button.link wire:click="markAsFavorite({{ $rating->id }})">{{ __('Show') }}</x-button.link>
                                @else
                                <x-button.link wire:click="removeAsFavorite({{ $rating->id }})">{{ __('Hide') }}</x-button.link>
                                @endif
                            </div>

                        </div>
                    </x-slot>
                    <x-slot name="actions">
                    <div class="flex flex-no-wrap h-12 px-4 justify-end items-center w-full space-x-8">
                        <x-button.link wire:click="edit({{ $rating->id }})"><span>{{ __('app.modify') }} <span></x-button.link>
                        <x-button.link wire:click="delete({{ $rating->id }})"><span class="text-red-500 underline">{{ __('Delete') }} <span></x-button.link>
                    </div>
                    </x-slot>
                </x-grid.list.card>
                @empty
                <div class="bg-white shadow-sm rounded-md text-center py-6">
                    <span class="text-gray-500">{{__('No ratings yet')}} </span>
                </div>
                @endforelse
            </x-grid.list>
        </div>


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