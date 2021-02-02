@foreach($item->activeOptions as $option)
    <span>
        @livewire('cash.item-option', [
            'item' => $item,
            'option' => $option
        ])
    </span>
@endforeach