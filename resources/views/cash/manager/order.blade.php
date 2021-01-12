<x-cash::layout-manager>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ trans('custom.order_detail') }}
        </h2>
    </x-slot>
    <table class="table-auto w-full text-left border-collapse border border-white">
        <thead>
        <tr>
            <th class="px-4 py-3 title-font font-medium text-gray-900 text-sm bg-white">Товар</th>
            <th class="px-4 py-3 title-font font-medium text-gray-900 text-sm bg-white">Количество</th>
            <th class="px-4 py-3 title-font font-medium text-gray-900 text-sm bg-white">Цена продажи</th>
            <th class="px-4 py-3 title-font font-medium text-gray-900 text-sm bg-white">Себестоимость</th>
            <th class="w-10 title-font font-medium text-gray-900 text-sm bg-white">Итого</th>
        </tr>
        </thead>
        <tbody>
        @foreach($order->items as $item)
            @include('cash.manager.partial.order-item', ['item' => $item])
        @endforeach
        </tbody>
    </table>
</x-cash::layout-manager>
