<x-cash::layout-manager>
    <div class="grid grid-cols-2 gap-4">
        @include('cash.components.manager-control')
        <div>
            @livewire('cash.manager')
        </div>
    </div>
</x-cash::layout-manager>
