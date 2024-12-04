<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @include('partials.styles')

    <script src="//unpkg.com/alpinejs" defer></script>

</head>

<body>

    <div class="font-sans text-gray-900 antialiased">

        <div class="container">

            @yield('content')

        </div>

    </div>

    <div class="mt-16">

        @include('partials.footer')
    
    </div>

    @include('partials.message-bag')

</body>

</html>