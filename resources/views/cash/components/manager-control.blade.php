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
            <button wire:click="orderFinished('{{ $order->id }}')" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded inline-flex items-center">
                <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd" />
                </svg>
                <span>{{ trans('custom.change_order_status') }}</span>
            </button>
        </div>
    </div>
    @endif
</div>
