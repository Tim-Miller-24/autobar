<div>
    <div class="-mx-4 px-4 py-4 overflow-x-auto">
        <div class="inline-block min-w-full shadow rounded-lg overflow-hidden">
            <table class="min-w-full leading-normal">
                <thead>
                <tr>
                    <th
                        class="px-2 py-2 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        {{ trans('custom.item_name') }}
                    </th>
                    <th
                        class="px-2 py-2 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        {{ trans('custom.item_price') }}
                    </th>
                    <th
                        class="px-2 py-2 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        {{ trans('custom.item_quantity') }}
                    </th>
                    <th
                        class="px-2 py-2 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        {{ trans('custom.item_summary') }}
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach($items as $item)
                    @include('cash.components.checkout-item', [
                        'item' => $item['data'],
                        'quantity' => $item['quantity']
                    ])
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <th colspan="3"
                        class="px-2 py-2 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">

                    </th>
                    <th
                        class="px-2 py-2 bg-gray-100 text-left text-sm font-bold text-gray-600 uppercase tracking-wider">
                        {{ $total_price }} {{ config('settings.currency') }}
                    </th>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
