<x-cash::layout-client>
    <x-slot name="header">
        {{--<div class="font-bold text-3xl uppercase text-primary pb-2 pt-4 inline-flex border-b-8 border-border">--}}
            {{--{{ trans('custom.ready.header') }}--}}
        {{--</div>--}}
        {{--<div class="float-right">--}}
            {{--<div class="flex flex-row">--}}
                {{--<div>--}}
                    {{--<button onclick="location.href='{{ route('cash.show') }}'"--}}
                            {{--class="focus:outline-none bg-link-main text-secondary items-center pt-4 pb-3 px-4 text-3xl">--}}
                        {{--{{ trans('custom.ready.button') }}--}}
                    {{--</button>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    </x-slot>
    <div class="font-bold text-3xl uppercase text-primary pb-2  mb-4 pt-4 inline-flex border-b-8 border-border">
        {{ trans('custom.ready.title') }}
    </div>

    <div class="text-3xl text-white">
        {!!  trans('custom.ready.text')!!}
    </div>

    <script>
        setTimeout(function () {
        window.location.href = '{{ route('cash.show') }}';
        }, 10000);
    </script>
</x-cash::layout-client>
