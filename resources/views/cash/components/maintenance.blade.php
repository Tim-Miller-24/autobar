@if($status)
    <button wire:click="toggle()"
            class="focus:outline-none uppercase px-8 py-2 rounded bg-red-300 text-red-600 max-w-max shadow-sm hover:shadow-lg">
        Выключить бар
    </button>
@else
    <button wire:click="toggle()"
            class="focus:outline-none uppercase px-8 py-2 rounded bg-green-300 text-green-600 max-w-max shadow-sm hover:shadow-lg">
        Включить бар
    </button>
@endif

