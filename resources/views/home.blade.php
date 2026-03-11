@extends('layouts.app')

@section('content')
    {{-- HERO --}}
    <section class="home-hero">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-7">
                    <span class="hero-badge">Performance • Fiabilité • Innovation</span>

                    <div class="mb-3">
                        <img src="{{ asset('images/hero.png') }}" alt="Logo Boutique Informatique" class="hero-logo">
                    </div>

                    <h1 class="hero-title">
                        Le meilleur du matériel informatique pour vos besoins quotidiens et professionnels
                    </h1>

                    <p class="hero-text">
                        Découvrez une sélection moderne d’ordinateurs, composants, périphériques et équipements réseau,
                        pensée pour offrir performance, qualité et sécurité d’achat.
                    </p>

                    <div class="hero-actions">
                        <a href="{{ route('products.catalogue') }}" class="btn btn-primary btn-lg px-4">
                            Voir les produits
                        </a>

                        <a href="{{ route('categories.index') }}" class="btn btn-outline-light btn-lg px-4">
                            Explorer les catégories
                        </a>
                    </div>

                    <div class="hero-stats">
                        <div class="hero-stat">
                            <strong>+200</strong>
                            <span>Produits disponibles</span>
                        </div>
                        <div class="hero-stat">
                            <strong>+15</strong>
                            <span>Catégories</span>
                        </div>
                        <div class="hero-stat">
                            <strong>24/7</strong>
                            <span>Disponibilité en ligne</span>
                        </div>
                    </div>
                </div>

                <div class="col-lg-5">
                    <div class="hero-visual">
                        <img src="{{ asset('images/banner.jpg') }}" alt="Matériel informatique" class="img-fluid rounded-4 shadow-lg">
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- CATEGORIES --}}
    <section class="section-block bg-light">
        <div class="container">
            <div class="section-heading text-center">
                <h2>Nos catégories</h2>
                <p>
                    Explorez nos principales catégories de matériel informatique, sélectionnées pour répondre
                    aux besoins personnels, académiques et professionnels.
                </p>
            </div>

            <div class="row g-4">
                @foreach($categories->take(6) as $category)
                    <div class="col-md-6 col-lg-4">
                        <div class="category-card h-100 position-relative">
                            <div class="category-media">
                                <img src="{{ asset('images/categories/' . $category->id . '.jpg') }}"
                                     alt="{{ $category->name }}">
                            </div>

                            <div class="category-body">
                                <h5>{{ $category->name }}</h5>
                                <p>
                                    {{ $category->description ?? 'Découvrez les produits de cette catégorie et accédez rapidement aux références les plus recherchées.' }}
                                </p>
                                <a href="{{ route('products.catalogue', ['category' => $category->id]) }}" class="stretched-link text-decoration-none">
                                    <span class="visually-hidden">Voir la catégorie {{ $category->name }}</span>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- FEATURED PRODUCTS --}}
    <section class="section-block">
        <div class="container">
            <div class="section-heading text-center">
                <h2>Produits vedettes</h2>
                <p>
                    Une sélection de produits phares choisis pour leur qualité, leur fiabilité
                    et leur excellent rapport qualité-prix.
                </p>
            </div>

            <div class="row g-4">
                @foreach($featuredProducts as $product)
                    <div class="col-sm-6 col-lg-3">
                        <div class="product-card h-100">
                            <div class="product-media">
                                <img src="{{ asset('images/products/' . $product->image) }}"
                                     alt="{{ $product->name }}">
                            </div>

                            <div class="product-body d-flex flex-column">
                                <h5 class="product-title">{{ $product->name }}</h5>

                                <p class="product-desc">
                                    {{ \Illuminate\Support\Str::limit($product->description, 90) }}
                                </p>

                                <div class="product-meta mt-auto">
                                    <div class="product-price">
                                        {{ number_format($product->price, 2) }} MAD
                                    </div>

                                    <div class="d-grid gap-2">
                                        <a href="{{ route('cart.add', $product->id) }}" class="btn btn-primary">
                                            Ajouter au panier
                                        </a>
                                        <a href="{{ route('products.show', $product->id) }}" class="btn btn-outline-secondary">
                                            Voir le produit
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="text-center mt-4">
                <a href="{{ route('products.catalogue') }}" class="btn btn-dark px-4">
                    Voir tout le catalogue
                </a>
            </div>
        </div>
    </section>

    {{-- WHY CHOOSE US --}}
    <section class="section-block bg-light">
        <div class="container">
            <div class="section-heading text-center">
                <h2>Pourquoi nous choisir ?</h2>
                <p>
                    Nous mettons à votre disposition des produits fiables, un service de qualité
                    et une expérience d’achat pensée pour la simplicité et la sécurité.
                </p>
            </div>

            <div class="row g-4">
                <div class="col-md-6 col-lg-3">
                    <div class="why-card h-100">
                        <div class="why-icon">
                            <i class="bi bi-truck"></i>
                        </div>
                        <h5>Livraison rapide</h5>
                        <p>Recevez vos commandes dans les meilleurs délais avec un suivi clair et efficace.</p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3">
                    <div class="why-card h-100">
                        <div class="why-icon">
                            <i class="bi bi-shield-check"></i>
                        </div>
                        <h5>Paiement sécurisé</h5>
                        <p>Profitez d’un processus de commande sécurisé pour acheter en toute confiance.</p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3">
                    <div class="why-card h-100">
                        <div class="why-icon">
                            <i class="bi bi-headset"></i>
                        </div>
                        <h5>Support client</h5>
                        <p>Notre équipe reste disponible pour vous accompagner avant et après l’achat.</p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3">
                    <div class="why-card h-100">
                        <div class="why-icon">
                            <i class="bi bi-award"></i>
                        </div>
                        <h5>Qualité garantie</h5>
                        <p>Nous sélectionnons des équipements performants et durables pour mieux vous servir.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection