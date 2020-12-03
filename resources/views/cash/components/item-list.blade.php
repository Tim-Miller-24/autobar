<div class="py-8">
    <div class="grid grid-cols-3 sm:grid-cols-2 gap-4 md:grid-cols-2 lg:grid-cols-3 max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">
        @if($items->count())
            @foreach($items as $item)
                @if($item->stock > 0)
                    @include('cash.components.item-single', ['count' => 1])
                @endif
            @endforeach
        @endif
    </div>
</div>

