<!-- component -->
@if(isset($item['options']))
    @foreach($item['options'] as $option)
        {{--{{ dd($option) }}--}}
        <div class="flex justify-center items-center">
            <div class="bg-indigo-600 w-full md:max-w-4xl shadow">
                <div class="flex justify-between items-center p-2">
                    <div class="flex items-center">
                        @if($option['data']->image_url)
                            <img class="rounded-full h-12 w-12" src="{{ $option['data']->image_url }}" alt="{{ $item['data']->name }}" />
                        @else
                            <img class="rounded-full h-12 w-12" src="{{ $item['data']->image_url }}" alt="{{ $item['data']->name }}" />
                        @endif
                        <div class="ml-2 text-sm text-white ">
                            <span class="font-bold">{{ $item['data']->name }}</span>
                            <span class="font-weight-light text-gray-400">{{ $option['data']->name }}</span>
                            <div class="font-bold">{{ $option['data']->price }} {{ config('settings.currency') }}</div>
                        </div>
                    </div>
                    <div>
                        <div class="inline-flex right">
                            <button wire:click="remove({{ $item['data']->id }}, '1', {{ $option['data']->id }})" class="focus:outline-none bg-red-600 hover:bg-red-800 text-white font-bold py-2 px-4">
                                <svg class="fill-current w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" />
                                </svg>
                            </button>
                            <span class="bg-purple-800 text-white font-bold py-2 px-4">{{ $option['quantity'] }}</span>
                            @if($option['quantity'] < $item['data']->getStockOption($option['data']->id))
                                <button wire:click="add({{ $item['data']->id }}, 1, {{ $option['data']->id }})" class="focus:outline-none bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4">
                            @else
                                <button wire:click="" class="focus:outline-none bg-blue-500 text-white font-bold py-2 px-4 rounded-r opacity-50 cursor-not-allowed">
                            @endif
                                    <svg class="fill-current w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                    </svg>
                                </button>
                            <button wire:click="remove({{ $item['data']->id }}, 0, {{ $option['data']->id }})" class="focus:outline-none ml-2 bg-red-600 hover:bg-red-800 text-white font-bold py-2 px-4 shadow inline-flex items-center">
                                <svg class="fill-current w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@else
    <div class="flex justify-center items-center">
        <div class="bg-indigo-600 w-full md:max-w-4xl shadow">
            <div class="flex justify-between items-center p-2">
                <div class="flex items-center">
                    <img class="rounded-full h-12 w-12" src="{{ $item['data']->image_url }}" alt="{{ $item['data']->name }}" />
                    <div class="ml-2">
                        <div class="text-lg font-bold text-white">{{ $item['data']->name }}</div>
                        <div class="text-sm font-bold text-white">{{ $item['data']->price }} {{ config('settings.currency') }}</div>
                    </div>
                </div>
                <div>
                    <div class="inline-flex right">
                        <button wire:click="remove({{ $item['data']->id }}, '1')" class="focus:outline-none bg-red-600 hover:bg-red-800 text-white font-bold py-2 px-4">
                            <svg class="fill-current w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" />
                            </svg>
                        </button>
                        <span class="bg-purple-800 text-white font-bold py-2 px-4">{{ $item['quantity'] }}</span>
                        @if($item['quantity'] < $item['data']->stock)
                            <button wire:click="add({{ $item['data']->id }}, 1)" class="focus:outline-none bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4">
                        @else
                            <button wire:click="" class="focus:outline-none bg-blue-500 text-white font-bold py-2 px-4 rounded-r opacity-50 cursor-not-allowed">
                        @endif
                            <svg class="fill-current w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                        </button>
                        <button wire:click="remove({{ $item['data']->id }})" class="focus:outline-none ml-2 bg-red-600 hover:bg-red-800 text-white font-bold py-2 px-4 shadow inline-flex items-center">
                            <svg class="fill-current w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif


