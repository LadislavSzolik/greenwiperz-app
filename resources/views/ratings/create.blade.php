<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <a href="{{ route('home') }}">
                <x-application-logo class="h-32 " />
            </a>
        </x-slot>

        @if (session()->has('status'))
        <div class="text-center py-4 px-8">
            <div class="text-green-600 text-2xl uppercase font-bold">
                Thank you for you feedback!
            </div>
            <div class="flex justify-center items-center mt-6">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('home') }}">{{ __('To Greenwiperz') }}</a>
            </div>
        </div>
        @else
        <form method="POST" action="{{ route('ratings.store') }}">
            @csrf
            <div class="my-4 text-center text-gray-600">
                <h1 class="text-2xl uppercase font-bold mb-4 ">Rate our services</h1>
                <p class="text-left">
                    We are constantly making our services better, your experience and opinion matter to us!
                </p>
            </div>
            <div>
                <input hidden name="user" value="{{$user}}" />
                <x-jet-label for="level" value="How happy are you with us?" />
                <x-jet-input-error for="level" />
                <x-input.radio name="level" value="0" text="I did not like it." />
                <x-input.radio name="level" value="1" text="A lot to improve" />
                <x-input.radio name="level" value="2" text="More less ok." />
                <x-input.radio name="level" value="3" text="It is fine" />
                <x-input.radio name="level" value="4" text="You're awesome" />

                <div class="mt-4">
                    <x-jet-label for="comment" value="{{ __('Comment (optional)') }}" />
                    <textarea name="comment" class="mt-1 block w-full form-input" rows="4" cols="50"></textarea>
                </div>
            </div>

            <div class="flex items-center justify-end mt-6">
                <x-jet-button class="ml-4">
                    {{ __('Send') }}
                </x-jet-button>
            </div>
        </form>
        @endif
    </x-jet-authentication-card>
</x-guest-layout>