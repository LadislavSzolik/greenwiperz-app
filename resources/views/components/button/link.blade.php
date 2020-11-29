<button
    {{ $attributes->merge([
        'type' => 'button',
        'class' => 'text-gray-500 hover:text-gray-900 active:text-black underline font-semibold text-xs uppercase focus:underline transition duration-150 ease-in-out' . ($attributes->get('disabled') ? ' opacity-75 cursor-not-allowed' : ''),
    ]) }}
>
    {{ $slot }}
</button>
