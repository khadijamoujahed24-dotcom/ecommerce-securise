@extends('layouts.app')

@section('content')
<div class="container my-5">
    <div class="text-center mb-5">
        <h1 class="catalog-title">{{ $category->name }}</h1>
        <p class="catalog-subtitle">
            {{ $category->description }}
        </p>
    </div>

    <div class="row g-4">
        @forelse($products as $product)
            <div class="col-sm-6 col-lg-3">
                <div class="card catalog-product-card h-100">
                    <div class="catalog-product-media">
                        @php
                            $productImage = asset('images/products/' . ($product->image ?? 'default.jpg'));
                            $productFallback = asset('images/products/default.jpg');
                        @endphp

                        <img
                            src="{{ $productImage }}"
                            alt="{{ $product->name }}"
                            onerror="this.onerror=null; this.src='{{ $productFallback }}';"
                        >
                    </div>

                    <div class="catalog-product-body d-flex flex-column">
                        <h5 class="catalog-product-title">{{ $product->name }}</h5>

                        <p class="catalog-product-description">
                            {{ \Illuminate\Support\Str::limit($product->description, 80) }}
                        </p>

                        <p class="catalog-product-price mt-auto">
                            {{ number_format($product->price, 2) }} MAD
                        </p>

                        <a href="{{ route('cart.add', $product->id) }}" class="btn btn-primary catalog-btn">
                            Ajouter au panier
                        </a>

                        <a href="{{ route('products.show', $product->id) }}" class="btn btn-outline-secondary catalog-btn catalog-btn-secondary">
                            Voir le produit
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center">
                <div class="alert alert-info">
                    Aucun produit n’est disponible dans cette catégorie.
                </div>
            </div>
        @endforelse
    </div>

    <div class="d-flex justify-content-center mt-4">
        {{ $products->links() }}
    </div>
</div>
@endsection