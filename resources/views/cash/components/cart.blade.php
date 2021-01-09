@if($items)
    <div>
        <div class="grid grid-cols-2 sm:grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-2">
            @foreach($items as $item)
                @include('cash.components.cart-item', [
                    'quantity' => $item['quantity'],
                    'item' => $item['data']
                ])
            @endforeach
        </div>
        <div class="flex items-center mx-auto mt-8 place-content-center">
            <div class="flex-1 text-center">
                <a href="{{ route('cart.checkout') }}" class="shadow text-2xl bg-indigo-600 hover:bg-purple-800 text-white uppercase font-bold py-4 px-4 inline-flex items-center">
                    {{ trans('custom.checkout', [
                        'sum' => $total_price,
                        'currency' => config('settings.currency')
                    ]) }}
                </a>
            </div>
        </div>
    </div>
@else
    <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="font-semibold text-xl leading-tight">
            {!! trans('custom.cart_empty', ['url' => route('cash.show')]) !!}
        </h2>
    </div>
@endif