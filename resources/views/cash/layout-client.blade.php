<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/jquery.modal.css') }}" />

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;700&display=swap" rel="stylesheet">

    @livewireStyles

    <!-- Scripts -->
    <script src="{{ asset('js/alpine.js') }}" defer></script>
    <script src="{{ asset('js/socket.io.min.js') }}"></script>
</head>
<body class="font-sans antialiased bg-primary">

<div class="grid grid-cols-12 h-screen">
    <div class="col-span-2 bg-secondary shadow-inner border-r border-primary">
        @livewire('cash.category-list')
    </div>
    <div class="col-span-8 overflow-hidden">
        {{ $slot }}
    </div>
    <div class="col-span-2 bg-secondary shadow-inner border-l border-primary">
        <div class="text-primary p-3 uppercase border-b border-primary">
            <span class="font-bold font-4xl">{{ trans('custom.my_order') }}</span>
            <div class="float-right">
                @livewire('cash.cart-clear')
            </div>
        </div>
        @livewire('cash.cart-mini')
    </div>
</div>

@include('cash.components.flash')
@include('cash.components.client-sounds')
@stack('modals')

@livewireScripts
<script src="{{ asset('packages/bootstrap/js/jquery-3.5.1.min.js') }}"></script>
<script src="{{ asset('js/jquery.modal.min.js') }}"></script>
<script src="{{ asset('js/client.js?v=0.1') }}"></script>
</body>
</html>
