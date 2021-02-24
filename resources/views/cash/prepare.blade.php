<x-cash::layout-client>
    <x-slot name="header">
        {{--<h2 class="font-semibold text-xl text-white leading-tight">--}}
            {{--{{ trans('custom.order_status') }}--}}
            {{--@if($order->status == \App\Cashbox\Models\Order::STATUS_PENDING)--}}
                {{--<span class="bg-red-600 text-white font-bold px-2 py-1 shadow inline-flex items-center">--}}
                {{--{{ trans('custom.status_'.$order->status) }}--}}
            {{--</span>--}}
            {{--@endif--}}
            {{--@if($order->status == \App\Cashbox\Models\Order::STATUS_FINISH)--}}
                {{--<span class="bg-blue-600 text-white font-bold px-2 py-1 shadow inline-flex items-center">--}}
                {{--{{ trans('custom.status_'.$order->status) }}--}}
            {{--</span>--}}
            {{--@endif--}}
        {{--</h2>--}}
    </x-slot>
    <div class="font-bold text-3xl uppercase text-primary pb-2 pt-4 inline-flex border-b-8 border-border">
        {{ trans('custom.prepare.title') }}
    </div>
    @livewire('cash.prepare', ['order' => $order])
</x-cash::layout-client>
