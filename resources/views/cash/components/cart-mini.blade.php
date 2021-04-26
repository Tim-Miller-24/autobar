<div class="p-3">
    @if($total_price)
        @if($items)
            @foreach($items as $item)
                @if(isset($item['options']))
                    @foreach($item['options'] as $option)
                        <div class="bg-primary border-primary p-1 rounded-sm shadow mb-2">
                            <div class="grid grid-cols-8">
                                <div class="col-span-5">
                                    <div class="text-sm text-primary">
                                        {{ $item['data']->name }}
                                    </div>
                                    @if(isset($option['data']->name))
                                        <div class="text-secondary text-xs -mt-0.5">{{ $option['data']->name }}</div>
                                    @endif
                                </div>
                                <div class="col-span-3">
                                    <div class="flex flex-row justify-end">
                                        <div>
                                            <button wire:click="remove({{ $item['data']->id }}, '1', {{ $option['data']->id }})"
                                                    class="focus:outline-none bg-red-600 text-xl text-white font-bold p-2">
                                                <svg class="fill-current w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" />
                                                </svg>
                                            </button>
                                        </div>
                                        <div class="text-primary font-bold p-2">
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
                                                <button wire:click="" class="focus:outline-none bg-blue-500 text-white font-bold py-2 px-4 opacity-50 cursor-not-allowed">
                                                    <svg class="fill-current w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                                    </svg>
                                                </button>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="bg-primary border-primary p-1 rounded-sm shadow mb-2">
                        <div class="grid grid-cols-8">
                            <div class="col-span-5">
                                <div class="text-sm text-primary">
                                    {{ $item['data']->name }}
                                </div>
                            </div>
                            <div class="col-span-3">
                                <div class="flex flex-row justify-end">
                                    <div>
                                        <button wire:click="remove({{ $item['data']->id }}, '1')"
                                                class="focus:outline-none bg-red-700 text-xl text-link-main font-bold p-2">
                                            <svg class="fill-current w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" />
                                            </svg>
                                        </button>
                                    </div>
                                    <div class="text-primary font-bold px-4 pt-2">
                                        {{ $item['quantity'] }}
                                    </div>
                                    <div>
                                        @if($item['quantity'] < $item['data']->stock)
                                            <button wire:click="add({{ $item['data']->id }}, 1)"
                                                    class="focus:outline-none bg-green-700 text-xl text-link-main font-bold p-2">
                                                <svg class="fill-current w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                                </svg>
                                            </button>
                                        @else
                                            <button wire:click="" class="focus:outline-none bg-green-500 text-white font-bold py-2 px-4 opacity-50 cursor-not-allowed">
                                                <svg class="fill-current w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                                </svg>
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        @endif
        <div class="mr-2">
            <button onclick="location.href='{{ route('cart.show') }}'"
                    class="focus:outline-none bg-secondary text-link-main items-center py-3.5 px-6 text-3xl relative">
                <div class="absolute px-2 py-1 text-white bg-red-600 top-0 right-0 text-sm">
                    {{ $items_count }}
                </div>
                <svg class="w-9 h-9" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z"/>
                </svg>
            </button>
        </div>
        <div>
            <button onclick="location.href='{{ route('cart.checkout') }}'"
                    class="focus:outline-none bg-link-main text-secondary items-center pt-4 pb-3 px-4 text-3xl">
                {{ trans('custom.pay_sum', ['sum' => $total_price]) }}
                {{ config('settings.currency') }}
            </button>
        </div>
    @else
        <div class="text-center text-secondary m-auto w-48 my-10">
            {{ trans('custom.cart_empty') }}
        </div>
    @endif
</div>
