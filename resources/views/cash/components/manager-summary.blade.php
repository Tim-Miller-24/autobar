<div>
    <div class="grid grid-cols-2 gap-5 mb-5">
        @if(!$payout)
            <div class="p-2 transition-shadow border border-blue-500 rounded-lg shadow-sm hover:shadow-lg bg-blue-200">
                <div class="flex items-start justify-between">
                    <div class="flex flex-col space-y-1">
                        <span class="text-blue-800 font-bold">{{ trans('custom.paid') }}</span>
                        <span class="text-lg font-semibold">{{ number_format($order_current_sum) }} {{ config('settings.currency') }}</span>
                    </div>
                </div>
            </div>
        @endif

        @if($left_sum)
            <div class="p-2 transition-shadow border border-red-800 rounded-lg shadow-sm hover:shadow-lg bg-red-200">
                <div class="flex items-start justify-between">
                    <div class="flex flex-col space-y-1">
                        <span class="text-red-800 font-bold">{{ trans('custom.order_left_sum') }}</span>
                        <span class="text-lg font-semibold">{{ number_format($left_sum) }} {{ config('settings.currency') }}</span>
                    </div>
                </div>
            </div>
        @endif

        @if($payout)
            <div class="p-2 transition-shadow border border-red-800 rounded-lg shadow-sm hover:shadow-lg bg-red-200">
                <div class="flex items-start justify-between">
                    <div class="flex flex-col space-y-1">
                        <span class="text-red-800 font-bold">{{ trans('custom.payout') }}</span>
                        <span class="text-lg font-semibold">{{ number_format($payout) }} {{ config('settings.currency') }}</span>
                    </div>
                </div>
            </div>
        @endif
    </div>

    <div class="-mx-4 px-4 overflow-x-auto">
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
                        {{ trans('custom.item_summary') }}
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach($order->items as $item)
                    @include('cash.components.manager-order-item', [
                        'item' => $item
                    ])
                @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="2"
                            class="px-2 py-2 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">

                        </th>
                        <th
                            class="px-2 py-2 bg-gray-100 text-left text-sm font-bold text-gray-600 uppercase tracking-wider">
                            {{ $order->total() }} {{ config('settings.currency') }}
                        </th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

    @if(!$left_sum)
        <div class="flex items-center mt-2 float-left">
            <div>
                <button wire:click="orderFinished('{{ $order->id }}')" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded inline-flex items-center">
                    <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd" />
                    </svg>
                    <span>{{ trans('custom.finish_order') }}</span>
                </button>
            </div>
        </div>
    @endif

    <div class="flex items-center mt-2 float-right">
        <div>
            <button wire:click="cancelOrder('{{ $order->id }}')" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded inline-flex items-center">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                    </path>
                </svg>
                <span>{{ trans('custom.cancel_order') }}</span>
            </button>
        </div>
    </div>
</div>
