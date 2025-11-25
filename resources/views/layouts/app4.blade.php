<!DOCTYPE html>
<html lang="fr">
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
    <style>
        :root {
            --bg-color: #34197e;
            --text-color: #fff;
            --main-color: #ffffff;
            --card-bg: #2a2a2a;
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

        .profile-container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem;
        }

        .profile-header {
            background: var(--bg-color);
            padding: 2rem;
            border-radius: 8px;
            margin-bottom: 2rem;
            display: flex;
            align-items: center;
            gap: 1.5rem;
        }

        .profile-avatar {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: var(--main-color);
            color: var(--bg-color);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            font-weight: bold;
        }

        .profile-info h2 {
            color: var(--main-color);
            margin: 0;
        }

        .profile-info p {
            margin: 0.5rem 0 0;
            opacity: 0.8;
        }

        .profile-card {
            background: var(--card-bg);
            border-radius: 8px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
        }

        .profile-card h3 {
            color: var(--main-color);
            margin-top: 0;
            border-bottom: 1px solid #444;
            padding-bottom: 0.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .header-spacer {
            height: 80px;
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

        @media (max-width: 768px) {
            .profile-header {
                flex-direction: column;
                text-align: center;
                padding: 1.5rem;
            }

            .profile-container {
                padding: 1rem;
            }

            .profile-card {
                padding: 1rem;
            }
        }
    </style>
</head>
<body>
    @include('components.header')
    <div class="header-spacer"></div>

    <main class="main-content">
        @yield('content')
    </main>

    @include('components.footer')
    @stack('scripts')
</body>
</html>
