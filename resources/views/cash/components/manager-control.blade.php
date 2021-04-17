<div>
    @if($workday)
        <div class="mb-2">
            <div class="grid grid-cols-2 gap-5 mb-5">
                <div class="p-2 transition-shadow border border-blue-500 rounded-lg shadow-sm hover:shadow-lg bg-blue-200">
                    <span class="text-lg text-blue-800 font-bold">Касса за смену:</span>
                    <span class="text-lg font-bold">{{ number_format($workday->orders->sum('price')) }} {{ config('settings.currency') }}</span>
                </div>

                <div class="p-2 transition-shadow border border-blue-500 rounded-lg shadow-sm hover:shadow-lg bg-blue-200">
                    <span class="text-lg text-blue-800 font-bold">Заказов за смену:</span>
                    <span class="text-lg font-bold">{{ $workday->orders->count() }}</span>
                </div>
            </div>
        </div>
    @endif
    <img class="object-fill p-1 bg-white border border-gray-100 shadow" src="{{ env('CAMERA_URL') }}" />
</div>
