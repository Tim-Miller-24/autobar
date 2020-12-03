<div class="py-8">
    @if($items)
        <div class="grid grid-cols-2 sm:grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-2 max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">
            @foreach($items as $item)
                @include('cash.components.cart-item', [
                    'quantity' => $item['quantity'],
                    'item' => $item['data']
                ])
            @endforeach
        </div>
        <div class="flex items-center mx-auto mt-8 place-content-center">
            <div class="flex-1 text-center">
                <a href="{{ route('cart.checkout') }}" class="shadow text-2xl bg-blue-600 hover:bg-blue-800 text-white font-bold py-2 px-4 rounded inline-flex items-center">
                    {{ trans('custom.checkout', [
                        'sum' => $total_price,
                        'currency' => config('settings.currency')
                    ]) }}
                </a>
            </div>
        </div>
    @else
        <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="font-semibold text-xl leading-tight">
                {!! trans('custom.cart_empty', ['url' => route('cash.show')]) !!}
            </h2>
        </div>
    @endif
</div>
