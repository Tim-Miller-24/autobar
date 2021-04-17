<tr class="bg-white lg:hover:bg-gray-100 flex lg:table-row flex-row lg:flex-row flex-wrap lg:flex-no-wrap mb-10 lg:mb-0">
    <td class="w-full lg:w-auto p-3 text-gray-800 text-left border border-b block lg:table-cell relative lg:static">
        <span class="font-bold">{{ $sale->item->name }}</span>
        @if($sale->option)
            {{ $sale->option->name }}
        @endif
    </td>
    <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
        {{ $sale->quantity }}
    </td>
    <td class="w-full lg:w-auto p-3 font-bold text-white bg-blue-500 border-b text-center block lg:table-cell relative lg:static">
        {{ number_format($sale->price) }}
    </td>
    <td class="w-full lg:w-auto p-3 font-bold text-white bg-blue-500 border-b text-center block lg:table-cell relative lg:static">
        {{ number_format($sale->price * $sale->quantity) }}
    </td>
    <td class="w-full lg:w-auto p-3 font-bold bg-red-500 text-white border-b text-center block lg:table-cell relative lg:static">
        {{ number_format($sale->income->price) }}
    </td>
    <td class="w-full lg:w-auto p-3 font-bold bg-red-500 text-white border-b text-center block lg:table-cell relative lg:static">
        {{ number_format($sale->income->price * $sale->quantity) }}
    </td>
    <td class="w-full lg:w-auto p-3 font-bold text-white bg-green-500 border-b text-center block lg:table-cell relative lg:static">
        {{ number_format(($sale->price * $sale->quantity) - ($sale->income->price * $sale->quantity)) }}
    </td>
</tr>