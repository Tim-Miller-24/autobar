<tr class="bg-white lg:hover:bg-gray-100 flex lg:table-row flex-row lg:flex-row flex-wrap lg:flex-no-wrap mb-10 lg:mb-0">
    <td class="w-full lg:w-auto p-3 text-gray-800 text-left border border-b block lg:table-cell relative lg:static">
        <span class="font-bold">{{ $item['name'] }}</span>
        @if($item['option'])
            {{ $item['option'] }}
        @endif
    </td>
    <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
        {{ $item['incomes'] }}
    </td>
    <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
        {{ $item['sold'] }}
    </td>
    <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
        {{ $item['stock'] }}
    </td>
    <td class="w-full lg:w-auto p-3 font-bold bg-red-500 text-white border-b text-center block lg:table-cell relative lg:static">
        {{ number_format($item['income_price']) }}
    </td>
    <td class="w-full lg:w-auto p-3 font-bold bg-red-500 text-white border-b text-center block lg:table-cell relative lg:static">
        {{ number_format($item['income_price'] * $item['sold']) }}
    </td>
    <td class="w-full lg:w-auto p-3 font-bold text-white bg-blue-500 border-b text-center block lg:table-cell relative lg:static">
        {{ number_format($item['price']) }}
    </td>
    <td class="w-full lg:w-auto p-3 font-bold text-white bg-blue-500 border-b text-center block lg:table-cell relative lg:static">
        {{ number_format($item['price'] * $item['sold']) }}
    </td>
    <td class="w-full lg:w-auto p-3 font-bold text-white bg-green-500 border-b text-center block lg:table-cell relative lg:static">
        {{ number_format($item['profit']) }}
    </td>
</tr>