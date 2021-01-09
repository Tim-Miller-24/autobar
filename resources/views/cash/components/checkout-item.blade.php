<tr>
    <td class="px-3 py-3 border-b border-purple-200 bg-purple-600 text-lg">
        <div class="flex items-center">
            <div class="flex-shrink-0 w-10 h-10">
                <img class="w-full h-full rounded-full"
                     src="{{ $item->image_url }}"
                     alt="" />
            </div>
            <div class="ml-3">
                <p class="text-white whitespace-no-wrap font-bold">
                    {{ $item->name }}
                </p>
            </div>
        </div>
    </td>
    <td class="px-3 py-3 border-b border-purple-200 bg-purple-600 text-lg">
        <p class="text-white whitespace-no-wrap">{{ $item->price }}</p>
    </td>
    <td class="px-3 py-3 border-b border-purple-200 bg-purple-600 text-lg">
        <p class="text-white whitespace-no-wrap">
            {{ $quantity }}
        </p>
    </td>
    <td class="px-3 py-3 border-b border-purple-200 bg-purple-600 text-lg">
        <p class="text-white whitespace-no-wrap">
            {{ $quantity * $item->price }}
        </p>
    </td>
</tr>
