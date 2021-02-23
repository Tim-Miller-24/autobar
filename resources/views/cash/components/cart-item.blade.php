<!-- component -->
@if(isset($item['options']))
    @foreach($item['options'] as $option)
        {{--{{ dd($option) }}--}}
        <div class="flex justify-center items-center">
            <div class="bg-white w-full">
                <div class="flex justify-between items-center p-2">
                    <div class="flex items-center">
                        @if($option['data']->image_url)
                            <div class="w-20 h-20 bg-contain bg-center bg-no-repeat rounded-full" style="background-image: url({{ $option['data']->image_url }})"></div>
                        @else
                            <div class="w-20 h-20 bg-contain bg-center bg-no-repeat rounded-full" style="background-image: url({{ $item['data']->image_url }})"></div>
                        @endif
                    </div>
                    <div class="text-right text-secondary">
                        <div class="text-3xl text-secondary">{{ $item['data']->name }} {{ $option['data']->name }}</div>
                        <div class="text-xl">
                            @if($option['data']->price)
                                {{ $option['data']->price }} {{ config('settings.currency') }}
                            @else
                                {{ $item['data']->price }} {{ config('settings.currency') }}
                            @endif
                        </div>
                        <div class="flex flex-row justify-end">
                            <div>
                                <button wire:click="remove({{ $item['data']->id }}, '1', {{ $option['data']->id }})"
                                        class="focus:outline-none bg-secondary text-xl text-link-main font-bold p-2">
                                    <svg class="fill-current w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" />
                                    </svg>
                                </button>
                            </div>
                            <div class="text-primary font-bold px-4 pt-2">
                                {{ trans('custom.x_quantity', ['count' => $option['quantity']]) }}
                            </div>
                            <div>
                                @if($option['quantity'] < $item['data']->getStockOption($option['data']->id))
                                    <button wire:click="add({{ $item['data']->id }}, 1, {{ $option['data']->id }})"
                                            class="focus:outline-none bg-secondary text-xl text-link-main font-bold p-2">
                                        <svg class="fill-current w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
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
        </div>
    @endforeach
@else
    <div class="flex justify-center items-center">
        <div class="bg-white w-full md:max-w-4xl shadow">
            <div class="flex justify-between items-center p-2">
                <div class="flex items-center">
                    <div class="w-20 h-20 bg-contain bg-center bg-no-repeat rounded-full" style="background-image: url({{ $item['data']->image_url }})"></div>
                </div>

                <div class="text-right text-secondary">
                    <div class="text-3xl text-secondary">{{ $item['data']->name }}</div>
                    <div class="text-xl">
                        {{ $item['data']->price }} {{ config('settings.currency') }}
                    </div>
                    <div class="flex flex-row justify-end">
                        <div>
                            <button wire:click="remove({{ $item['data']->id }}, '1')"
                                    class="focus:outline-none bg-secondary text-xl text-link-main font-bold p-2">
                                <svg class="fill-current w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" />
                                </svg>
                            </button>
                        </div>
                        <div class="text-primary font-bold px-4 pt-2">
                            {{ trans('custom.x_quantity', ['count' => $item['quantity']]) }}
                        </div>
                        <div>
                            @if($item['quantity'] < $item['data']->stock)
                                <button wire:click="add({{ $item['data']->id }}, 1)"
                                        class="focus:outline-none bg-secondary text-xl text-link-main font-bold p-2">
                                    <svg class="fill-current w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
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
    </div>
@endif


