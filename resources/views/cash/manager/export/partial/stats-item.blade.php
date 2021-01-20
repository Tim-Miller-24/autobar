<tr>
    <td align="left">
        <b>{{ $item['name'] }}</b>
        @if($item['option'])
            &nbsp;{{ $item['option'] }}
        @endif
    </td>
    <td style="background-color: #4dc0b5;" align="left">
        {{ $item['sold'] }}
    </td>
    <td align="left">
        {{ $item['incomes'] }}
    </td>
    <td align="left">
        {{ $item['stock'] }}
    </td>
    <td align="left" style="background-color: #e3342f;">
        {{ $item['income_price'] }}
    </td>
    <td align="left" style="background-color: #e3342f;">
        {{ $item['income_price'] * $item['sold'] }}
    </td>
    <td align="left" style="background-color: #3490dc;">
        {{ $item['price'] }}
    </td>
    <td align="left" style="background-color: #3490dc;">
        {{ $item['price'] * $item['sold'] }}
    </td>
    <td align="left" style="background-color: #38c172;">
        {{ ($item['price'] * $item['sold']) - ($item['income_price'] * $item['sold']) }}
    </td>
</tr>