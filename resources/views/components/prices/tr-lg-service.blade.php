@props([
'col1Included' => true,
'col2Included' => true,
'col3Included' => true,
'name'
])
<tr>
    <th class="py-4 px-6 text-sm font-normal text-gray-500 text-left" scope="row">{{ $name }}</th>
    <td class="py-4 px-6">
        @if( $col1Included )
        <x-heroicons.green-tick />
        @else
        <x-heroicons.minus />
        @endif
    </td>
    <td class="py-4 px-6">
        @if( $col2Included )
        <x-heroicons.green-tick />
        @else
        <x-heroicons.minus />
        @endif
    </td>
    <td class="py-4 px-6">
        @if( $col3Included )
        <x-heroicons.green-tick />
        @else
        <x-heroicons.minus />
        @endif
    </td>
</tr>