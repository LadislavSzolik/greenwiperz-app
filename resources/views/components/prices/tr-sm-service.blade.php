@props([
'included' => true,
'name'
])
<tr>
    <th class="py-4 px-6 text-sm font-normal text-gray-500 text-left" scope="row">{{ $name }}</th>
    <td class="py-4 px-6">
        @if( $included )
        <x-heroicons.green-tick />
        @else
        <x-heroicons.minus />
        @endif
    </td>
</tr>