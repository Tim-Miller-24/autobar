@if(isset($item['options']))
    @foreach($item['options'] as $option)
        <tr>
            <td class="px-3 py-3 border-b border-purple-200 bg-purple-600 text-lg">
                <div class="flex items-center">
                    <div class="flex-shrink-0 w-10 h-10">
                        @if($option['data']->image_url)
                            <img class="w-full h-full rounded-full"
                                 src="{{ $item['data']->image_url }}"
                                 alt="" />
                        @else
                            <img class="w-full h-full rounded-full"
                                 src="{{ $item['data']->image_url }}"
                                 alt="" />
                        @endif
                    </div>
                    <div class="ml-3">
                        <p class="text-white whitespace-no-wrap font-bold">
                            {{ $item['data']->name }}
                        </p>
                        <p class="text-gray-400 whitespace-no-wrap font-bold">
                            {{ $option['data']->name }}
                        </p>
                    </div>
                </div>
            </td>
            <td class="px-3 py-3 border-b border-purple-200 bg-purple-600 text-lg">
                <p class="text-white whitespace-no-wrap">{{ $item['data']->price }}</p>
            </td>
            <td class="px-3 py-3 border-b border-purple-200 bg-purple-600 text-lg">
                <p class="text-white whitespace-no-wrap">
                    {{ $option['quantity'] }}
                </p>
            </td>
            <td class="px-3 py-3 border-b border-purple-200 bg-purple-600 text-lg">
                <p class="text-white whitespace-no-wrap">
                    {{ $option['quantity'] * $option['data']->price }}
                </p>
            </td>
        </tr>
    @endforeach
@else
    <tr>
        <td class="px-3 py-3 border-b border-purple-200 bg-purple-600 text-lg">
            <div class="flex items-center">
                <div class="flex-shrink-0 w-10 h-10">
                    <img class="w-full h-full rounded-full"
                         src="{{ $item['data']->image_url }}"
                         alt="" />
                </div>
                <div class="ml-3">
                    <p class="text-white whitespace-no-wrap font-bold">
                        {{ $item['data']->name }}
                    </p>
                </div>
            </div>
        </td>
        <td class="px-3 py-3 border-b border-purple-200 bg-purple-600 text-lg">
            <p class="text-white whitespace-no-wrap">{{ $item['data']->price }}</p>
        </td>
        <td class="px-3 py-3 border-b border-purple-200 bg-purple-600 text-lg">
            <p class="text-white whitespace-no-wrap">
                {{ $item['quantity'] }}
            </p>
        </td>
        <td class="px-3 py-3 border-b border-purple-200 bg-purple-600 text-lg">
            <p class="text-white whitespace-no-wrap">
                {{ $item['quantity'] * $item['data']->price }}
            </p>
        </td>
    </tr>
@endif
