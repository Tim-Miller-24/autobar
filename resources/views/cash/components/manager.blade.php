<x-slot name="header">
    <div class="float-left font-semibold text-xl text-gray-800 leading-9">
        <span class="p-1 bg-blue-800 text-white">{{ auth()->user()->name }}</span>
        <a class="ml-2 p-1 bg-red-600 text-white" href="{{ route('backpack.auth.logout') }}">Завершить сессию</a>
    </div>
    <div class="float-right">
        @livewire('cash.maintenance')
    </div>
</x-slot>
@foreach($orders as $order)
    @include('cash.components.manager-summary')
@endforeach