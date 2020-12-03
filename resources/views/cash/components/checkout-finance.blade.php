<div>
    <div class="-mx-4 px-4 py-4 overflow-x-auto">
        <div class="flex items-center mb-2">
            <div>
                <p class="text-lg font-semibold text-gray-700 dark:text-gray-200 mb-1">
                    {{ trans('custom.accepted_values') }}
                </p>
                @foreach(\App\Cashbox\Models\Wallet::getChannels() as $channel)
                    <span class="rounded-pill mr-2 bg-green-600 text-white font-bold p-1 rounded  leading-none">{{ number_format($channel) }}</span>
                @endforeach
            </div>
        </div>

        {{--<div class="flex items-center mb-2">--}}
            {{--<div>--}}
                {{--<p class="text-lg font-semibold text-gray-700 dark:text-gray-200 mb-1">--}}
                    {{--{{ trans('custom.needed_sum') }}--}}
                    {{--<span class="rounded-pill bg-red-600 text-white font-bold p-0.5 rounded leading-none">{{ number_format($total_price) }}</span>--}}
                    {{--{{ config('settings.currency') }}--}}
                {{--</p>--}}
            {{--</div>--}}
        {{--</div>--}}

        <div class="flex items-center mb-2">
            <div>
                <p class="text-lg font-semibold text-gray-700 dark:text-gray-200 mb-1">
                    {{ trans('custom.current_sum') }}
                    <span class="rounded-pill bg-red-600 text-white font-bold p-0.5 rounded leading-none">{{ number_format($current_sum) }}</span>
                    {{ config('settings.currency') }}
                </p>
            </div>
        </div>

        @if($left_sum)
        <div class="flex items-center mb-2">
            <div>
                <p class="text-lg font-semibold text-gray-700 dark:text-gray-200 mb-1">
                    {{ trans('custom.left_sum') }}
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
    </div>
</div>
