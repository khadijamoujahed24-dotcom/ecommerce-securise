@extends('layouts.app')

@section('content')
<div class="hero-section">
    <div class="container text-center">
        <h1 class="display-4 fw-bold">Bienvenue sur TechStore</h1>
        <p class="lead mt-3">
            Découvrez les meilleurs équipements informatiques : PC, composants, écrans, accessoires et gaming.
        </p>
        <a href="{{ url('/catalogue') }}" class="btn btn-light btn-lg mt-3">Voir le catalogue</a>
    </div>
</div>

<div class="container my-5">
    <h2 class="section-title text-center">Nos catégories</h2>
    <div class="row g-4">
        <div class="col-md-3">
            <div class="card p-4 text-center">
                <h5>Ordinateurs portables</h5>
                <p>Des laptops performants pour travail et gaming.</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card p-4 text-center">
                <h5>Composants PC</h5>
                <p>Cartes graphiques, processeurs, RAM et plus.</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card p-4 text-center">
                <h5>Périphériques</h5>
                <p>Claviers, souris, casques et webcams.</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card p-4 text-center">
                <h5>Gaming</h5>
                <p>Tout l’univers pour les passionnés de jeux vidéo.</p>
            </div>
        </div>
    </div>
</div>

<div class="container my-5">
    <h2 class="section-title text-center">Produits en vedette</h2>
    <div class="row g-4">
        @for ($i = 1; $i <= 4; $i++)
            <div class="col-md-3">
                <div class="card product-card">
                    <img src="https://via.placeholder.com/300x220" class="card-img-top" alt="Produit">
                    <div class="card-body">
                        <h5 class="card-title">Produit {{ $i }}</h5>
                        <p class="card-text text-muted">Description courte du produit informatique.</p>
                        <p class="fw-bold text-primary">999 DH</p>
                        <a href="{{ url('/product/1') }}" class="btn btn-primary w-100">Voir détail</a>
                    </div>
                </div>
            </div>
        @endfor
    </div>
</div>
@endsection