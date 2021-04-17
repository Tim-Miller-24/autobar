@if($status)
    <button onclick="endWorkConfirm()" wire:click="toggle()"
            class="focus:outline-none uppercase px-8 py-2 border border-red-600 bg-red-300 text-red-600 max-w-max shadow-sm hover:shadow-lg">
        Закрыть смену
    </button>
@else
    <button wire:click="toggle()"
            class="focus:outline-none uppercase px-8 py-2 border border-green-600 bg-green-300 text-green-600 max-w-max shadow-sm hover:shadow-lg">
        Открыть смену
    </button>
@endif

<script>
    function endWorkConfirm() {
        confirm("Вы уверены, что хотите завершить смену?");
    }
</script>