@include('cash.components.category-navigation', ['category' => $category])
<div class="grid grid-cols-3 gap-4">
    @if($items->count())
        @foreach($items as $item)
            @if($item->stock > 0)
                @include('cash.components.item-single', ['count' => 1])
            @endif
        @endforeach
    @endif
</div>