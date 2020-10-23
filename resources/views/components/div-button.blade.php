@props([
'buttonType' => 'secondary',
'colors' => [
    'primary' => 'text-white bg-green-800 hover:bg-green-700 active:bg-green-900 focus:border-green-900',
    'secondary' => 'bg-cool-gray-100 hover:bg-gray-300 active:bg-gray-500 focus:border-gray-900',
    'destructive' => 'text-red-700 bg-cool-gray-100 hover:bg-gray-300 active:bg-gray-500 focus:border-gray-900',
    ],
])

<div
    {{ $attributes->merge(['class' => "{$colors[$buttonType]} inline-flex items-center justify-center px-4 py-2 rounded-md font-semibold text-xs uppercase tracking-widest  focus:outline-none  focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150"]) }}>
    {{ $slot }}    
</div>
