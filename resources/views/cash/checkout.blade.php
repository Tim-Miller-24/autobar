<x-cash::layout-client>
    <x-slot name="header">
        @livewire('cash.menu-button')
    </x-slot>
    <div class="flex flex-row my-4">
        <div class="text-7xl uppercase text-primary">
            {{ trans('custom.order_pay') }}
        </div>
        <div class="ml-4">
            @livewire('cash.cart-clear', ['text' => 'custom.cancel_order'])
        </div>
    </div>
    @livewire('cash.checkout')
</x-cash::layout-client>
