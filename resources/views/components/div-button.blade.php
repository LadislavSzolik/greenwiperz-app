@props([
'buttonType' => 'secondary',
'colors' => [
    'primary' => 'text-white bg-green-500 hover:bg-green-400 active:bg-green-800 focus:border-green-800',
    'secondary' => 'bg-cool-gray-100 hover:bg-gray-300 active:bg-gray-500 focus:border-gray-900',
    'destructive' => 'text-white bg-red-600 hover:bg-red-500 active:bg-red-500 focus:border-red-900',
    'tertiary' => 'px-2 text-gray-500 hover:text-gray-900 active:text-black underline',
    'tertiaryDestructive' => 'px-2 text-red-500 hover:text-red-800 active:text-red underline',
    ],
])

<div
    {{ $attributes->merge(['class' => "{$colors[$buttonType]} cursor-pointer inline-flex items-center justify-center px-4 py-2 rounded-md font-semibold text-xs uppercase tracking-widest  focus:outline-none  focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150"]) }}>
    {{ $slot }}    
</div>
