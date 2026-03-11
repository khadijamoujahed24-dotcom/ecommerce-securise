<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>{{ $title ?? 'TechStore' }}</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" href="{{ asset('css/home.css') }}">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

</head>

<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg custom-navbar">
    <div class="container">

        <a class="navbar-brand custom-brand d-flex align-items-center gap-2" href="{{ route('home') }}">
           <img src="{{ asset('images/logo.png') }}" width="40">
            TechStore
       </a>

        <button class="navbar-toggler custom-toggler" type="button"
            data-bs-toggle="collapse"
            data-bs-target="#mainNavbar">

            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="mainNavbar">

            <ul class="navbar-nav mx-auto">

                <li class="nav-item">
                    <a class="nav-link custom-link" href="{{ route('home') }}">
                        Accueil
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link custom-link" href="{{ route('products.catalogue') }}">
                        Catalogue
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link custom-link" href="{{ route('cart.index') }}">
                        Panier
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link custom-link" href="{{ route('checkout') }}">
                        Checkout
                    </a>
                </li>

            </ul>

            <div class="d-flex gap-2">

                @guest

                <a href="{{ route('login') }}" class="btn btn-outline-light nav-btn">
                    Connexion
                </a>

                <a href="{{ route('register') }}" class="btn btn-primary nav-btn">
                    Inscription
                </a>

                @else

                <a href="{{ route('dashboard') }}" class="btn btn-outline-light nav-btn">
                    Mon compte
                </a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="btn btn-primary nav-btn">
                        Déconnexion
                    </button>
                </form>

                @endguest

            </div>

        </div>
    </div>
</nav>


<!-- CONTENU -->
<main>
    @yield('content')
</main>


<!-- FOOTER -->
<footer class="site-footer">

<div class="container">

<div class="row">

<div class="col-md-4">

<h5 class="footer-brand">
Boutique Informatique
</h5>

<p class="footer-text">
Votre destination pour du matériel informatique fiable,
moderne et performant.
</p>

</div>


<div class="col-md-4">

<h6 class="footer-title">
Contact
</h6>

<p class="footer-text">
+212 6 12 34 56 78
</p>

<p class="footer-text">
email@example.com
</p>

<p class="footer-text">
Chefchaouen, Maroc
</p>

</div>


<div class="col-md-2">

<h6 class="footer-title">
Liens utiles
</h6>

<ul class="footer-list list-unstyled">

<li>
<a href="{{ route('home') }}" class="footer-link">
Accueil
</a>
</li>

<li>
<a href="{{ route('products.catalogue') }}" class="footer-link">
Catalogue
</a>
</li>

<li>
<a href="{{ route('dashboard') }}" class="footer-link">
Mon compte
</a>
</li>

</ul>

</div>


<div class="col-md-2">

<h6 class="footer-title">
Informations
</h6>

<ul class="footer-list list-unstyled">

<li>
<a href="#" class="footer-link">
Politique de confidentialité
</a>
</li>

<li>
<a href="#" class="footer-link">
Conditions générales
</a>
</li>

<li>
<a href="#" class="footer-link">
Aide et support
</a>
</li>

</ul>

</div>

</div>


<hr class="footer-divider">


<div class="footer-bottom">
© {{ date('Y') }} Boutique Informatique.
Tous droits réservés.
</div>

</div>

</footer>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>