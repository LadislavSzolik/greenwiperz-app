<button
    {{ $attributes->merge([
        'type' => 'button',
        'class' => 'text-green-500 hover:text-green-700 active:text-green-800  font-semibold text-xs uppercase hover:underline transition duration-150 ease-in-out' . ($attributes->get('disabled') ? ' opacity-75 cursor-not-allowed' : ''),
    ]) }}
>
    {{ $slot }}
</button>
