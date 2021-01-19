<x-cash::layout-client>
    <x-slot name="header">
        <div class="font-bold text-xl uppercase text-white leading-9 py-1 inline-flex">
            {{ trans('custom.choose_category') }}
        </div>
        <div class="float-right">
            @livewire('cash.cart-mini')
        </div>
    </x-slot>
    @livewire('cash.category-list')
</x-cash::layout-client>
