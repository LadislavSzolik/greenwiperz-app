<div class="mt-10">
    <style type="text/css">
        .animation-gallery{
            animation: gallery 70s linear infinite;
        } 

        @keyframes gallery {
            0% {
                transform: translateX(0%);                
            }
            100% {
                transform: translateX(-100%);               
            }
        }
    </style>
    <div class="mb-8 max-w-2xl mx-auto text-center">
        <h2 class="text-4xl tracking-tight leading-10 font-extrabold text-gray-800 sm:text-5xl sm:leading-none text-center">
            {{ __('Our work') }}
        </h2>
    </div>
    <div x-data="{show:false}" x-on:load.window="show=true" x-show.transition="show" class="flex flex-row flex-no-wrap space-x-6 w-full overflow-x-auto sm:overflow-hidden">
        <div class="flex flex-no-wrap space-x-6 animation-gallery">            
            <img class="rounded-2xl max-w-none"  src="{{ asset('img/ourwork/ba-1.png') }}">            
            <img class="rounded-2xl max-w-none" src="{{ asset('img/ourwork/ba-2.png') }}">
            <img class="rounded-2xl max-w-none" src="{{ asset('img/ourwork/ba-3.png') }}">
            <img class="rounded-2xl max-w-none" src="{{ asset('img/ourwork/ba-4.png') }}">
            <img class="rounded-2xl max-w-none" src="{{ asset('img/ourwork/ba-5.png') }}">
            <img class="rounded-2xl max-w-none" src="{{ asset('img/ourwork/ba-6.png') }}">
        </div>
        <div class="flex flex-no-wrap space-x-6 animation-gallery">            
            <img class="rounded-2xl max-w-none"  src="{{ asset('img/ourwork/ba-1.png') }}">            
            <img class="rounded-2xl max-w-none" src="{{ asset('img/ourwork/ba-2.png') }}">
            <img class="rounded-2xl max-w-none" src="{{ asset('img/ourwork/ba-3.png') }}">
            <img class="rounded-2xl max-w-none" src="{{ asset('img/ourwork/ba-4.png') }}">
            <img class="rounded-2xl max-w-none" src="{{ asset('img/ourwork/ba-5.png') }}">
            <img class="rounded-2xl max-w-none" src="{{ asset('img/ourwork/ba-6.png') }}">
        </div>
    </div>
</div>