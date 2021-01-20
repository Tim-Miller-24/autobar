<tr>
    <td class="px-4 py-3 border border-white">
        {{ $item->item->name }}
        @if($item->option)
            {{ $item->option->name }}
        @endif
    </td>
    <td class="px-4 py-3 border border-white">{{ $item->quantity }}</td>
    <td class="px-4 py-3 border border-white">{{ $item->price }}</td>
    <td class="px-4 py-3 border border-white">
        @if($item->option)
            {{ $item->option->incomes->avg('price') }}
        @else
            {{ $item->item->incomes->avg('price') }}
        @endif
    </td>
    <td class="px-4 py-3 border border-white">{{ $item->price * $item->quantity }}</td>
    <td class="px-4 py-3 border border-white">
        {{ $item->profit }}
    </td>
    {{--<td class="px-4 py-3 border border-white">--}}
        {{--<a href="{{ route('manager.order.show', ['id' => $order->id]) }}" class="p-2 bg-blue-600 hover:bg-blue-400 text-white rounder">--}}
            {{--Детали--}}
        {{--</a>--}}
    {{--</td>--}}
</tr>