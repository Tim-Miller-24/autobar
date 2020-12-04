<x-cash::layout-client>
    <x-slot name="header">
        <a href="{{ route('cash.show') }}" class="bg-blue-600 hover:bg-blue-800 text-white font-bold py-2 px-4 rounded inline-flex items-center">
            <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M7.707 3.293a1 1 0 010 1.414L5.414 7H11a7 7 0 017 7v2a1 1 0 11-2 0v-2a5 5 0 00-5-5H5.414l2.293 2.293a1 1 0 11-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
            </svg>
            <span>{{ trans('custom.back_to_menu') }}</span>
        </a>
        <div class="float-right">
            @livewire('cash.cart-mini')
        </div>
    </x-slot>
    @livewire('cash.item-list', ['id' => $id])
</x-cash::layout-client>
