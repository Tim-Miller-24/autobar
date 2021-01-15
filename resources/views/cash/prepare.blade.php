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
    <div class="my-3">
        <div class="text-3xl font-semibold text-white leading-none">{{ trans('custom.prepare.title') }}</div>
        <div class="mt-1 text-xl font-light text-white antialiased">{{ trans('custom.prepare.text') }}</div>
    </div>
    @livewire('cash.prepare', ['order' => $order])
</x-cash::layout-client>
