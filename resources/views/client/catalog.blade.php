@extends('layouts.app')

@section('content')
<div class="catalog-page">
    <div class="container">
        <div class="catalog-header">
            <h1 class="catalog-title">Catalogue de matériel informatique</h1>
            <p class="catalog-subtitle">
                Parcourez notre sélection de produits informatiques performants, adaptés aux usages professionnels,
                personnels et gaming.
            </p>
        </div>

        <div class="catalog-categories">
            <div class="catalog-categories-title">Catégories :</div>

            <a href="{{ route('products.catalogue') }}"
               class="catalog-category-link {{ request('category') ? '' : 'active-category' }}">
                Tous
            </a>

            @foreach($categories as $category)
                <a href="{{ route('products.catalogue', ['category' => $category->id]) }}"
                   class="catalog-category-link {{ request('category') == $category->id ? 'active-category' : '' }}">
                    {{ $category->name }}
                </a>
            @endforeach
        </div>

        <div class="row">
            @forelse($products as $product)
                <div class="col-sm-6 col-lg-3 mb-4">
                    <div class="card catalog-product-card h-100">
                        <div class="catalog-product-media">
                            <div class="catalog-product-media-inner">
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
                        </div>

                        <div class="catalog-product-body d-flex flex-column">
                            <h5 class="catalog-product-title">{{ $product->name }}</h5>

                            <p class="catalog-product-description">
                                {{ $product->description }}
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
                    <p>Aucun produit trouvé pour cette catégorie.</p>
                </div>
            @endforelse
        </div>

        <div class="d-flex justify-content-center catalog-pagination">
            {{ $products->links() }}
        </div>
    </div>
</div>
@endsection