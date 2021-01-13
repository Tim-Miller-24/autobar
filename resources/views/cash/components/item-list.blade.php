<div>
    @include('cash.components.category-navigation', ['category' => $category])
    <div class="grid grid-cols-3 gap-4">
        @if($items->count())
            @foreach($items as $item)
                @if($item->stock > 0)
                    <div class="flex justify-center items-center">
                        {{--@livewire('cash.item', ['item' => $item])--}}
                        @include('cash.components.item-single', ['count' => 1])
                    </div>
                @endif
            @endforeach
        @endif
    </div>
</div>
