<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <a href="{{ route('home') }}">
                <x-application-logo class="h-32 "/>
            </a>
        </x-slot>

        <form method="POST" action="{{ route('waitingvisitors.store') }}">
            @csrf
            <div class="my-4 text-center text-gray-600">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <h1 class="text-2xl uppercase font-bold mb-4 ">Work in progress</h1>
                The Greenwiperz are preparing for the eco friendly cleaning. We are not ready yet, do you want to ge notified once our services are becoming available online? Sign up to get notified. 
            </div>


            @if (session()->has('status'))
                <div class="text-green-500">
                    {{ session('status') }}
                </div>
                <div class="flex items-center mt-6">
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('home') }}">{{ __('Back to home') }}</a>
                </div> 
            @else
            <div>
                <x-jet-label for="name" value="{{ __('Name (Optional)') }}"/>
                <x-jet-input id="name" class="block mt-1 w-full" type="name" name="name" :value="old('name')" autofocus/>

                <x-jet-label for="email" value="{{ __('Email') }}"/>
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>            
            <div class="flex justify-between">
                <div class="flex items-center mt-6">
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('home') }}">{{ __('Back to home') }}</a>
                </div>                
                <div class="flex items-center justify-end mt-6">    
                    <x-jet-button class="ml-4">
                        {{ __('Notify me') }}
                    </x-jet-button>
                </div>
            </div>
            @endif
        </form>
    </x-jet-authentication-card>
</x-guest-layout>