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
                    <button wire:click="addToCart({{ $item->id }})" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded inline-flex items-center">
                        <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd" />
                        </svg>
                        <span>{{ trans('custom.add') }}</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>





