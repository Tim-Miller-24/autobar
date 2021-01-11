<ul class="grid grid-cols-2 gap-4">
    @foreach($order->items as $item)
        @include('cash.components.prepare-item', [
            'item' => $item
        ])
    @endforeach
</ul>