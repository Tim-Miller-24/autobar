@if($items)
    <div>
        <div class="grid grid-cols-3 gap-4">
            @foreach($items as $item)
                @include('cash.components.cart-item', [
                    'item' => $item
                ])
            @endforeach
        </div>
    </div>
@else
    <div class="max-w-screen-xl mx-auto my-3">
        <h2 class="font-semibold text-2xl text-white">
            {!! trans('custom.cart_empty_text', ['url' => route('cash.show')]) !!}
        </h2>
    </div>
@endif