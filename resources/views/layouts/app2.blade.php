<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'ibnTofail University')</title>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <link href="https://unpkg.com/boxicons@latest/css/boxicons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="{{ asset('css/portal.css') }}" rel="stylesheet">
    <style>
        :root {
            --bg-color: #34197e;
            --text-color: #fff;
            --main-color: #ffffff;
            --success-color: #28a745;
            --danger-color: #dc3545;
            --secondary-color: #6c757d;
        }

        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            background-color: #000;
            color: var(--text-color);
            margin: 0;
            font-family: 'Poppins', sans-serif;
        }

        .main-content {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .form-container-wrapper {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            padding: 2rem;
            width: 100%;
        }

        #loadingScreen {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.95);
            display: none;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            z-index: 9999;
        }
    </style>
</head>
<body>
    @include('components.header')
    <div class="header-spacer"></div>

    <main class="main-content">
        <div class="form-container-wrapper">
            @yield('content')
        </div>
    </main>

    @include('components.footer')
    @stack('scripts')
</body>
</html>
