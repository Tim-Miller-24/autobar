@if($status)
    <button onclick="endWorkConfirm()" wire:click="close()"
            class="focus:outline-none uppercase px-6 py-2 border bg-white text-black shadow-sm hover:shadow-lg">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
        </svg>
        Закрыть смену
    </button>
@else
    <button wire:click="open()"
            class="focus:outline-none uppercase px-6 py-2 border border-blue-600 bg-blue-300 text-blue-600 shadow-sm hover:shadow-lg">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 11V7a4 4 0 118 0m-4 8v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2z" />
        </svg>
        Открыть смену
    </button>
@endif

<script>
    function endWorkConfirm() {
        confirm("Вы уверены, что хотите завершить смену?");
    }
</script>