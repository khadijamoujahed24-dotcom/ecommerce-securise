@extends('layouts.app')

@section('content')
<div class="container my-5">
    <div class="row g-5 align-items-center">
        <div class="col-md-6">
            @php
                $productImage = asset('images/products/' . ($product->image ?? 'default.jpg'));
                $productFallback = asset('images/products/default.jpg');
            @endphp

            <div class="catalog-product-media">
                <img
                    src="{{ $productImage }}"
                    alt="{{ $product->name }}"
                    onerror="this.onerror=null; this.src='{{ $productFallback }}';"
                >
            </div>
        </div>

        <div class="col-md-6">
            <h1 class="mb-3">{{ $product->name }}</h1>

            <p class="text-muted fs-5">
                {{ $product->description }}
            </p>

            <p class="fw-bold fs-3 text-primary">
                {{ number_format($product->price, 2) }} MAD
            </p>

            <p>
                <strong>Stock :</strong> {{ $product->stock }}
            </p>

            @if($product->category)
                <p>
                    <strong>Catégorie :</strong> {{ $product->category->name }}
                </p>
            @endif

            <div class="d-flex gap-3 mt-4">
                <a href="{{ route('cart.add', $product->id) }}" class="btn btn-primary">
                    Ajouter au panier
                </a>

                <a href="{{ route('products.catalogue') }}" class="btn btn-outline-secondary">
                    Retour au catalogue
                </a>
            </div>
        </div>
    </div>
</div>
@endsection