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

    @livewireStyles

    <!-- Scripts -->
    <script src="{{ asset('js/alpine.js') }}" defer></script>
    <script src="{{ asset('js/socket.io.min.js') }}"></script>
</head>
<body class="font-sans antialiased">
{{--<div class="min-h-screen bg-gradient-to-b from-blue-900 via-indigo-900 to-purple-900">--}}
<div class="min-h-screen easy-bg">
{{--@livewire('navigation-dropdown')--}}
    <div class="max-w-7xl ml-auto">
        <!-- Page Heading -->
        <header class="-ml-20 mb-4">
            <nav class="flex justify-between">
                <div class="w-full block flex-grow">
                    {{ $header }}
                </div>
            </nav>
        </header>

        <!-- Page Content -->
        <main class="w-full -ml-20">
            {{ $slot }}
        </main>
    </div>
</div>
@include('cash.components.flash')
@include('cash.components.client-sounds')
@stack('modals')

@livewireScripts
<script src="{{ asset('packages/bootstrap/js/jquery-3.5.1.min.js') }}"></script>
<script src="{{ asset('js/jquery.modal.min.js') }}"></script>
<script src="{{ asset('js/client.js') }}"></script>
</body>
</html>
