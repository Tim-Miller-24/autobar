<x-cash::layout-slideshow>
    <x-slot name="header">
        {{--@livewire('cash.menu-button')--}}
        {{--<div class="float-right">--}}
            {{--@livewire('cash.cart-mini')--}}
        {{--</div>--}}
    </x-slot>
    <div class="flex flex-row my-4">
        {{--{{ dd($item) }}--}}
        {{--<div class="text-7xl uppercase text-primary">--}}
            {{--{{ trans('custom.shopping_cart') }}--}}
        {{--</div>--}}
        {{--<div class="ml-4">--}}
            {{--@livewire('cash.cart-clear')--}}
        {{--</div>--}}
    </div>
    {{--@livewire('cash.cart')--}}
    <script>
        let fetchUrl = "{{ route('slide.fetch') }}";
        let slideshow = true;
    </script>
</x-cash::layout-slideshow>
