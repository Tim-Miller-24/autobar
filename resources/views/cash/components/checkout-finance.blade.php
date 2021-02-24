<div>
    <div class="flex items-center mb-4">
        <div>
            <p class="text-xl font-semibold text-white dark:text-gray-200">
                {{ trans('custom.needed_sum') }}:
                <div class="text-white font-bold py-2 text-5xl">{{ number_format($total_price) }} {{ config('settings.currency') }}</div>
            </p>
        </div>
    </div>

    <div class="flex items-center mb-4">
        <div>
            <p class="text-xl font-semibold text-white dark:text-gray-200">
                {{ trans('custom.current_sum') }}:
                <div class="text-white font-bold py-2 text-5xl">{{ number_format($current_sum) }} {{ config('settings.currency') }}</div>
            </p>
        </div>
    </div>

    <div class="flex items-center mb-4">
        <div>
            <p class="text-xl font-semibold text-white dark:text-gray-200">
                {{ trans('custom.accepted_values') }}
            </p>
            @foreach(\App\Cashbox\Models\Wallet::getChannels() as $channel)
                <span class="mr-1 text-white font-bold text-2xl">{{ number_format($channel) }}</span>
            @endforeach
        </div>
    </div>

    {{--@if($left_sum)--}}
        {{--<div class="flex items-center mb-2">--}}
            {{--<div>--}}
                {{--<p class="text-lg font-semibold text-white dark:text-gray-200 mb-1">--}}
                    {{--{{ trans('custom.left_sum') }}--}}
                    {{--<span class="rounded-pill bg-red-600 text-white font-bold p-1 shadow leading-none">{{ number_format($left_sum) }}</span>--}}
                    {{--{{ config('settings.currency') }}--}}
                {{--</p>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--@endif--}}

    @if($payout)
        <div class="flex items-center mb-2">
            <div>
                <p class="text-lg font-semibold text-white dark:text-gray-200 mb-1">
                    {{ trans('custom.payout') }}
                    <span class="rounded-pill bg-red-600 text-white font-bold p-1 shadow leading-none">{{ number_format($payout) }}</span>
                    {{ config('settings.currency') }}
                </p>
            </div>
        </div>
    @endif
</div>
