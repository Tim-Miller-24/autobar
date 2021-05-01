<x-cash::layout-client>
    {{--<x-slot name="header">--}}
        {{--<button onclick="location.href='{{ route('cash.show') }}'"--}}
                {{--class="focus:outline-none text-link-main font-bold text-3xl uppercase text-link-main pb-2 pt-4 inline-flex border-b-8 border-border">--}}
            {{--<svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">--}}
                {{--<path fill-rule="evenodd" d="M7.707 3.293a1 1 0 010 1.414L5.414 7H11a7 7 0 017 7v2a1 1 0 11-2 0v-2a5 5 0 00-5-5H5.414l2.293 2.293a1 1 0 11-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />--}}
            {{--</svg>--}}
            {{--<span>{{ trans('custom.back_to_menu') }}</span>--}}
        {{--</button>--}}
        {{--<div class="float-right">--}}
            {{--@livewire('cash.cart-mini')--}}
        {{--</div>--}}
    {{--</x-slot>--}}
    {{--@include('cash.components.category-navigation', ['category' => $category])--}}
    @livewire('cash.item-list', ['category' => $category])
</x-cash::layout-client>
