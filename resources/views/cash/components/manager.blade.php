<x-slot name="header">
    <div class="float-left font-semibold text-xl text-gray-800 leading-9">
        {{ trans('custom.order_list') }}
    </div>
    <div class="float-right">
        @livewire('cash.maintenance')
    </div>
</x-slot>
@foreach($orders as $order)
    @include('cash.components.manager-summary')
@endforeach