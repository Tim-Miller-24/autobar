@if(is_array($cart_items) AND array_key_exists($item->id, $cart_items))
    <button wire:click="remove({{ $item->id }}, '1')" class="focus:outline-none bg-active text-xl text-white font-bold p-2 rounded-sm shadow-inner">
        <svg class="fill-current w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" />
        </svg>
    </button>
    <span class="text-primary font-bold py-2 px-3">{{ $cart_items[$item->id]['quantity'] }}</span>
    @if($cart_items[$item->id]['quantity'] < $item->stock)
        <button wire:click="add({{ $item->id }})" class="focus:outline-none bg-secondary text-xl text-link-main font-bold p-2">
    @else
        <button wire:click="" class="focus:outline-none bg-active text-xl text-white font-bold p-2 rounded-sm shadow-inner opacity-50 cursor-not-allowed">
    @endif
        <svg class="fill-current w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
            </svg>
        </button>
    @else
        <button wire:click="add({{ $item->id }})"
                class="focus:outline-none bg-active text-xl text-white font-bold p-2 rounded-sm shadow-inner">
            <svg class="fill-current w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd" />
            </svg>
        </button>
@endif