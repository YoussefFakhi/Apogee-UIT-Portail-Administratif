<div class="header-wrapper">
    <header class="main-header">
        <a href="{{ url('/') }}" class="university-logo">
            <i class="ri-book-2-fill"></i>
            <span>ibnTofail University</span>
        </a>

        <ul class="navbar">
            <li>
                @auth
                    <a href="{{ url('/profile') }}" class="active">{{ Auth::user()->name }}</a>
                @else
                    <a href="{{ url('/login') }}" class="active">Guest</a>
                @endauth
            </li>




            <li><a href="#"><i class="ri-safari-line"></i>Dashboard</a></li>
            <li><a href="{{ route('profile') }}"><i class="ri-user-3-line"></i>Profile</a></li>
            <li class="dropdown">
                <div class="demandes-dropdown">
                    <i class="ri-wallet-2-line"></i>
                    <select class="demandes-select" onchange="if(this.value !== '#') window.location.href = this.value">
                        <option value="" selected disabled>Mes Demandes</option>
                        @auth
                            @forelse(auth()->user()->activities()->latest()->take(5)->get() as $activity)
                                <option value="{{ route('profile') }}#activity-{{ $activity->id }}">
                                    {{ $activity->description }} - {{ $activity->created_at->format('d/m H:i') }}
                                </option>
                            @empty
                                <option value="#">Aucune activité récente</option>
                            @endforelse
                            @if(auth()->user()->activities()->count() > 0)
                                <option value="{{ route('profile') }}">Voir toutes les activités</option>
                            @endif
                        @else
                            <option value="{{ route('login') }}">Connectez-vous</option>
                        @endauth
                    </select>
                </div>
            </li>


                        {{-- Add Admin Link --}}
            @auth
                @if(auth()->user()->is_admin)
                    <li><a href="{{ route('admin.dashboard') }}" style="color:rgb(255, 0, 0)"><i class="ri-admin-line"></i>Admin Panel</a></li>
                @endif
            @endauth
        </ul>

        <div class="header-right">
            <a href="{{ route('profile') }}" class="user-icon"><i class="ri-user-fill"></i></a>

            @auth
                <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="register-btn">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="register-btn">Login</a>
            @endauth

            <i class="bx bx-menu" id="menu-icon"></i>
        </div>
    </header>

    <h2 class="apogee-title">Apogée UIT | Portail Administratif</h2>
</div>

<style>
    /* Existing styles */
    .dropdown {
        position: relative;
    }

    .demandes-dropdown {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .demandes-select {
        background: transparent;
        border: none;
        color: inherit;
        font-size: inherit;
        cursor: pointer;
        padding: 5px;
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
        min-width: 200px;
    }

    .demandes-select:focus {
        outline: none;
    }

    /* New styles for options */
    .demandes-select option {
        background: #2a2a2a;
        color: white;
        padding: 10px;
        font-size: 14px;
    }

    /* Firefox specific fix */
    @-moz-document url-prefix() {
        .demandes-select {
            color: inherit;
            background-color: transparent;
            padding-right: 20px;
        }
        .demandes-select option {
            background: #2a2a2a;
            color: white;
        }
    }

    /* Style for mobile view */
    @media (max-width: 768px) {
        .demandes-select {
            width: 100%;
            background: white;
            color: black;
            border-radius: 4px;
            padding: 8px;
        }
        .demandes-select option {
            background: white;
            color: black;
        }
    }

    /* Hover effects */
    .demandes-select option:hover {
        background: var(--main-color);
    }
</style>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const menuIcon = document.querySelector('#menu-icon');
        const navbar = document.querySelector('.navbar');
        const header = document.querySelector('.header-wrapper');

        // Mobile menu toggle
        menuIcon.addEventListener('click', () => {
            menuIcon.classList.toggle('bx-x');
            navbar.classList.toggle('open');
        });

        // Close menu when clicking links
        document.querySelectorAll('.navbar a').forEach(link => {
            link.addEventListener('click', () => {
                navbar.classList.remove('open');
                menuIcon.classList.remove('bx-x');
            });
        });

        // Header shadow on scroll
        window.addEventListener('scroll', () => {
            header.classList.toggle('shadow', window.scrollY > 10);
        });

        // Better select styling for different states
        const select = document.querySelector('.demandes-select');
        if (select) {
            select.addEventListener('mouseenter', function() {
                this.style.backgroundColor = 'rgba(0,0,0,0.1)';
            });
            select.addEventListener('mouseleave', function() {
                this.style.backgroundColor = 'transparent';
            });
            select.addEventListener('focus', function() {
                this.style.backgroundColor = 'rgba(0,0,0,0.1)';
                this.style.borderRadius = '4px 4px 0 0';
            });
            select.addEventListener('blur', function() {
                this.style.backgroundColor = 'transparent';
                this.style.borderRadius = '4px';
            });
        }
    });
</script>
@endpush
