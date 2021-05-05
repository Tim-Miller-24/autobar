<div class="mb-3">
    <div class="grid grid-cols-8">
        <div class="col-span-4">
            <div class="text-base text-primary font-bold">
                {{ $item['data']->name }}
            </div>
            <div class="text-secondary text-sm -mt-0.5">{{ $item['data']->category->name }}</div>
        </div>
        @if(!$current_sum)
            <div class="col-span-1 text-primary text-center font-bold text-sm pt-1">
                {{ $item['data']->price }}
            </div>
            <div class="col-span-3">
                <div class="flex flex-row justify-end">
                    <div>
                        <button wire:click="remove({{ $item['data']->id }}, '1')"
                                class="focus:outline-none bg-red-700 text-xl font-bold p-2 text-white">
                            <svg class="fill-current w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" />
                            </svg>
                        </button>
                    </div>
                    <div class="text-primary font-bold px-3 pt-1">
                        {{ $item['quantity'] }}
                    </div>
                    <div>
                        @if($item['quantity'] < $item['data']->stock)
                            <button wire:click="add({{ $item['data']->id }}, 1)"
                                    class="focus:outline-none bg-green-700 text-xl font-bold p-2 text-white">
                                <svg class="fill-current w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                </svg>
                            </button>
                        @else
                            <button wire:click="" class="focus:outline-none bg-green-600 text-white font-bold p-2 opacity-50 cursor-not-allowed text-white">
                                <svg class="fill-current w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                </svg>
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        @else
            <div class="col-span-4 text-primary text-right font-bold text-sm pt-1">
                {{ $item['data']->price }} x {{ $item['quantity'] }}
            </div>
        @endif
    </div>
</div>