<tr>
    <td width="20%">
        <b>{{ $sale->item->name }}</b>
        @if($sale->option)
            &nbsp;{{ $sale->option->name }}
        @endif
    </td>
    <td align="left">
        {{ $sale->quantity }}
    </td>
    <td align="left" style="background-color: #3490dc;">
        {{ number_format($sale->price) }}
    </td>
    <td align="left" style="background-color: #3490dc;">
        {{ number_format($sale->price * $sale->quantity) }}
    </td>
    <td align="left" style="background-color: #e3342f;">
        {{ number_format($sale->purchase_price) }}
    </td>
    <td align="left" style="background-color: #e3342f;">
        {{ number_format($sale->purchase_price * $sale->quantity) }}
    </td>
    <td align="left" style="background-color: #38c172;">
        {{ number_format(($sale->price * $sale->quantity) - ($sale->purchase_price * $sale->quantity)) }}
    </td>
</tr>