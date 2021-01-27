<tr class="bg-white lg:hover:bg-gray-100 flex lg:table-row flex-row lg:flex-row flex-wrap lg:flex-no-wrap mb-10 lg:mb-0">
    <td class="w-full lg:w-auto px-2 py-1 text-gray-800 text-left border border-b block lg:table-cell relative lg:static">
        <span class="font-bold text-blue-800">
            <a target="_blank" href="{{ route('item.edit', ['id' => $item->id]) }}">{{ $item->name }}</a>
        </span>
    </td>
    <td class="w-full lg:w-auto px-2 py-1 font-bold text-white bg-red-500 border-b text-center block lg:table-cell relative lg:static">
        {{ $item->purchase_price }}
    </td>
    <td class="w-full lg:w-auto px-2 py-1 font-bold text-white bg-green-500 border-b text-center block lg:table-cell relative lg:static">
        <input class="form-input text-black" name="items[{{ $item->id }}][price]" value="{{ $item->price }}" />
    </td>
</tr>
@if(count($item->options))
    @foreach($item->options as $option)
        <tr class="bg-white lg:hover:bg-gray-100 flex lg:table-row flex-row lg:flex-row flex-wrap lg:flex-no-wrap mb-10 lg:mb-0">
            {{--<td class="w-full lg:w-auto px-2 py-1 text-left border border-b block lg:table-cell relative lg:static">--}}
                {{--<span class="font-bold text-blue-800">--}}
                    {{--<a href="{{ route('item.edit', ['id' => $item->id]) }}">{{ $item->name }}</a>--}}
                {{--</span>--}}
                {{--@if(!$option->price)--}}
                    {{--<span class="text-black font-bold">--}}
                        {{--({{ $item->price }})--}}
                    {{--</span>--}}
                {{--@endif--}}
            {{--</td>--}}
            <td class="w-full lg:w-auto px-2 py-1 font-bold text-left text-white bg-blue-400 border-b block lg:table-cell relative lg:static">
                <div class="flex">
                    <div>
                        <input class="form-input text-black float-left" name="options[{{ $option->id }}][name]" value="{{ $option->name }}" />
                    </div>
                    <div class="inline-block align-middle">
                        <a href="{{ route('option.edit', ['id' => $option->id]) }}" target="_blank">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                        </a>
                    </div>
                </div>
            </td>
            <td class="w-full lg:w-auto px-2 py-1 font-bold text-white bg-red-500 border-b text-center block lg:table-cell relative lg:static">
                {{ $option->purchase_price }}
            </td>
            <td class="w-full lg:w-auto px-2 py-1 font-bold text-white bg-green-500 border-b text-center block lg:table-cell relative lg:static">
                <input @if(!$option->price) placeholder="{{ $item->price }}" @endif class="form-input text-black" name="options[{{ $option->id }}][price]" value="{{ $option->price }}" />
            </td>
        </tr>
    @endforeach
@endif
