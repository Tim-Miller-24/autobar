@if(is_array($cart_items) AND array_key_exists($item->id, $cart_items))
    <div class="float-right">
        <button wire:click="remove({{ $item->id }}, '1')" class="focus:outline-none bg-red-800 text-white text-xl text-white font-bold p-3">
            <svg class="fill-current w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" />
            </svg>
        </button>
        <span class="text-primary font-bold px-2 relative bottom-1">{{ $cart_items[$item->id]['quantity'] }}</span>
        @if($cart_items[$item->id]['quantity'] < $item->stock)
            <button wire:click="add({{ $item->id }})" class="focus:outline-none bg-green-800 text-white text-xl text-link-main font-bold p-3">
        @else
            <button wire:click="" class="focus:outline-none bg-green-800 text-white text-xl text-link-main font-bold p-2 opacity-50 cursor-not-allowed">
        @endif
            <svg class="fill-current w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
            </svg>
        </button>
    </div>
    @else
        <button wire:click="add({{ $item->id }})"
                class="focus:outline-none bg-active text-xl text-white p-2 w-full shadow-inner">
            <svg class="fill-current w-5 h-5 inline-block" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd" />
            </svg>
            <span class="text-sm inline-block uppercase">{{ trans('custom.add') }}</span>
        </button>
@endif