@foreach($item->activeOptions as $option)
    @if($option->stock)
        <span>
            @livewire('cash.item-option', [
            'item' => $item,
            'option' => $option
        ])
        </span>
    @endif
@endforeach