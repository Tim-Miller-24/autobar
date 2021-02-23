<x-cash::layout-client>
    <x-slot name="header">
        @livewire('cash.menu-button')
        <div class="float-right">
            @livewire('cash.cart-mini')
        </div>
    </x-slot>
    <div class="flex flex-row my-4">
        <div class="text-7xl uppercase text-primary">
            {{ trans('custom.shopping_cart') }}
        </div>
        <div class="ml-4">
            @livewire('cash.cart-clear')
        </div>
    </div>
    @livewire('cash.cart')
</x-cash::layout-client>
