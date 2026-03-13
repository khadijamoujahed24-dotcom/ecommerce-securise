@extends('layouts.app')

@section('content')
<div class="container my-5">
    <div class="catalogue-header text-center mb-5">
        <h1 class="catalogue-title">Catalogue de matériel informatique</h1>
        <p class="catalogue-subtitle">
            Parcourez notre sélection de produits informatiques performants, adaptés aux usages
            professionnels, personnels et gaming.
        </p>
    </div>

    <div class="catalogue-toolbar">
        <div class="row g-3 align-items-end">
            <div class="col-md-3">
                <label class="form-label fw-semibold">Catégorie</label>
                <select class="form-select custom-filter">
                    <option selected>Toutes les catégories</option>
                    <option>Ordinateurs portables</option>
                    <option>PC Bureau</option>
                    <option>Composants</option>
                    <option>Écrans</option>
                    <option>Accessoires</option>
                </select>
            </div>

            <div class="col-md-6">
                <label class="form-label fw-semibold">Recherche</label>
                <input type="text" class="form-control custom-filter" placeholder="Rechercher un produit...">
            </div>

            <div class="col-md-3">
                <button class="btn btn-primary w-100 filter-btn">Filtrer</button>
            </div>
        </div>
    </div>

    <div class="row g-4 mt-1">
        @for ($i = 1; $i <= 8; $i++)
            <div class="col-sm-6 col-lg-3">
                <div class="catalogue-product-card h-100">
                    <div class="catalogue-product-media">
                        <img src="https://via.placeholder.com/300x220" alt="Produit {{ $i }}">
                    </div>

                    <div class="catalogue-product-body d-flex flex-column">
                        <h5 class="catalogue-product-title">Produit {{ $i }}</h5>
                        <p class="catalogue-product-desc">
                            Produit informatique de qualité, idéal pour les utilisateurs exigeants.
                        </p>

                        <div class="mt-auto">
                            <div class="catalogue-product-price">1 299 DH</div>
                            <a href="{{ url('/product/1') }}" class="btn btn-outline-primary w-100 mt-2">
                                Voir plus
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endfor
    </div>
</div>
@endsection