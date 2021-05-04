<div class="grid grid-flow-col auto-cols-max gap-4 grid-flow-row auto-rows-max">
    @foreach($item->activeOptions as $option)
        <div>
            @livewire('cash.item-option', [
                'item' => $item,
                'option' => $option
            ])
        </div>
    @endforeach
</div>
