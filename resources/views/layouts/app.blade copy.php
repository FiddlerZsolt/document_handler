<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $title ? $title : "Document handler" }}</title>

        <!-- Scripts -->
        @vite([
            'resources/css/reset.css',
            'resources/css/app.min.css',
            'resources/js/app.js'
        ])
    </head>
    <body>
        <header>
            @include('layouts.navigation')
        </header>

        <!-- Page Content -->
        <main>
            @yield('content')
        </main>

    </body>
</html>
