<div class="grid grid-cols-4 gap-4">
    @if(count($items))
        @foreach($items as $item)
            @livewire('cash.item', ['item' => $item], key('item-single-' . $item->id))
        @endforeach
    @endif
</div>