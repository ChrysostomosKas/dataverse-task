<!DOCTYPE html>
<html class="h-full bg-gray-50" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://unpkg.com/trix@2.0.0-beta.0/dist/trix.css"/>
    @stack('styles')

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    @stack('scripts')
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"
            integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
</head>
<body class="h-full overflow-hidden">
<div class="h-full flex">
    <div class="hidden w-28 bg-gray-800 overflow-y-auto md:block">
        <div class="w-full py-6 flex flex-col items-center">

            <div class="flex-1 mt-6 w-full px-2 space-y-1">
                <x-sidebar.item-list/>
            </div>
        </div>
    </div>

    <x-sidebar.mobile/>

    <!-- Content area -->
    <div class="flex-1 flex flex-col overflow-hidden">
        <x-notification/>
        <x-dash-nav/>

        <x-dash-container>

            {{ $slot }}

        </x-dash-container>
    </div>
</div>

</body>
</html>
