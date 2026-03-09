@extends('layouts.app')

@section('content')
<div class="container my-5">
    <div class="row g-5">
        <div class="col-md-6">
            <div class="card p-3">
                <img src="https://via.placeholder.com/600x450" class="img-fluid rounded" alt="Produit">
            </div>
        </div>

        <div class="col-md-6">
            <h1>PC Portable ASUS Gaming</h1>
            <p class="text-muted">Catégorie : Ordinateurs portables</p>
            <h3 class="text-primary fw-bold mb-3">8 999 DH</h3>

            <p>
                Ce PC portable gaming offre d’excellentes performances grâce à son processeur puissant,
                sa carte graphique dédiée et son écran haute résolution.
            </p>

            <ul class="list-group mb-4">
                <li class="list-group-item">Processeur : Intel Core i7</li>
                <li class="list-group-item">Mémoire RAM : 16 Go</li>
                <li class="list-group-item">Stockage : SSD 512 Go</li>
                <li class="list-group-item">Carte graphique : RTX 4060</li>
            </ul>

            <form action="#" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Quantité</label>
                    <input type="number" class="form-control w-25" value="1" min="1">
                </div>
                <button type="submit" class="btn btn-success me-2">Ajouter au panier</button>
                <a href="{{ url('/catalogue') }}" class="btn btn-secondary">Retour au catalogue</a>
            </form>
        </div>
    </div>
</div>
@endsection