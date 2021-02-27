<ul>
    @foreach($order->items as $item)
        @include('cash.components.prepare-item', [
            'item' => $item
        ])
    @endforeach
    <li class="flex justify-center items-center border-t-2">
        <div class="bg-white w-full">
            <div class="flex justify-between items-center px-4 py-1">
                <div class="flex items-center">
                    <div class="text-lg font-bold">
            <span class="text-secondary">
                {{ trans('custom.item_summary')}}
            </span>
                    </div>
                </div>
                <div>
                    <div class="inline-flex right">
                        <div class="text-lg uppercase font-bold text-secondary p-1 font-mono">
                            {{ \App\Cashbox\Models\Cart::getTotalPrice() }} {{ config('settings.currency') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </li>
</ul>