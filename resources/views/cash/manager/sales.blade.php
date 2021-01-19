<x-cash::layout-manager>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ trans('custom.sales') }}
        </h2>
    </x-slot>
    <div class="container mx-auto py-2">
        <form method="post" action="{{ route('manager.sales.form') }}">
            <div class="mb-5 w-64 mr-10 float-left">
                @include('cash.manager.partial.datepicker', ['text' => 'С:', 'pickerId' => 'startDate'])
            </div>

            <div class="mb-5 w-64 mr-10 float-left">
                @include('cash.manager.partial.datepicker', ['text' => 'По:', 'pickerId' => 'endDate'])
            </div>
            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
            <input type="submit" />
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
                Продано
            </th>
            <th class="p-3 font-bold uppercase bg-blue-500 text-white border border-gray-300 hidden lg:table-cell">
                Цена продажи
            </th>
            <th class="p-3 font-bold uppercase bg-blue-500 text-white border border-gray-300 hidden lg:table-cell">
                Итого
            </th>
            <th class="p-3 font-bold uppercase bg-red-500 text-white border border-gray-300 hidden lg:table-cell">
                Цена покупки
            </th>
            <th class="p-3 font-bold uppercase bg-red-500 text-white border border-gray-300 hidden lg:table-cell">
                Итого
            </th>
            <th class="p-3 font-bold uppercase bg-green-500 text-white border border-gray-300 hidden lg:table-cell">
                Доход
            </th>
        </tr>
        </thead>
        <tbody class="overflow-y-scroll">
        @foreach($sales as $sale)
            @include('cash.manager.partial.sale-item', ['sale' => $sale])
        @endforeach
        <tr class="bg-white lg:hover:bg-gray-100 flex lg:table-row border-b flex-row lg:flex-row flex-wrap lg:flex-no-wrap mb-10 lg:mb-0">
            <td colspan="2" class="w-full lg:w-auto p-3 text-gray-800 text-left border border-b block lg:table-cell ">
                <span class="font-bold">Итого:</span>
            </td>
            <td colspan="2" class="w-full lg:w-auto p-3 font-bold text-white bg-blue-500 border-b text-center block lg:table-cell ">
                {{ $summary['sold'] }}
            </td>
            <td colspan="2" class="w-full lg:w-auto p-3 font-bold bg-red-500 text-white border-b text-center block lg:table-cell ">
                {{ $summary['purchase'] }}
            </td>
            <td class="w-full lg:w-auto p-3 font-bold text-white bg-green-500 border-b text-center block lg:table-cell">
                {{ $summary['sold'] - $summary['purchase'] }}
            </td>
        </tr>
        </tbody>
    </table>
</x-cash::layout-manager>
