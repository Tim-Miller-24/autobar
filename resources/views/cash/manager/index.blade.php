<x-cash::layout-manager>
    <x-slot name="header">
        <div class="float-left font-semibold text-xl text-gray-800 leading-9">
            <span class="p-1 bg-blue-800 text-white">{{ auth()->user()->name }}</span>
            <a class="ml-2 p-1 bg-red-600 text-white" href="{{ route('backpack.auth.logout') }}">Завершить сессию</a>
        </div>
        <div class="float-right">
            @livewire('cash.working')
            @if(cache()->get(\App\Cashbox\Models\Workday::WORKDAY_ID_KEY))
                @livewire('cash.maintenance')
            @endif
        </div>
    </x-slot>
    @if(!cache()->get(\App\Cashbox\Models\Workday::WORKDAY_ID_KEY))
        <div class="bg-red-600 p-2 my-2 text-white rounded shadow text-uppercase text-2xl">
            Вам необходимо открыть рабочую смену для продолжения работы!
        </div>
    @else
        <div class="grid grid-cols-2 gap-4">
            @include('cash.components.manager-control')
            <div>
                @livewire('cash.manager')
            </div>
        </div>
    @endif
</x-cash::layout-manager>
