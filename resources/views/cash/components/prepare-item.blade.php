<li class="flex justify-center items-center">
    <div class="bg-white w-full">
        <div class="flex justify-between items-center px-4 py-1">
            <div class="flex items-center">
                <div class="text-lg font-bold">
                            <span class="text-primary">
                                {{ $item->item->category->name }}
                            </span>
                    <span class="text-secondary">
                                 {{ $item->item->name }}
                            </span>
                </div>
            </div>
            <div>
                <div class="inline-flex right">
                    <div class="text-lg uppercase font-bold text-primary p-1 mr-2">
                        {{ trans('custom.x_quantity', ['count' => $item->quantity]) }}
                    </div>
                    <div class="text-lg uppercase font-bold text-secondary p-1">
                        {{ $item->price }} {{ config('settings.currency') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</li>
