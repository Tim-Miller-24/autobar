<tr>
    <td class="px-3 py-3 border-b border-gray-200 bg-white text-sm">
        <div class="flex items-center">
            <div class="flex-shrink-0 w-10 h-10">
                @if(isset($item->option) AND $item->option->image_url)
                    <img class="w-full h-full rounded-full"
                         src="{{ $item->option->image_url }}"
                         alt="" />
                @else
                    <img class="w-full h-full rounded-full"
                         src="{{ $item->item->image_url }}"
                         alt="" />
                @endif

            </div>
            <div class="ml-3">
                <p class="text-gray-900 whitespace-no-wrap">
                    <span class="font-bold">{{ $item->item->category->name }}</span>
                    {{ $item->item->name }}
                    @if(isset($item->option))
                        / {{ $item->option->name }}
                    @endif
                </p>
                <p class="font-bold text-lg text-dark">
                    {{ trans('custom.x_quantity', ['count' => $item->quantity]) }}
                </p>
            </div>
        </div>
    </td>
    <td class="px-3 py-3 border-b border-gray-200 bg-white text-sm">
        <p class="text-gray-900 whitespace-no-wrap">{{ $item->price }}</p>
    </td>
    <td class="px-3 py-3 border-b border-gray-200 bg-white text-sm">
        <p class="text-gray-900 whitespace-no-wrap">
            {{ $item->quantity * $item->price }}
        </p>
    </td>
</tr>