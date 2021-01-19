<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    @livewireStyles

    <!-- Scripts -->
    <script src="{{ asset('js/alpine.js') }}"></script>
    <script src="{{ asset('js/socket.io.min.js') }}"></script>
</head>
<body class="font-sans antialiased">
<div class="min-h-screen bg-gray-100">
    {{--@livewire('navigation-dropdown')--}}

    <!-- Page Heading -->
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-4 px-3 sm:px-6 lg:px-8">
            <nav class="flex items-center justify-between flex-wrap">
                <div class="w-full block flex-grow lg:flex lg:items-center lg:w-auto">
                    <div class="text-sm lg:flex-grow">
                        {{ $header }}
                    </div>
                    {{--@livewire('cash.cart-mini')--}}
                </div>
            </nav>
        </div>
    </header>

    <!-- Page Content -->
    <main>
        <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            {{ $slot }}
        </div>
    </main>
</div>
@include('cash.components.flash')
@include('cash.components.manager-sounds')
@stack('modals')

@livewireScripts
<script src="{{ asset('js/manager.js') }}"></script>
</body>
</html>
