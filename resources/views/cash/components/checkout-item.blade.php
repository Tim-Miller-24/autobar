<!-- component -->
@if(isset($item['options']))
    @foreach($item['options'] as $option)
        <li class="flex justify-center items-center mb-2">
            <div class="bg-white w-full md:max-w-4xl shadow">
                <div class="flex justify-between items-center p-2">
                    <div class="flex items-center">
                        @if($option['data']->image_url)
                            <img class="h-12 w-12 rounded-full"
                                 src="{{ $item['data']->image_url }}"
                                 alt="" />
                        @else
                            <img class="h-12 w-12 rounded-full"
                                 src="{{ $item['data']->image_url }}"
                                 alt="" />
                        @endif
                        <div class="ml-2">
                            <div class="text-lg font-bold">
                                <span class="text-purple-900">
                                    {{ $item['data']->name }}
                                </span>
                                @if(isset($option['data']->name))
                                    <span class="text-black">
                                        {{ $option['data']->name }}
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="inline-flex right">
                            <div class="text-lg uppercase font-bold text-black p-1 mr-2">{{ $item['data']->price }} {{ config('settings.currency') }}</div>
                            <span class="bg-red-600 p-1 font-bold text-lg text-white">x{{ $option['quantity'] }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </li>
    @endforeach
    @else
        <li class="flex justify-center items-center mb-2">
            <div class="bg-white w-full md:max-w-4xl shadow">
                <div class="flex justify-between items-center p-2">
                    <div class="flex items-center">
                        <img class="h-12 w-12 rounded-full"
                             src="{{ $item['data']->image_url }}"
                             alt="" />
                        <div class="ml-2">
                            <div class="text-lg font-bold">
                                <span class="text-purple-900">
                                    {{ $item['data']->name }}
                                </span>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="inline-flex right">
                            <div class="text-lg uppercase font-bold text-black">{{ $item['data']->price }} {{ config('settings.currency') }}</div>
                            <span class="font-bold text-lg text-dark">x{{ $item['quantity'] }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </li>
@endif




{{--@if(isset($item['options']))--}}
    {{--@foreach($item['options'] as $option)--}}
        {{--<tr>--}}
            {{--<td class="px-3 py-3 border-b border-purple-200 bg-purple-600 text-sm font-bold">--}}
                {{--<div class="flex items-center">--}}
                    {{--<div class="flex-shrink-0 w-10 h-10">--}}
                        {{--@if($option['data']->image_url)--}}
                            {{--<img class="w-full h-full rounded-full"--}}
                                 {{--src="{{ $item['data']->image_url }}"--}}
                                 {{--alt="" />--}}
                        {{--@else--}}
                            {{--<img class="w-full h-full rounded-full"--}}
                                 {{--src="{{ $item['data']->image_url }}"--}}
                                 {{--alt="" />--}}
                        {{--@endif--}}
                    {{--</div>--}}
                    {{--<div class="ml-3">--}}
                        {{--<p class="whitespace-no-wrap">--}}
                            {{--<span class="text-white">--}}
                               {{--{{ $item['data']->name }}--}}
                            {{--</span>--}}
                            {{--<span class="font-bold text-lg text-dark">x {{ $option['quantity'] }}</span>--}}
                        {{--</p>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</td>--}}
            {{--<td class="px-3 py-3 border-b border-purple-200 bg-purple-600 text-lg">--}}
                {{--<p class="text-white whitespace-no-wrap">{{ $item['data']->price }}</p>--}}
            {{--</td>--}}
            {{--<td class="px-3 py-3 border-b border-purple-200 bg-purple-600 text-lg">--}}
                {{--<p class="text-white whitespace-no-wrap">--}}
                    {{--{{ $option['quantity'] * $option['data']->price }}--}}
                {{--</p>--}}
            {{--</td>--}}
        {{--</tr>--}}
    {{--@endforeach--}}
{{--@else--}}
    {{--<tr>--}}
        {{--<td class="px-3 py-3 border-b border-purple-200 bg-purple-600 text-sm font-bold">--}}
            {{--<div class="flex items-center">--}}
                {{--<div class="flex-shrink-0 w-10 h-10">--}}
                    {{--<img class="w-full h-full rounded-full"--}}
                         {{--src="{{ $item['data']->image_url }}"--}}
                         {{--alt="" />--}}
                {{--</div>--}}

                {{--<div class="ml-3">--}}
                    {{--<p class="whitespace-no-wrap">--}}
                            {{--<span class="text-white">--}}
                               {{--{{ $item['data']->name }}--}}
                            {{--</span>--}}
                        {{--<span class="font-bold text-lg text-dark">x {{ $item['quantity'] }}</span>--}}
                    {{--</p>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</td>--}}
        {{--<td class="px-3 py-3 border-b border-purple-200 bg-purple-600 text-lg">--}}
            {{--<p class="text-white whitespace-no-wrap">{{ $item['data']->price }}</p>--}}
        {{--</td>--}}
        {{--<td class="px-3 py-3 border-b border-purple-200 bg-purple-600 text-lg">--}}
            {{--<p class="text-white whitespace-no-wrap">--}}
                {{--{{ $item['quantity'] * $item['data']->price }}--}}
            {{--</p>--}}
        {{--</td>--}}
    {{--</tr>--}}
{{--@endif--}}
