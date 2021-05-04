<div class="bg-white w-full relative cursor-pointer border border-primary shadow-lg">
    <div class="w-full h-32 bg-contain bg-bottom bg-no-repeat"
         style="background-image: url({{ $item->image_url }})">
    </div>
    <div class="px-2 py-1 text-sm text-black font-bold">{{ $item->name }}</div>
    @if($item->description)
        {{--<div class="px-2 text-xs text-gray-600">{{ $item->description }}</div>--}}
    @endif
    <div class="bg-secondary">
        <div class="grid grid-cols-10 mt-1 relative">
            <div class="col-span-4 pt-3 text-center shadow-inner">
                <div class="text-base text-green-400 font-bold">{{ $price }}</div>
            </div>
            <div class="col-span-6">
                @if(count($item->activeOptions))
                    @include('cash.components.item-single-button-option')
                @else
                   @include('cash.components.item-single-button')
                @endif
            </div>
        </div>
    </div>
</div>