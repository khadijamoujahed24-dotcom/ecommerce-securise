@extends('layouts.app')

@section('content')
<div class="container my-4">
    <h1 class="mb-4">Catalogue de matériel informatique</h1>

    <!-- filtres par catégorie -->
    <div class="mb-3">
        <strong>Catégories : </strong>
        @foreach($categories as $category)
            <a href="#" class="btn btn-outline-primary btn-sm mb-1">{{ $category->name }}</a>
        @endforeach
    </div>

    <!-- affichage des produits -->
    <div class="row">
        @foreach($products as $product)
        <div class="col-md-3 mb-4">
            <div class="card h-100">
                @if($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}">
                @else
                    <img src="{{ asset('images/no-image.png') }}" class="card-img-top" alt="Pas d'image">
                @endif
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title">{{ $product->name }}</h5>
                    <p class="card-text text-truncate">{{ $product->description }}</p>
                    <p class="mt-auto"><strong>{{ $product->price }} MAD</strong></p>
                    <a href="{{ route('cart.add', $product->id) }}" class="btn btn-primary btn-block mt-2">Ajouter au panier</a>
                    <a href="{{ route('product.show', $product->id) }}" class="btn btn-outline-secondary btn-block mt-1">Voir le produit</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- pagination -->
    <div class="d-flex justify-content-center mt-4">
        {{ $products->links() }}
    </div>
</div>
@endsection