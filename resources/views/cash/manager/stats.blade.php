<x-cash::layout-manager>
    <x-slot name="header">
        <div class="font-semibold text-xl text-gray-800 leading-tight float-left">
            {{ trans('custom.stats') }}
        </div>
        <div class="float-right">
            <a href="{{ route('manager.export') }}" class="focus:outline-none uppercase px-8 py-2 border border-blue-600 bg-blue-300 text-blue-600 max-w-max shadow-sm hover:shadow-lg">
                Скачать список
            </a>
        </div>
    </x-slot>

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
