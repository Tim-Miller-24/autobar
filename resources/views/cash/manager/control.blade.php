<x-cash::layout-manager>
    <x-slot name="header">
        <div class="font-semibold text-xl text-gray-800 leading-tight float-left">
            Редактирование товаров
        </div>
    </x-slot>

    <div class="my-3">
        {{ $items->links() }}
    </div>
    <form action="{{ route('manager.control.handle') }}" method="post">
        <!-- component -->
        <table class="border-collapse w-full">
            <thead>
            <tr>
                <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden text-left lg:table-cell">
                    Наименование
                </th>
                <th class="p-3 font-bold uppercase bg-red-500 text-white border border-gray-300 hidden lg:table-cell">
                    Себестоимость
                </th>
                <th class="p-3 font-bold uppercase bg-green-500 text-white border border-gray-300 hidden lg:table-cell">
                    Цена
                </th>
            </tr>
            </thead>
            <tbody class="overflow-y-scroll">
                @foreach($items as $item)
                    @include('cash.manager.partial.control-item', ['item' => $item])
                @endforeach
            </tbody>
        </table>
        {{ csrf_field() }}
        <div class="my-2">
            <div class="inline-block relative w-64">
                <button type="submit" class="inline-flex items-center justify-center px-4 py-2 text-base leading-5 rounded-md border font-medium shadow-sm transition ease-in-out duration-150 focus:outline-none focus:shadow-outline bg-white border-gray-300 text-gray-700">
                    Сохранить
                </button>
            </div>
        </div>
    </form>
</x-cash::layout-manager>
