<x-cash::layout-client>
    <x-slot name="header">
        <div class="font-bold text-3xl uppercase text-primary pb-2 pt-4 inline-flex border-b-8 border-border">
            {{ trans('custom.ready.header') }}
        </div>
        <div class="float-right">
            <div class="flex flex-row">
                <div>
                    <button onclick="location.href='{{ route('cash.show') }}'"
                            class="focus:outline-none bg-link-main text-secondary items-center pt-4 pb-3 px-4 text-3xl">
                        {{ trans('custom.ready.button') }}
                    </button>
                </div>
            </div>
        </div>
    </x-slot>
    <section class="text-white">
        <div class="max-w-6xl mr-auto py-24">
            <div class="mb-20">
                <h1 class="mb-10 text-7xl ">
                    {{ trans('custom.ready.title') }}
                </h1>
                <div class="mt-1 text-3xl font-light text-white antialiased">{!!  trans('custom.ready.text')!!}</div>
            </div>
            <script>
                setTimeout(function () {
                    window.location.href = '{{ route('cash.show') }}';
                }, 10000);
            </script>
        </div>
    </section>
</x-cash::layout-client>
