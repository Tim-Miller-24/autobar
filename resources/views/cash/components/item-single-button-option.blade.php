<div id="option_{{ $item->id }}" class="modal bg-secondary">
    <a href="#close-modal" rel="modal:close" class="close-modal-text-button">{{ trans('custom.close') }}</a>
    <!-- component -->
    <div class="grid grid-cols-1">
        @livewire('cash.item-options', ['item' => $item])
    </div>
</div>
<button data-modal-id="#option_{{ $item->id }}" rel="modal:open"
        class="modal-button focus:outline-none bg-active text-xl text-white font-bold p-2 w-full">
    <svg class="fill-current w-4 h-4 inline-block" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16" />
    </svg>
    <span class="text-sm inline-block uppercase">{{ trans('custom.option_list') }}</span>
</button>