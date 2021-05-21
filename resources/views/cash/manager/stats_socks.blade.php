<x-cash::layout-manager>
    <x-slot name="header">
        <div class="font-semibold text-xl text-gray-800 leading-tight float-left">
            {{ trans('custom.stats') }}
        </div>
        <div class="float-right">
            <a href="{{ request()->fullUrlWithQuery(['download' => true]) }}" class="focus:outline-none uppercase px-8 py-2 border border-blue-600 bg-blue-300 text-blue-600 max-w-max shadow-sm hover:shadow-lg">
                Скачать список
            </a>
        </div>
    </x-slot>
    <div class="container mx-auto py-2">
        <form method="get" action="{{ route('manager.stats.socks') }}">
            <div class="inline-block relative w-64">
                <label>
                    <span class="text-gray-700">Сортировать по:</span>
                    <select class="form-select mt-1 block w-full" name="sort_by">
                        @foreach($sort_by_options as $option)
                            <option value="{{ $option }}" @if($request->get('sort_by', 'sold') == $option) selected @endif>{{ trans('custom.sort_by.' . $option) }}</option>
                        @endforeach
                    </select>
                </label>
            </div>

            <div class="inline-block relative w-64">
                <label>
                    <span class="text-gray-700">Порядок по:</span>
                    <select class="form-select mt-1 block w-full" name="order_by">
                        @foreach($order_by_options as $option)
                            <option value="{{ $option }}" @if($request->get('order_by', 'desc') == $option) selected @endif>{{ trans('custom.order_by.' . $option) }}</option>
                        @endforeach
                    </select>
                </label>
            </div>

            <div class="inline-block relative w-64">
                <div class="pt-8">
                    <button type="submit" class="inline-flex items-center justify-center px-4 py-2.5 text-base leading-5 rounded-md border font-medium shadow-sm transition ease-in-out duration-150 focus:outline-none focus:shadow-outline bg-white border-gray-300 text-gray-700">
                        Показать
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- component -->
    <table class="border-collapse w-full">
        <thead>
        <tr>
            <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden text-left lg:table-cell">
                Наименование
            </th>
            <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">
                Получено
            </th>
            <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">
                Продано
            </th>
            <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">
                Остаток
            </th>
            <th class="p-3 font-bold uppercase bg-red-500 text-white border border-gray-300 hidden lg:table-cell">
                Себестоимость
            </th>
            <th class="p-3 font-bold uppercase bg-red-500 text-white border border-gray-300 hidden lg:table-cell">
                Итого
            </th>
            <th class="p-3 font-bold uppercase bg-blue-500 text-white border border-gray-300 hidden lg:table-cell">
                Цена
            </th>
            <th class="p-3 font-bold uppercase bg-blue-500 text-white border border-gray-300 hidden lg:table-cell">
                Итого
            </th>
            <th class="p-3 font-bold uppercase bg-green-500 text-white border border-gray-300 hidden lg:table-cell">
                Доход
            </th>
        </tr>
        </thead>
        <tbody class="overflow-y-scroll">
            @foreach($items as $item)
                @include('cash.manager.partial.stats-item', ['item' => $item])
            @endforeach
        </tbody>
    </table>
</x-cash::layout-manager>
