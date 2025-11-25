<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Preload critical resources -->
    <link rel="preload" href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css" as="style">
    <link rel="preload" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css" as="style">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <!-- Load CSS -->
    <link href="{{ asset('css/portal.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css" rel="stylesheet">
    <link href="https://unpkg.com/boxicons@latest/css/boxicons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;500;600;700&display=swap" rel="stylesheet">

    <title>@yield('title', 'ibnTofail University')</title>
</head>
<body>
    @include('components.header')
        <div class="header-spacer"></div> <!-- New spacer element -->

        <main>
            @yield('breadcrumbs')
        </main>
    <main class="main-content">
        @yield('content')
    </main>

    {{-- <div class="footer-spacer"></div> <!-- New spacer element --> --}}
    @include('components.footer')


    @stack('scripts')
</body>
</html>
