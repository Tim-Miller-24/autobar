<div class="text-sm">
    @if($items)
        <a href="{{ route('cart.show') }}" class="bg-blue-600 hover:bg-blue-800 text-white font-bold py-2 px-4 rounded inline-flex items-center">
            <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z" />
            </svg>
            Выбрали
            <span class="rounded-sm px-1 ml-1 mr-1 font-bold bg-red-700 text-white">
                    {{ $items_count }}
                </span> {{ trans_choice('товар|товара|товаров', $items_count, []) }}
            на
            <span class="rounded-sm px-1 ml-1 mr-1 font-bold bg-red-700 text-white">
                    {{ $total_price }}
                </span>
            {{ config('settings.currency') }}
        </a>
    @else
        <button class="bg-blue-600 text-white font-bold py-2 px-4 rounded inline-flex items-center opacity-50 cursor-not-allowed">
            <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z" />
            </svg>
            {{ trans('custom.shopping_cart_empty') }}
        </button>
    @endif
</div>
