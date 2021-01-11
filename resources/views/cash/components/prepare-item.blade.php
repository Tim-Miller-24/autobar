<li class="flex justify-center items-center mb-2">
    <div class="bg-white w-full md:max-w-4xl shadow">
        <div class="flex justify-between items-center p-2">
            <div class="flex items-center">
                @if(isset($item->option) AND $item->option->image_url)
                    <img class="h-12 w-12 rounded-full"
                         src="{{ $item->option->image_url }}"
                         alt="" />
                @else
                    <img class="h-12 w-12 rounded-full"
                         src="{{ $item->item->image_url }}"
                         alt="" />
                @endif
                <div class="ml-2">
                    <div class="text-lg font-bold">
                        <span class="text-purple-900">
                            {{ $item->item->name }}
                            @if(isset($item->option))
                                <span class="text-black">
                                    {{ $item->option->name }}
                                </span>
                            @endif
                        </span>
                    </div>
                </div>
            </div>
            <div>
                <div class="inline-flex right">
                    <div class="text-lg uppercase font-bold text-black p-1 mr-2">{{ $item->price }} {{ config('settings.currency') }}</div>
                    <span class="bg-red-600 p-1 font-bold text-lg text-white">x{{ $item->quantity }}</span>
                </div>
            </div>
        </div>
    </div>
</li>

{{--<tr>--}}
    {{--<td class="px-3 py-3 border-b border-purple-200 bg-purple-600 text-lg">--}}
        {{--<div class="flex items-center">--}}
            {{--<div class="flex-shrink-0 w-10 h-10">--}}
                {{--@if(isset($item->option) AND $item->option->image_url)--}}
                    {{--<img class="h-12 w-12 rounded-full"--}}
                         {{--src="{{ $item->option->image_url }}"--}}
                         {{--alt="" />--}}
                {{--@else--}}
                    {{--<img class="h-12 w-12 rounded-full"--}}
                         {{--src="{{ $item->item->image_url }}"--}}
                         {{--alt="" />--}}
                {{--@endif--}}
            {{--</div>--}}
            {{--<div class="ml-3">--}}
                {{--<p class="whitespace-no-wrap">--}}
                    {{--<span class="text-white ">--}}
                        {{--{{ $item->item->name }}--}}
                        {{--@if(isset($item->option))--}}
                            {{--{{ $item->option->name }}--}}
                        {{--@endif--}}
                    {{--</span>--}}
                    {{--<span class="font-bold text-lg text-dark">x {{ $item->quantity }}</span>--}}
                {{--</p>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</td>--}}
    {{--<td class="px-3 py-3 border-b border-purple-200 bg-purple-600 text-lg">--}}
        {{--<p class="text-white whitespace-no-wrap">{{ $item->price }}</p>--}}
    {{--</td>--}}
    {{--<td class="px-3 py-3 border-b border-purple-200 bg-purple-600 text-lg">--}}
        {{--<p class="text-white whitespace-no-wrap">--}}
            {{--{{ $item->quantity * $item->price }}--}}
        {{--</p>--}}
    {{--</td>--}}
{{--</tr>--}}