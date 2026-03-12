@extends('layouts.app')

@section('content')
<div class="container my-5">
    <h1>Détails du produit</h1>

    <div class="card p-4">
        <h4>{{ $product->name }}</h4>
        <p><strong>Catégorie :</strong> {{ $product->category->name ?? '—' }}</p>
        <p><strong>Prix :</strong> {{ $product->price }} DH</p>
        <p><strong>Stock :</strong> {{ $product->stock }}</p>
        <p><strong>Description :</strong> {{ $product->description }}</p>
        <a href="{{ route('admin.products.index') }}" class="btn btn-primary">Retour</a>
    </div>
</div>
@endsection