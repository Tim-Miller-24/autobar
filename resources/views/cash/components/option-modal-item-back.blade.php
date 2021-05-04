<div class="flex justify-center items-center m-2">
    <div class="bg-white w-full md:max-w-4xl shadow">
        <div class="flex justify-between items-center p-2">
            <div class="flex items-center">
                @if($option->image_url)
                    <div class="w-16 h-16 bg-contain bg-center bg-no-repeat rounded-full" style="background-image: url({{ $option->image_url }}"></div>
                @else
                    <div class="w-16 h-16 bg-contain bg-center bg-no-repeat rounded-full" style="background-image: url({{ $item->image_url }}"></div>
                @endif
                <div class="ml-2">
                    <div class="text-xl text-primary">{{ $option->name }}</div>
                    <div class="text-md text-black">
                        @if($option->price)
                            {{ $option->price }} {{ config('settings.currency') }}
                        @else
                            {{ $item->price }} {{ config('settings.currency') }}
                        @endif
                    </div>
                </div>
            </div>
            <div class="inline-flex right">
                @if((is_array($cart_items) AND array_key_exists($item->id, $cart_items))
                AND (isset($cart_items[$item->id]['options']) AND array_key_exists($option->id, $cart_items[$item->id]['options'])))
                    <button wire:click="remove({{ $item->id }}, 1, {{ $option->id }})"
                            class="focus:outline-none bg-secondary text-xl text-link-main font-bold p-2">
                        <svg class="fill-current w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" />
                        </svg>
                    </button>
                    <span class="text-primary font-bold py-2 px-3">
                        {{ trans('custom.x_quantity', ['count' => $cart_items[$item->id]['options'][$option->id]['quantity']]) }}
                    </span>
                    @if($cart_items[$item->id]['options'][$option->id]['quantity'] < $item->getStockOption($option->id))
                        <button wire:click="add({{ $item->id }}, 1, {{ $option->id }})"
                                class="focus:outline-none bg-secondary text-xl text-link-main font-bold p-2">
                    @else
                        <button wire:click="" class="focus:outline-none bg-secondary text-xl text-link-main font-bold p-2 opacity-50 cursor-not-allowed">
                    @endif
                        <svg class="fill-current w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                        </button>
                        {{--<button wire:click="remove({{ $item->id }}, 0, {{ $option->id }})" class="focus:outline-none ml-2 bg-red-600 hover:bg-red-800 text-white font-bold py-2 px-2 shadow inline-flex items-center">--}}
                            {{--<svg class="fill-current w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">--}}
                                {{--<path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />--}}
                            {{--</svg>--}}
                        {{--</button>--}}
                    @else
                        <button wire:click="add({{ $item->id }}, 1, {{ $option->id }})"
                                class="focus:outline-none bg-secondary text-xl text-link-main font-bold p-2 pb-1 inline-flex items-center">
                            <svg class="fill-current w-6 h-6 mr-2 mb-1.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd" />
                            </svg>
                            <span class="uppercase">{{ trans('custom.add') }}</span>
                        </button>
                    @endif
            </div>
        </div>
    </div>
</div>