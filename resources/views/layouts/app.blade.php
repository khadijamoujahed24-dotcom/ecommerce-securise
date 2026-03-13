<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'TechStore' }}</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-dark custom-navbar shadow-sm">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center gap-2 fw-bold" href="{{ route('home') }}">
                <img src="{{ asset('images/logo.png') }}" alt="Logo TechStore" class="navbar-logo">
                <span>TechStore</span>
            </a>

            <button
                class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#mainNavbar"
                aria-controls="mainNavbar"
                aria-expanded="false"
                aria-label="Basculer la navigation"
            >
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="mainNavbar">
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">Accueil</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('products.catalogue') }}">Catalogue</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('cart.index') }}">Panier</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('checkout') }}">Checkout</a>
                    </li>
                </ul>

                <div class="d-flex gap-2">
                    @guest
                        <a href="{{ route('login') }}" class="btn btn-outline-light btn-sm px-3">
                            Connexion
                        </a>
                        <a href="{{ route('register') }}" class="btn btn-primary btn-sm px-3">
                            Inscription
                        </a>
                    @endguest

                    @auth
                        <a href="{{ route('dashboard') }}" class="btn btn-outline-light btn-sm px-3">
                            Mon compte
                        </a>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="btn btn-primary btn-sm px-3">
                                Déconnexion
                            </button>
                        </form>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- CONTENU -->
    <main>
        @yield('content')
    </main>
    <footer class="site-footer">
    <div class="container text-center">
        <p>© {{ date('Y') }} TechStore - Boutique de matériel informatique</p>
    </div>
    </footer>

    <!-- SCRIPTS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>