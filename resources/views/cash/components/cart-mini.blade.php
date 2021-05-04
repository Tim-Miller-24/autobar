<div class="p-3">
    @if($total_price)
        @if($items)
            @foreach($items as $item)
                @if(isset($item['options']))
                    @foreach($item['options'] as $option)
                        @include('cash.components.cart-mini-item-option')
                    @endforeach
                @else
                  @include('cash.components.cart-mini-item')
                @endif
            @endforeach
        @endif
        <div class="mt-5">
            <div class="grid grid-cols-2">
                <div class="col-span-1">
                    <span class="text-left text-primary text-2xl">
                        {{ trans('custom.item_summary') }}:
                    </span>
                </div>
                <div class="col-span-1">
                    <span class="text-primary float-right text-2xl">
                        {{ $total_price }} {{ config('settings.currency') }}
                    </span>
                </div>
            </div>
        </div>
        @if(!$current_sum)
        <div class="absolute bottom-0 left-0 w-full">
            <button onclick="location.href='{{ route('cart.checkout') }}'"
                    class="focus:outline-none bg-active text-white text-center py-4 shadow text-2xl w-full font-bold uppercase">
                {{ trans('custom.checkout') }}
            </button>
        </div>
        @endif
    @else
        <div class="text-center text-secondary m-auto w-48 my-10">
            {{ trans('custom.cart_empty') }}
        </div>
    @endif
</div>
