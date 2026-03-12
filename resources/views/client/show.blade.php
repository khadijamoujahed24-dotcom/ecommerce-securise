@extends('layouts.app')

@section('content')
<div class="container my-4">
    <div class="row">
        <div class="col-md-6">
            @if($product->image)
                <img src="{{ asset('storage/' . $product->image) }}" class="img-fluid" alt="{{ $product->name }}">
            @else
                <img src="{{ asset('images/no-image.png') }}" class="img-fluid" alt="Pas d'image">
            @endif
        </div>
        <div class="col-md-6">
            <h2>{{ $product->name }}</h2>
            <p><strong>Catégorie : </strong>{{ $product->category->name ?? '-' }}</p>
            <p>{{ $product->description }}</p>
            <p><strong>Prix : </strong>{{ $product->price }} MAD</p>
            <a href="{{ route('cart.add', $product->id) }}" class="btn btn-primary">Ajouter au panier</a>
        </div>
    </div>
</div>
@endsection