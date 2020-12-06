@foreach($categories as $category)
    <div>
        <div class="-mx-4 px-4 py-4 overflow-x-auto">
            <div class="inline-block min-w-full shadow rounded-lg overflow-hidden">
                <table class="min-w-full leading-normal">
                    <thead>
                    <tr>
                        <th
                            class="px-2 py-2 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            {{ $category->name }}
                        </th>
                        <th
                            class="px-2 py-2 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Остаток на складе
                        </th>
                        <th
                            class="px-2 py-2 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Продано
                        </th>
                        {{--<th--}}
                            {{--class="px-2 py-2 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">--}}
                            {{--Заказов--}}
                        {{--</th>--}}
                    </tr>
                    </thead>
                    <tbody>
                    @php
                        $items = $category->items->sortBy('stock');
                    @endphp
                    @foreach($items as $item)
                        <tr>
                            <td class="px-3 py-3 border-b border-gray-200 bg-white text-sm">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 w-10 h-10">
                                        <img class="w-full h-full rounded-full"
                                             src="{{ $item->image_url }}"
                                             alt="" />
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-gray-900 whitespace-no-wrap">
                                            {{ $item->name }}
                                        </p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-3 py-3 border-b border-gray-200 bg-white text-sm">
                                <p class="text-gray-900 whitespace-no-wrap">{{ $item->stock }}</p>
                            </td>
                            <td class="px-3 py-3 border-b border-gray-200 bg-white text-sm">
                                <p class="text-gray-900 whitespace-no-wrap">
                                    {{ $item->sold }}
                                </p>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                    {{--<tfoot>--}}
                    {{--<tr>--}}
                        {{--<th colspan="3"--}}
                            {{--class="px-2 py-2 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">--}}

                        {{--</th>--}}
                        {{--<th--}}
                            {{--class="px-2 py-2 bg-gray-100 text-left text-sm font-bold text-gray-600 uppercase tracking-wider">--}}
                            {{--{{ $order->total() }} {{ config('settings.currency') }}--}}
                        {{--</th>--}}
                    {{--</tr>--}}
                    {{--</tfoot>--}}
                </table>
            </div>
        </div>
    </div>
@endforeach
