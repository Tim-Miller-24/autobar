<x-cash::layout-client>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ trans('custom.order_ready') }}
        </h2>
    </x-slot>
    <section class="text-gray-200 bg-gray-900">
        <div class="max-w-6xl mx-auto px-5 py-24 ">
            <div class="text-center mb-20">
                <h1 class="title-font  mb-4 text-4xl font-extrabold leading-10 tracking-tight sm:text-5xl sm:leading-none md:text-6xl">Заберите ваш заказ!</h1>
                <div class="flex mt-6 justify-center">
                    <a href="{{ route('cash.show') }}" class="bg-indigo-600 hover:bg-indigo-800 text-white font-bold py-2 px-4 rounded inline-flex items-center">
                        <span>Сделать ещё один заказ</span>
                    </a>
                    {{--<div class="w-16 h-1 rounded-full bg-indigo-500 inline-flex"></div>--}}
                </div>
            </div>
    </section>
</x-cash::layout-client>
