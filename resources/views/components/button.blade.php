@props([
'buttonType' => 'secondary',
'colors' => [
    'primary' => 'tracking-widest px-4 py-2 text-white bg-green-800 hover:bg-green-700 active:bg-green-900 focus:border-green-900 focus:outline-none focus:shadow-outline-gray',
    'secondary' => ' tracking-widest px-4 py-2 bg-cool-gray-100 hover:bg-gray-300 active:bg-gray-500 focus:border-gray-900 focus:outline-none focus:shadow-outline-gray',
    'destructive' => ' tracking-widest px-4 py-2 text-red-700 bg-cool-gray-100 hover:bg-gray-300 active:bg-gray-500 focus:border-gray-900 focus:outline-none focus:shadow-outline-gray',
    'tertiary' => 'px-2 text-gray-500 hover:text-gray-900 active:text-black',
    'tertiaryDestructive' => 'px-2 text-red-500 hover:text-red-800 active:text-red',
    ],
])

<button
    {{ $attributes->merge(['class' => "{$colors[$buttonType]} inline-flex items-center justify-center rounded-md font-semibold text-xs uppercase  disabled:opacity-25 transition ease-in-out duration-150"]) }}>
    {{ $slot }}    
</button>
