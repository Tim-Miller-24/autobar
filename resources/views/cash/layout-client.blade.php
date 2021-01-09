<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('packages/bootstrap/css/bootstrap.min.css') }}">

    @livewireStyles

    <!-- Scripts -->
    <script src="{{ asset('js/alpine.js') }}"></script>
    <script src="{{ asset('js/socket.io.min.js') }}"></script>
</head>
<body class="font-sans antialiased">
<div class="min-h-screen bg-gray-100">
    {{--@livewire('navigation-dropdown')--}}

    <!-- Page Heading -->
    <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
        <h5 class="my-0 mr-md-auto font-weight-normal">Company name</h5>
        <nav class="my-2 my-md-0 mr-md-3">
            <a class="p-2 text-dark" href="#">Features</a>
            <a class="p-2 text-dark" href="#">Enterprise</a>
            <a class="p-2 text-dark" href="#">Support</a>
            <a class="p-2 text-dark" href="#">Pricing</a>
        </nav>
        <a class="btn btn-outline-primary" href="#">Sign up</a>
    </div>
    {{--<header class="bg-white shadow">--}}
        {{--<div class="max-w-7xl mx-auto py-4 px-3 sm:px-6 lg:px-8">--}}
            {{--<nav class="flex items-center justify-between flex-wrap">--}}
                {{--<div class="w-full block flex-grow lg:flex lg:items-center lg:w-auto">--}}
                    {{--<div class="text-sm lg:flex-grow">--}}
                        {{--{{ $header }}--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</nav>--}}
        {{--</div>--}}
    {{--</header>--}}

    <!-- Page Content -->
    <main>
        {{ $slot }}
    </main>
</div>
@include('cash.components.flash')
@include('cash.components.client-sounds')
@stack('modals')

@livewireScripts
<script src="{{ asset('js/client.js') }}"></script>
<script src="{{ asset('packages/bootstrap/js/jquery-3.5.1.min.js') }}"></script>
<script src="{{ asset('packages/bootstrap/js/popper.min.js') }}"></script>
<script src="{{ asset('packages/bootstrap/js/bootstrap.min.js') }}"></script>
</body>
</html>
