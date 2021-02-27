<!-- component -->
@if(isset($item['options']))
    @foreach($item['options'] as $option)
        <li class="flex justify-center items-center">
            <div class="bg-white w-full">
                <div class="flex justify-between items-center px-4 py-1">
                    <div class="flex items-center">
                        <div class="text-lg font-bold">
                            <span class="text-primary">
                                {{ $item['data']->category->name }}
                            </span>
                            <span class="text-secondary">
                                {{ $item['data']->name }}
                            </span>
                            @if(isset($option['data']->name))
                                <span class="text-primary">
                                    {{ $option['data']->name }}
                                </span>
                            @endif
                        </div>
                    </div>
                    <div>
                        <div class="inline-flex right">
                            <div class="text-lg uppercase font-bold text-primary p-1 mr-2">
                                {{ trans('custom.x_quantity', ['count' => $option['quantity']]) }}
                            </div>
                            <div class="text-lg uppercase font-bold text-secondary p-1 font-mono">
                                {{ $option['data']->price ?? $item['data']->price }} {{ config('settings.currency') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </li>
    @endforeach
    @else
        <li class="flex justify-center items-center">
            <div class="bg-white w-full">
                <div class="flex justify-between items-center px-4 py-1">
                    <div class="flex items-center">
                        <div class="text-lg font-bold">
                            <span class="text-primary">
                                {{ $item['data']->category->name }}
                            </span>
                            <span class="text-secondary">
                                 {{ $item['data']->name }}
                            </span>
                        </div>
                    </div>
                    <div>
                        <div class="inline-flex right">
                            <div class="text-lg uppercase font-bold text-primary p-1 mr-2">
                                {{ trans('custom.x_quantity', ['count' => $item['quantity']]) }}
                            </div>
                            <div class="text-lg uppercase font-bold text-secondary p-1">
                                {{ $item['data']->price }} {{ config('settings.currency') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </li>
@endif
