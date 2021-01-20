<table cellpadding="5">
    <thead>
    <tr>
        <th width="30%">
            <b>Наименование</b>
        </th>
        <th width="10%" style="background-color: #4dc0b5;">
            <b>
                Продано
            </b>
        </th>
        <th width="10%">
            <b>Получено</b>
        </th>
        <th>
            <b>Остаток</b>
        </th>
        <th width="15%" style="background-color: #e3342f;">
            <b>Себестоимость</b>
        </th>
        <th style="background-color: #e3342f;">
            <b>Итого</b>
        </th>
        <th style="background-color: #3490dc;">
            <b>Продажа</b>
        </th>
        <th style="background-color: #3490dc;">
            <b>Итого</b>
        </th>
        <th style="background-color: #38c172;">
            <b>Доход</b>
        </th>
    </tr>
    </thead>
    <tbody>
        @foreach($items as $item)
            @include('cash.manager.export.partial.stats-item', ['item' => $item])
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            Итого
        </tr>
    </tfoot>
</table>