<x-cash::layout-client>
    <x-slot name="header">
        <span class="font-bold text-xl uppercase text-white leading-9">
            {{ trans('custom.choose_category') }}
        </span>
        <div class="float-right">
            @livewire('cash.cart-mini')
        </div>
    </x-slot>
    @livewire('cash.category-list')
</x-cash::layout-client>
