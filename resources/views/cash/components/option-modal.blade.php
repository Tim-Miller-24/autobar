@foreach($item->options as $option)
    @if($item->getStockOption($option->id))
        <span>
            @livewire('cash.item-option', [
            'item' => $item,
            'option' => $option
        ])
        </span>
    @endif
@endforeach