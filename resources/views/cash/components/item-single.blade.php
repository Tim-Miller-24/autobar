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
                    @include('cash.components.item-single-button-option')
                @else
                   @include('cash.components.item-single-button')
                @endif
            </div>
        </div>
    </div>
</div>