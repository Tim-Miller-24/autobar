<x-cash::layout-client>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ trans('custom.order_status') }}
            @if($order->status == \App\Cashbox\Models\Order::STATUS_PENDING)
                <span class="bg-red-600 text-white font-bold px-2 py-1 rounded inline-flex items-center">
                {{ trans('custom.status_'.$order->status) }}
            </span>
            @endif
            @if($order->status == \App\Cashbox\Models\Order::STATUS_FINISH)
                <span class="bg-blue-600 text-white font-bold px-2 py-1 rounded inline-flex items-center">
                {{ trans('custom.status_'.$order->status) }}
            </span>
            @endif
        </h2>
    </x-slot>
    @livewire('cash.prepare', ['order' => $order])
</x-cash::layout-client>
