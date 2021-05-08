<div class="bg-white w-full relative cursor-pointer border border-primary shadow-lg">
    @if($option->image_url)
        <div class="w-full h-32 bg-contain bg-bottom bg-no-repeat"
             style="background-image: url({{ $option->image_url }})">
        </div>
    @else
        <div class="w-full h-32 bg-contain bg-bottom bg-no-repeat"
             style="background-image: url({{ $item->image_url }})">
        </div>
    @endif
    <div class="px-2 py-1 text-sm text-black font-bold">{{ $option->name }}</div>
    @if($option->description)
        {{--<div class="px-2 text-xs text-gray-600">{{ $item->description }}</div>--}}
    @endif
    <div class="bg-secondary">
        <div class="grid grid-cols-12 mt-1 relative">
            <div class="col-span-4 pt-3 text-center shadow-inner">
                @if($option->price)
                    <div class="text-base text-green-400 font-bold">{{ $option->price }}</div>
                @else
                    <div class="text-base text-green-400 font-bold">{{ $item->price }}</div>
                @endif
            </div>
            <div class="col-span-8">
                @if((is_array($cart_items) AND array_key_exists($item->id, $cart_items))
                AND (isset($cart_items[$item->id]['options']) AND array_key_exists($option->id, $cart_items[$item->id]['options'])))
                    <div class="float-right">
                        <button wire:click="remove({{ $item->id }}, 1, {{ $option->id }})" class="focus:outline-none bg-red-800 text-white text-xl text-white font-bold p-3 inline-block">
                            <svg class="fill-current w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" />
                            </svg>
                        </button>
                        <div class="text-primary font-bold px-2 relative bottom-1 inline-block">
                            {{ $cart_items[$item->id]['options'][$option->id]['quantity'] }}
                        </div>
                        @if($cart_items[$item->id]['options'][$option->id]['quantity'] < $item->getStockOption($option->id))
                            <button wire:click="add({{ $item->id }}, 1, {{ $option->id }})" class="focus:outline-none bg-green-800 text-white text-xl text-link-main font-bold p-3 inline-block">
                        @else
                            <button wire:click="" class="focus:outline-none bg-green-800 text-white text-xl text-link-main font-bold p-3 opacity-50 cursor-not-allowed inline-block">
                        @endif
                                <svg class="fill-current w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                </svg>
                            </button>
                    </div>
                @else
                    <button wire:click="add({{ $item->id }}, 1, {{ $option->id }})"
                            class="focus:outline-none bg-active text-xl text-white p-2 w-full shadow-inner">
                        <svg class="fill-current w-5 h-5 inline-block" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd" />
                        </svg>
                        <span class="text-sm inline-block uppercase">{{ trans('custom.add') }}</span>
                    </button>
                @endif

            </div>
        </div>
    </div>
</div>