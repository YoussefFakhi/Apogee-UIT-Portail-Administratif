<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') | Admin Panel</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <!-- Custom CSS -->
    <style>
        :root {
            --sidebar-bg: #1f2937;
            --sidebar-text: #f3f4f6;
            --sidebar-active: #374151;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
        }

        /* Sidebar */
        .sidebar {
            width: 250px;
            background: var(--sidebar-bg);
            color: var(--sidebar-text);
            position: fixed;
            height: 100vh;
            transition: all 0.3s;
        }

        .sidebar-brand {
            padding: 1.5rem;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }

        .sidebar-nav {
            padding: 0 1rem;
        }

        .nav-link {
            color: var(--sidebar-text);
            border-radius: 0.25rem;
            margin-bottom: 0.25rem;
            padding: 0.75rem 1rem;
        }

        .nav-link:hover, .nav-link.active {
            background: var(--sidebar-active);
            color: white;
        }

        .nav-link i {
            margin-right: 0.5rem;
        }

        /* Main Content */
        .main-content {
            margin-left: 250px;
            padding: 20px;
            min-height: 100vh;
        }

        /* Cards */
        .admin-card {
            background: white;
            border-radius: 0.5rem;
            box-shadow: 0 0.125rem 0.25rem rgba(0,0,0,0.075);
            margin-bottom: 20px;
            border: 1px solid rgba(0,0,0,0.125);
        }

        .admin-card-header {
            padding: 1rem 1.5rem;
            border-bottom: 1px solid rgba(0,0,0,0.125);
            background-color: #f8f9fa;
        }

        .admin-card-body {
            padding: 1.5rem;
        }

        /* Home Button */
        .home-btn {
            position: fixed;
            bottom: 20px;
            left: 20px;
            z-index: 1000;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                width: 70px;
                overflow: hidden;
            }

            .sidebar .nav-text {
                display: none;
            }

            .main-content {
                margin-left: 70px;
            }

            .home-btn {
                left: 10px;
                bottom: 10px;
            }
        }
    </style>
    @stack('styles')
</head>
<body>
    <div class="d-flex">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="sidebar-brand">
                <h4 class="mb-0">Admin</h4>
            </div>
            <nav class="sidebar-nav">
                <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="bi bi-speedometer2"></i>
                    <span class="nav-text">Dashboard</span>
                </a>
                <a href="{{ route('admin.users.index') }}" class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                    <i class="bi bi-people"></i>
                    <span class="nav-text">Users</span>
                </a>
                <a href="{{ route('admin.activities') }}" class="nav-link {{ request()->routeIs('admin.activities') ? 'active' : '' }}">
                    <i class="bi bi-clock-history"></i>
                    <span class="nav-text">Activities</span>
                </a>
                <a href="{{ route('admin.pdf-requests.index') }}" class="nav-link {{ request()->routeIs('admin.pdf-requests.*') ? 'active' : '' }}">
                    <i class="bi bi-file-earmark-pdf"></i>
                    <span class="nav-text">PDF Requests</span>
                </a>
            </nav>

            <!-- Home Button in Sidebar -->
            <div class="px-3 py-2">
                <a href="{{ route('home') }}" class="nav-link">
                    <i class="bi bi-house-door"></i>
                    <span class="nav-text">Accueil</span>
                </a>
            </div>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <header class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="h4 mb-0">@yield('header')</h2>
                <div class="d-flex gap-2">
                    <a href="{{ route('home') }}" class="btn btn-outline-primary btn-sm">
                        <i class="bi bi-house-door"></i> Accueil
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-outline-danger btn-sm">
                            <i class="bi bi-box-arrow-right"></i> Logout
                        </button>
                    </form>
                </div>
            </header>

            <main>
                @yield('content')
            </main>
        </div>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
