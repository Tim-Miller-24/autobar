<div class="p-3">
    <div class="grid grid-cols-3">
        <div class="flex items-center mb-4 col-span-3">
            <div class="w-full">
                <p class="text-xl font-bold mb-2 bg-red-600 text-white p-2">
                    {!! trans('custom.gift_user_text', ['sum' => number_format(env('GIFT_SUM'))])  !!}
                </p>
            </div>
        </div>

        <div class="flex items-center mb-4">
            <div>
                <p class="text-lg font-bold text-secondary">
                    {{ trans('custom.needed_sum') }}
                <div class="text-white font-bold py-2 text-3xl">{{ number_format($total_price) }} {{ config('settings.currency') }}</div>
                </p>
            </div>
        </div>

        @if($left_sum)
            <div class="flex items-center mb-4">
                <div>
                    <p class="text-xl font-semibold text-secondary">
                        {{ trans('custom.left_sum') }}
                    <div class="text-red-400 font-bold py-2 text-3xl">
                        {{ number_format($left_sum) }} {{ config('settings.currency') }}
                    </div>
                    </p>
                </div>
            </div>
        @endif

        <div class="flex items-center mb-4">
            <div>
                <p class="text-xl font-semibold text-secondary">
                    {{ trans('custom.current_sum') }}
                <div class="text-green-400 font-bold py-2 text-3xl">
                    {{ number_format($current_sum) }} {{ config('settings.currency') }}
                </div>
                </p>
            </div>
        </div>

        <div class="flex items-center mb-4 col-span-3">
            <div>
                <p class="text-xl font-bold text-secondary mb-2">
                    {{ trans('custom.accepted_values') }}
                </p>
                @foreach(\App\Cashbox\Models\Wallet::getChannels() as $channel)
                    <span class="mr-1 text-white font-bold text-2xl bg-active p-1">{{ number_format($channel) }}</span>
                @endforeach
            </div>
        </div>

    </div>
</div>
