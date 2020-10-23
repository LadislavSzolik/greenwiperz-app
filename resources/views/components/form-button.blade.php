@props([
    'method' => 'POST',
    'buttonType' => 'secondary',
    'action' => ''
])
<div class="inline-flex">
    <form method="{{ $method === 'GET' ? 'GET' : 'POST' }}" action=" {{ $action }} ">
        @csrf
        
        @if (! in_array($method, ['GET', 'POST']))
            @method($method)
        @endif
        
        <x-button type="submit" buttonType="{{ $buttonType }}" {{ $attributes }}  >
            {{ $slot }}
        </x-button>
    </form>
</div>