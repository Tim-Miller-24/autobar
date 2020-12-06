<x-cash::layout-manager>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ trans('custom.order_stats') }}
        </h2>
    </x-slot>
    <div class="py-8 px-8">
        <div class="grid grid-cols-1 gap-4">
            {{--@include('cash.components.stats-orders')--}}
            @include('cash.components.stats-items')
        </div>
    </div>
</x-cash::layout-manager>
