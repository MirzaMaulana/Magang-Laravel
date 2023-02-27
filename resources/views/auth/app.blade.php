<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Bootcamp') }}</title>
    <link rel="shortcut icon"
        href="https://th.bing.com/th/id/R.6a3be7a14421b455fd2992a009f510d5?rik=V7GsriayJZF7qg&riu=http%3a%2f%2fpluspng.com%2fimg-png%2fcoder-png-coder-coding-computer-developer-encoder-engineer-programmer-icon-512.png&ehk=IwYpx%2bWn%2fTCk8nxjcNysD6EX175ypYlXItQEru5CEKA%3d&risl=&pid=ImgRaw&r=0"
        type="image/x-icon" />
    <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab&family=Tilt+Neon&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
    <div id="app">
        @include('index.navbar')

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>

</html>
