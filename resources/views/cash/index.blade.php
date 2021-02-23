<x-cash::layout-client>
    <x-slot name="header">
        <div class="font-bold text-3xl uppercase text-primary pb-2 pt-4 inline-flex border-b-8 border-border">
            {{ trans('custom.choose_category') }}
        </div>
        <div class="float-right">
            @livewire('cash.cart-mini')
        </div>
    </x-slot>
    @livewire('cash.category-list')
</x-cash::layout-client>
