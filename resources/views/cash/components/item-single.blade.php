<div class="flex justify-center items-center">
    <div class="bg-white w-full md:max-w-4xl shadow">
        <div class="flex justify-between items-center p-1">
            <div class="flex items-center">
                <div class="w-20 h-20 bg-contain bg-center bg-no-repeat rounded-full" style="background-image: url({{ $item->image_url }})"></div>
                {{--<img class="rounded-full h-15 w-15" src="{{ $item->image_url }}" alt="{{ $item->name }}" />--}}
                <div class="ml-4">
                    <div class="text-xl text-primary">{{ $item->name }}</div>
                    <div class="text-md text-black">{{ $price }}</div>
                </div>
            </div>
            <div class="inline-flex right">
                @if(count($item->activeOptions))
                    {{--@include('cash.components.option-modal', ['item' => $item])--}}
                    <div id="option_{{ $item->id }}" class="modal bg-gray-900">
                        <a href="#close-modal" rel="modal:close" class="close-modal-text-button">{{ trans('custom.close') }}</a>
                        <!-- component -->
                        <div class="grid grid-cols-1">
                            @livewire('cash.item-options', ['item' => $item])
                        </div>
                    </div>
                    <button data-modal-id="#option_{{ $item->id }}" rel="modal:open"
                            class="modal-button focus:outline-none bg-secondary text-xl text-link-main font-bold p-2 pb-1 inline-flex items-center">
                        <svg class="fill-current w-6 h-6 mr-2 mb-1.5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16" />
                        </svg>
                        {{ trans('custom.option_list') }}
                    </button>
                @else
                    @if(is_array($cart_items) AND array_key_exists($item->id, $cart_items))
                        <button wire:click="remove({{ $item->id }}, '1')" class="focus:outline-none bg-secondary text-xl text-link-main font-bold p-2">
                            <svg class="fill-current w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" />
                            </svg>
                        </button>
                        <span class="text-primary font-bold py-2 px-3">
                            {{ trans('custom.x_quantity', ['count' => $cart_items[$item->id]['quantity']]) }}
                        </span>
                        @if($cart_items[$item->id]['quantity'] < $item->stock)
                            <button wire:click="add({{ $item->id }})" class="focus:outline-none bg-secondary text-xl text-link-main font-bold p-2">
                        @else
                            <button wire:click="" class="focus:outline-none bg-secondary text-xl text-link-main font-bold p-2 opacity-50 cursor-not-allowed">
                        @endif
                            <svg class="fill-current w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                        </button>
                        {{--<button wire:click="remove({{ $item->id }})" class="focus:outline-none ml-2 bg-red-600 hover:bg-red-800 text-white font-bold py-2 px-2 shadow inline-flex items-center">--}}
                            {{--<svg class="fill-current w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">--}}
                                {{--<path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />--}}
                            {{--</svg>--}}
                        {{--</button>--}}
                        @else
                            <button wire:click="add({{ $item->id }})"
                                    class="focus:outline-none bg-secondary text-xl text-link-main font-bold p-2 pb-1 inline-flex items-center">
                                <svg class="fill-current w-6 h-6 mr-2 mb-1.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd" />
                                </svg>
                                <span class="uppercase">{{ trans('custom.add') }}</span>
                            </button>
                        @endif
                    @endif
                    @if(count($item->additions))
                        @foreach($item->additions as $addition)
                            @foreach($addition->values as $value)
                            @endforeach
                        @endforeach
                    @endif
            </div>
        </div>
    </div>
</div>