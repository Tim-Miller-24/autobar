<x-cash::layout-client>
    <x-slot name="header">
        @livewire('cash.menu-button')
        <div class="float-right">
            @livewire('cash.cart-clear')
        </div>
    </x-slot>
    @livewire('cash.checkout')
</x-cash::layout-client>
