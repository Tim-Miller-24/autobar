<button onclick="location.href='{{ route('cart.show') }}'"
   class="focus:outline-none bg-purple-800 hover:bg-indigo-600 text-white uppercase font-bold py-3 px-4 shadow inline-flex items-center">
    <svg class="fill-current w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
        <path
            d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z"/>
    </svg>
    {{--<span class="rounded-sm px-1 ml-1 mr-1 font-bold bg-blue-700 text-white">{{ $items_count }}</span>--}}
    {{--{{ trans_choice('товар|товара|товаров', $items_count, []) }}--}}
    {{--на--}}
    {{--<span class="rounded-sm px-1 ml-1 mr-1 font-bold bg-blue-700 text-white">{{ $total_price }}</span>--}}
    {{--{{ $items_count }}--}}
    {{--{{ trans_choice('товар|товара|товаров', $items_count, []) }}--}}
    {{--на--}}
    @if($total_price)
        {{ trans('custom.pay_sum', ['sum' => $total_price]) }}
    @else
        {{ $total_price }}
    @endif

    {{ config('settings.currency') }}
</button>
