<x-cash::layout-client>
    <x-slot name="header">
    </x-slot>
    <div class="jquery-modal blocker current">
        <div class="modal bg-red-600" style="display: inline-block;">
            <div class="p-5">
                <div class="text-5xl font-semibold text-white leading-none">{{ trans('custom.maintenance.title') }}</div>
                <div class="mt-1 text-2xl font-light text-white antialiased">{{ trans('custom.maintenance.text') }}</div>
            </div>
        </div>
    </div>
</x-cash::layout-client>
