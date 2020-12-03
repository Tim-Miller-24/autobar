<!-- component -->
<div class="flex justify-center items-center">
    <div class="bg-white w-full md:max-w-4xl rounded-lg shadow">
        <div class="flex justify-between items-center p-2">
            <div class="flex items-center">
                <img class="rounded-full h-12 w-12" src="
{{ $item->image_url }}" alt="{{ $item->name }}" />
                <div class="ml-2">
                    <div class="text-sm font-bold text-gray-600">{{ $item->name }}</div>
                    <div class="text-sm font-bold text-black-50">{{ $item->price }} {{ config('settings.currency') }}</div>
                </div>
            </div>
            <div>
                <div class="inline-flex right">
                    @if(array_key_exists($item->id, $cart_items))
                        <button wire:click="remove({{ $item->id }}, '1')" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-l">
                            <svg class="fill-current w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" />
                            </svg>
                        </button>
                        <span class="bg-gray-300 text-gray-800 font-bold py-2 px-4">
                            {{ $cart_items[$item->id]['quantity'] }}
                        </span>
                        @if($cart_items[$item->id]['quantity'] < $item->stock)
                            <button wire:click="add({{ $item->id }})" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-r">
                        @else
                            <button wire:click="" class="bg-blue-500 text-white font-bold py-2 px-4 rounded-r opacity-50 cursor-not-allowed">
                        @endif
                            <svg class="fill-current w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                        </button>
                        <button wire:click="remove({{ $item->id }})" class="ml-2 bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded inline-flex items-center">
                            <svg class="fill-current w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    @else
                        <button wire:click="add({{ $item->id }})" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded inline-flex items-center">
                            <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd" />
                            </svg>
                            <span>{{ trans('custom.add') }}</span>
                        </button>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>





