<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="vh-100">
        <div class="container d-flex justify-items-center justify-content-center">

            <div class="col-md-6 ">
                {{ $slot }}
            </div>
        </div>

    </body>
</html>
{{--<div>
     <a href="/" wire:navigate>
     <x-application-logo class="" />
     </a>
</div>--}}
