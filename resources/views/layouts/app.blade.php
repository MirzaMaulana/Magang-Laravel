<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Bootcamp') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link rel="stylesheet" href="css/style.css">
     <link rel="shortcut icon" href="https://th.bing.com/th/id/R.6a3be7a14421b455fd2992a009f510d5?rik=V7GsriayJZF7qg&riu=http%3a%2f%2fpluspng.com%2fimg-png%2fcoder-png-coder-coding-computer-developer-encoder-engineer-programmer-icon-512.png&ehk=IwYpx%2bWn%2fTCk8nxjcNysD6EX175ypYlXItQEru5CEKA%3d&risl=&pid=ImgRaw&r=0" type="image/x-icon" />
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    {{-- Admin LTE --}}
    <link rel="stylesheet" href="{{ asset('vendor/admin-lte/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}">
    @stack('styles')
</head>
<body class="sidebar-mini layout-fixed">
    <div class="wrapper">
        @include('layouts.navbar')
        @include('layouts.sidebar')
        <div class="content-wrapper">
            <section class="content-header">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </section>
        </div>
    </div>
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/admin-lte/adminlte.min.js') }}"></script>
    @stack('scripts')
</body>
</html>