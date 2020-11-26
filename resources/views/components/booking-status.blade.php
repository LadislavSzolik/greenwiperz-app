@props([
'status' => ' ',
])

@switch($status)
@case('pending')
<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium leading-4 bg-yellow-100 text-yellow-800">
    {{ __('app.pending')}}
</span>
@break
@case('paid')
<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium leading-4 bg-green-50 text-green-800">
{{ __('app.paid')}}
</span>
@break

@case('canceled')
<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium leading-4 bg-gray-100 text-gray-800">
{{ __('app.canceled')}}
</span>
@break

@case('completed')
<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium leading-4 bg-green-100 text-green-800">
{{ __('app.completed')}}
</span>
@break

@default
<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium leading-4 bg-yellow-100 text-yellow-800">
{{ __('app.draft')}}
</span>
@endswitch