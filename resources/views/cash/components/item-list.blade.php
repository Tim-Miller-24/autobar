<div class="grid grid-cols-3 gap-4">
    @if(count($items))
        @foreach($items as $item)
            @if($item->stock > 0)
                @livewire('cash.item', ['item' => $item], key('item-single-' . $item->id))
            @endif
        @endforeach
    @endif
</div>