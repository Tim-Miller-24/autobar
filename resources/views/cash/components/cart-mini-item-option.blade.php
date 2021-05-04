<div class="mb-2">
    <div class="grid grid-cols-8">
        <div class="col-span-4">
            <div class="text-primary text-base font-bold">
                {{ $item['data']->name }}
            </div>
            @if(isset($option['data']->name))
                <div class="text-secondary text-sm -mt-0.5">{{ $option['data']->name }}</div>
            @endif
        </div>
        <div class="col-span-2 text-primary text-center font-bold text-sm pt-1">
            {{ $option['data']->price ?? $item['data']->price }}
        </div>
        <div class="col-span-2">
            <div class="flex flex-row justify-end">
                <div>
                    <button wire:click="remove({{ $item['data']->id }}, '1', {{ $option['data']->id }})"
                            class="focus:outline-none bg-red-600 text-xl text-white font-bold p-2">
                        <svg class="fill-current w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" />
                        </svg>
                    </button>
                </div>
                <div class="text-primary font-bold px-3 pt-1">
                    {{ $option['quantity'] }}
                </div>
                <div>
                    @if($option['quantity'] < $item['data']->getStockOption($option['data']->id))
                        <button wire:click="add({{ $item['data']->id }}, 1, {{ $option['data']->id }})"
                                class="focus:outline-none bg-green-600 text-xl text-white font-bold p-2">
                            <svg class="fill-current w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                        </button>
                    @else
                        <button wire:click="" class="focus:outline-none bg-green-600 text-white font-bold p-2 opacity-50 cursor-not-allowed">
                            <svg class="fill-current w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                        </button>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>