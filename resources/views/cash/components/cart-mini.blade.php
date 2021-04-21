<div class="text-primary font-bold font-4xl p-3 uppercase border-b border-primary">
    {{ trans('custom.my_order') }}
</div>

<div class="flex flex-row">
    @if($total_price)
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