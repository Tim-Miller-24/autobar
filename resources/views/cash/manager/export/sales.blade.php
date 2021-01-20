<table class="border-collapse w-full" id="salesTable">
    <thead>
    <tr>
        <th width="40%">
            <b>Наименование</b>
        </th>
        <th>
            <b>Продано</b>
        </th>
        <th style="background-color: #3490dc;" width="15%">
            <b>Цена продажи</b>
        </th>
        <th style="background-color: #3490dc;">
            <b>Итого</b>
        </th>
        <th style="background-color: #e3342f;" width="15%">
            <b>Цена покупки</b>
        </th>
        <th style="background-color: #e3342f;">
            <b>Итого</b>
        </th>
        <th style="background-color: #38c172;">
            <b>Доход</b>
        </th>
    </tr>
    </thead>
    <tbody class="overflow-y-scroll">
    @foreach($sales as $sale)
        @include('cash.manager.export.partial.sale-item', ['sale' => $sale])
    @endforeach
    <tr>
        <td colspan="2">
            <b>Итого:</b>
        </td>
        <td colspan="2" style="background-color: #3490dc;">
            {{ number_format($summary['sold']) }}
        </td>
        <td colspan="2" style="background-color: #e3342f;">
            {{ number_format($summary['purchase']) }}
        </td>
        <td style="background-color: #38c172;">
            {{ number_format($summary['sold'] - $summary['purchase']) }}
        </td>
    </tr>
    </tbody>
</table>