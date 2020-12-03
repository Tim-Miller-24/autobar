{{--<x-slot name="header">--}}
    {{--<div class="text-sm">--}}
        {{--<button wire:click="cancel()" class="bg-red-600 hover:bg-red-800 text-white font-bold py-2 px-4 rounded inline-flex items-center">--}}
            {{--<svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">--}}
                {{--<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />--}}
            {{--</svg>--}}
            {{--{{ trans('custom.cancel_order') }}--}}
        {{--</button>--}}
    {{--</div>--}}
{{--</x-slot>--}}
<div class="py-8 px-8">
    <div class="grid grid-cols-2 gap-4">
        @include('cash.components.checkout-summary')
        @include('cash.components.checkout-finance')
    </div>
</div>
