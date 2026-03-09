<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'TechStore' }}</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .navbar-brand {
            font-weight: bold;
            font-size: 1.4rem;
        }

        .hero-section {
            background: linear-gradient(135deg, #0d6efd, #0a58ca);
            color: white;
            padding: 80px 0;
            border-radius: 0 0 20px 20px;
        }

        .product-card img {
            height: 220px;
            object-fit: cover;
        }

        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.06);
        }

        .btn {
            border-radius: 10px;
        }

        footer {
            margin-top: 60px;
            background: #212529;
            color: white;
            padding: 20px 0;
        }

        .section-title {
            font-weight: bold;
            margin-bottom: 25px;
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">TechStore</a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="mainNavbar">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link" href="{{ url('/') }}">Accueil</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('/catalogue') }}">Catalogue</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('/cart') }}">Panier</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('/checkout') }}">Checkout</a></li>
                </ul>

                <div class="d-flex gap-2">
                    <a href="{{ url('/login') }}" class="btn btn-outline-light btn-sm">Connexion</a>
                    <a href="{{ url('/register') }}" class="btn btn-primary btn-sm">Inscription</a>
                </div>
            </div>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

    <footer>
        <div class="container text-center">
            <p class="mb-0">© {{ date('Y') }} TechStore - Boutique de matériel informatique</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
