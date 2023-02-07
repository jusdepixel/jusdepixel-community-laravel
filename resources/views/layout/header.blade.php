<header>
    <nav
        id="main-navbar"
        class="navbar navbar-expand-lg navbar-dark bg-primary"
    >
        <div class="container">
            <a href="{{ route('home@process') }}" class="navbar-brand">
                <img src="{{ asset('logo.png') }}" alt="Jusdepixel Community" width="300">
            </a>

            <ul class="navbar-nav d-flex">
                @if($profile->isAuthenticated)
                    <li class="nav-item">
                        <span class="nav-link">
                            <i class="bi bi-person-fill"></i>
                            {{ $profile->username }}
                        </span>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('me@process') }}" class="btn btn-sm btn-info">
                            <i class="bi bi-instagram"></i> Mes posts
                        </a>
                    </li>
                    <li class="nav-item me-0">
                        <a href="{{ route('logout@process') }}" class="btn btn-sm btn-secondary">
                            <i class="bi bi-door-closed"></i> Déconnexion
                        </a>
                    </li>
                @else
                    <li class="nav-item me-0">
                        <a href="{{ $authorizeUrl }}" class="btn btn-sm btn-info">
                            <i class="bi bi-instagram"></i> Connexion Instagram
                        </a>
                    </li>
                @endif
            </ul>
        </div>
    </nav>
</header>
