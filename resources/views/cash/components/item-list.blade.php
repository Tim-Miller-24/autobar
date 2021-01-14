<div class="grid grid-cols-3 gap-4">
    @if($items->count())
        @foreach($items as $item)
            @if($item->stock > 0)
                @livewire('cash.item', ['item' => $item])
            @endif
        @endforeach
    @endif
</div>