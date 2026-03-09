@extends('layouts.app')

@section('content')
<div class="container my-5">
    <h1 class="mb-4">Catalogue des produits</h1>

    <div class="row mb-4">
        <div class="col-md-3">
            <select class="form-select">
                <option selected>Choisir une catégorie</option>
                <option>Ordinateurs portables</option>
                <option>PC Bureau</option>
                <option>Composants</option>
                <option>Écrans</option>
                <option>Accessoires</option>
            </select>
        </div>

        <div class="col-md-6">
            <input type="text" class="form-control" placeholder="Rechercher un produit...">
        </div>

        <div class="col-md-3">
            <button class="btn btn-primary w-100">Filtrer</button>
        </div>
    </div>

    <div class="row g-4">
        @for ($i = 1; $i <= 8; $i++)
            <div class="col-md-3">
                <div class="card product-card h-100">
                    <img src="https://via.placeholder.com/300x220" class="card-img-top" alt="Produit">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">Produit {{ $i }}</h5>
                        <p class="card-text text-muted">Produit informatique de qualité, idéal pour les utilisateurs exigeants.</p>
                        <p class="fw-bold text-primary mt-auto">1 299 DH</p>
                        <a href="{{ url('/product/1') }}" class="btn btn-outline-primary mt-2">Voir plus</a>
                    </div>
                </div>
            </div>
        @endfor
    </div>
</div>
@endsection