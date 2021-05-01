<div class="bg-white w-full relative p-2 rounded-sm cursor-pointer">
    <div class="w-full h-32 bg-contain bg-top bg-no-repeat"
         style="background-image: url({{ $item->image_url }})">
    </div>
    <div class="mt-1">
        <div class="grid grid-cols-8 mt-1 relative">
            <div class="col-span-6">
                <div class="text-sm text-black font-bold">{{ $item->name }}</div>
                <div class="text-xs text-green-800 font-bold">{{ $price }}</div>
            </div>
            <div class="col-span-2 absolute right-0 bottom-0">
                @if(count($item->activeOptions))
                    <div id="option_{{ $item->id }}" class="modal bg-gray-900">
                        <a href="#close-modal" rel="modal:close" class="close-modal-text-button">{{ trans('custom.close') }}</a>
                        <!-- component -->
                        <div class="grid grid-cols-1">
                            @livewire('cash.item-options', ['item' => $item])
                        </div>
                    </div>
                    <button data-modal-id="#option_{{ $item->id }}" rel="modal:open"
                            class="modal-button focus:outline-none bg-active text-xl text-white font-bold p-2 rounded-sm shadow-inner">
                        <svg class="fill-current w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16" />
                        </svg>
                        {{--{{ trans('custom.option_list') }}--}}
                    </button>
                @else
                @endif
            </div>
        </div>
    </div>
</div>