<x-cash::layout-manager>
    <x-slot name="header">
        <div class="font-semibold text-xl text-gray-800 leading-tight float-left">
            {{ trans('custom.sales') }}
        </div>
        <div class="float-right">
            <a href="{{ request()->fullUrlWithQuery(['download' => true]) }}" class="focus:outline-none uppercase px-8 py-2 border border-blue-600 bg-blue-300 text-blue-600 max-w-max shadow-sm hover:shadow-lg">
                Скачать список
            </a>
        </div>
    </x-slot>
    <div class="container mx-auto py-2">
        <form method="get" action="{{ route('manager.sales') }}">
            <div class="inline-block relative w-64 mr-2">
                <label for="sales_date_from" class="font-bold mb-1 text-gray-700 block">С:</label>
                <input name="date_from"
                       data-value="{{ $request->get('date_from') }}"
                       id="sales_date_from"
                       type="text"
                       class="w-full pl-4 pr-10 py-3 leading-none rounded-lg shadow-sm focus:outline-none focus:shadow-outline text-gray-600 font-medium"
                       placeholder="Выбрать число">
            </div>

            <div class="inline-block relative w-64 mr-2">
                <label for="sales_date_to" class="font-bold mb-1 text-gray-700 block">По:</label>
                <input name="date_to"
                       id="sales_date_to"
                       data-value="{{ $request->get('date_to') }}"
                       type="text"
                       class="w-full pl-4 pr-10 py-3 leading-none rounded-lg shadow-sm focus:outline-none focus:shadow-outline text-gray-600 font-medium"
                       placeholder="Выбрать число">
            </div>

            <div class="inline-block relative w-64">
                <label>
                    <label for="sales_user_id" class="font-bold mb-1 text-gray-700 block">Менеджер:</label>
                    <select class="form-select mt-1 block w-full" name="user_id" id="sales_user_id">
                        @foreach($managers as $manager)
                            <option value="{{ $manager->id }}" @if($request->get('user_id') == $manager->id) selected @endif>{{ $manager->name }}</option>
                        @endforeach
                    </select>
                </label>
            </div>
            {{--<input type="hidden" name="_token" value="{{ csrf_token() }}" />--}}
            <div class="inline-block relative w-64">
                <button type="submit" class="inline-flex items-center justify-center px-4 py-3 text-base leading-5 rounded-md border font-medium shadow-sm transition ease-in-out duration-150 focus:outline-none focus:shadow-outline bg-white border-gray-300 text-gray-700">
                    Показать
                </button>
            </div>
        </form>
    </div>

    <!-- component -->
    <table class="border-collapse w-full" id="salesTable">
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
                {{ number_format($summary['sold']) }}
            </td>
            <td colspan="2" class="w-full lg:w-auto p-3 font-bold bg-red-500 text-white border-b text-center block lg:table-cell ">
                {{ number_format($summary['purchase']) }}
            </td>
            <td class="w-full lg:w-auto p-3 font-bold text-white bg-green-500 border-b text-center block lg:table-cell">
                {{ number_format($summary['sold'] - $summary['purchase']) }}
            </td>
        </tr>
        </tbody>
    </table>
    @push('scripts')
        <script>

            let from_$input = $('#sales_date_from').pickadate({
                    monthsFull: [ 'января', 'февраля', 'марта', 'апреля', 'мая', 'июня', 'июля', 'августа', 'сентября', 'октября', 'ноября', 'декабря' ],
                    monthsShort: [ 'янв', 'фев', 'мар', 'апр', 'май', 'июн', 'июл', 'авг', 'сен', 'окт', 'ноя', 'дек' ],
                    weekdaysFull: [ 'воскресенье', 'понедельник', 'вторник', 'среда', 'четверг', 'пятница', 'суббота' ],
                    weekdaysShort: [ 'вс', 'пн', 'вт', 'ср', 'чт', 'пт', 'сб' ],
                    today: 'сегодня',
                    clear: 'удалить',
                    close: 'закрыть',
                    firstDay: 1,
                    format: 'yyyy-mm-dd'
                }),
                from_picker = from_$input.pickadate('picker');

            let to_$input = $('#sales_date_to').pickadate({
                    monthsFull: [ 'января', 'февраля', 'марта', 'апреля', 'мая', 'июня', 'июля', 'августа', 'сентября', 'октября', 'ноября', 'декабря' ],
                    monthsShort: [ 'янв', 'фев', 'мар', 'апр', 'май', 'июн', 'июл', 'авг', 'сен', 'окт', 'ноя', 'дек' ],
                    weekdaysFull: [ 'воскресенье', 'понедельник', 'вторник', 'среда', 'четверг', 'пятница', 'суббота' ],
                    weekdaysShort: [ 'вс', 'пн', 'вт', 'ср', 'чт', 'пт', 'сб' ],
                    today: 'сегодня',
                    clear: 'удалить',
                    close: 'закрыть',
                    firstDay: 1,
                    format: 'yyyy-mm-dd'
                }),
                to_picker = to_$input.pickadate('picker');


            // Check if there’s a “from” or “to” date to start with.
            if ( from_picker.get('value') ) {
                to_picker.set('min', from_picker.get('select'))
            }
            if ( to_picker.get('value') ) {
                from_picker.set('max', to_picker.get('select'))
            }

            // When something is selected, update the “from” and “to” limits.
            from_picker.on('set', function(event) {
                if ( event.select ) {
                    to_picker.set('min', from_picker.get('select'))
                }
                else if ( 'clear' in event ) {
                    to_picker.set('min', false)
                }
            });

            to_picker.on('set', function(event) {
                if ( event.select ) {
                    from_picker.set('max', to_picker.get('select'))
                }
                else if ( 'clear' in event ) {
                    from_picker.set('max', false)
                }
            });
        </script>
    @endpush
</x-cash::layout-manager>
