<x-cash::layout-client>
    <x-slot name="header">
        <span class="font-semibold text-xl text-gray-800 leading-9">
            {{ trans('custom.choose_category') }}
        </span>
        <div class="float-right">
            @livewire('cash.cart-mini')
        </div>
    </x-slot>
    @livewire('cash.category-list')
</x-cash::layout-client>
