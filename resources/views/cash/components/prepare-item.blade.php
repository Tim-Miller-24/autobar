<tr>
    <td class="px-3 py-3 border-b border-purple-200 bg-purple-600 text-lg">
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
                <p class="whitespace-no-wrap">
                    <span class="text-white ">
                        {{ $item->item->name }}
                        @if(isset($item->option))
                            {{ $item->option->name }}
                        @endif
                    </span>
                    <span class="font-bold text-lg text-dark">x {{ $item->quantity }}</span>
                </p>
            </div>
        </div>
    </td>
    <td class="px-3 py-3 border-b border-purple-200 bg-purple-600 text-lg">
        <p class="text-white whitespace-no-wrap">{{ $item->price }}</p>
    </td>
    <td class="px-3 py-3 border-b border-purple-200 bg-purple-600 text-lg">
        <p class="text-white whitespace-no-wrap">
            {{ $item->quantity * $item->price }}
        </p>
    </td>
</tr>