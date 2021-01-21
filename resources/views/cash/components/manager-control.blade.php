<div>
    <div class="flex items-center mb-2">
        <div>
            <p class="text-lg font-semibold text-gray-700 dark:text-gray-200 mb-1">
                {{ trans('custom.paid') }}
                <span class="rounded-pill bg-red-600 text-white font-bold p-0.5 rounded leading-none">{{ number_format($order_current_sum) }}</span>
                {{ config('settings.currency') }}
            </p>
        </div>
    </div>
    @if($left_sum)
        <div class="flex items-center mb-2">
            <div>
                <p class="text-lg font-semibold text-gray-700 dark:text-gray-200 mb-1">
                    {{ trans('custom.order_left_sum') }}
                    <span class="rounded-pill bg-red-600 text-white font-bold p-0.5 rounded leading-none">{{ number_format($left_sum) }}</span>
                    {{ config('settings.currency') }}
                </p>
            </div>
        </div>
    @endif

    @if($payout)
        <div class="flex items-center mb-2">
            <div>
                <p class="text-lg font-semibold text-gray-700 dark:text-gray-200 mb-1">
                    {{ trans('custom.payout') }}
                    <span class="rounded-pill bg-red-600 text-white font-bold p-0.5 rounded leading-none">{{ number_format($payout) }}</span>
                    {{ config('settings.currency') }}
                </p>
            </div>
        </div>
    @endif
    @if(!$left_sum)
    <div class="flex items-center mb-2">
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
    <div class="flex items-center mb-2">
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
