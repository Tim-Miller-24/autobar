<x-cash::layout-manager>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ trans('custom.orders') }}
        </h2>
    </x-slot>
    <table class="table-auto w-full text-left border-collapse border border-white">
        <thead>
        <tr>
            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-white">Сумма</th>
            {{--<th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-white">Доход</th>--}}
            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-white">Дата заказа</th>
            <th class="w-10 title-font tracking-wider font-medium text-gray-900 text-sm bg-white"></th>
        </tr>
        </thead>
        <tbody>
        @foreach($orders as $order)
            <tr>
                <td class="px-4 py-3 border border-white">{{ $order->paid }}</td>
                <td class="px-4 py-3 border border-white">{{ $order->created_at }}</td>
                <td class="px-4 py-3 border border-white">
                    <a href="{{ route('manager.order.show', ['id' => $order->id]) }}" class="p-2 bg-blue-600 hover:bg-blue-400 text-white rounder">
                        Детали
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $orders->links() }}
</x-cash::layout-manager>
