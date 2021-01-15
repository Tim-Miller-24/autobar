<ul>
    @foreach($items as $item)
        @include('cash.components.checkout-item', [
            'item' => $item
        ])
    @endforeach
</ul>
