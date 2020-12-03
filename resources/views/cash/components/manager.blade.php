<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ trans('custom.order_list') }}
    </h2>
</x-slot>
@foreach($orders as $order)
    <div class="py-8 px-8">
        <div class="grid grid-cols-2 gap-4">
            @include('cash.components.manager-summary')
            @include('cash.components.manager-control')
        </div>
    </div>
@endforeach
