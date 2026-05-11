@extends('layouts.app')

@section('content')
<div class="container my-5">
    <h1 class="mb-4">Finaliser la commande</h1>

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div class="row g-4">
        <div class="col-md-7">
            <div class="card p-4 shadow-sm border-0 rounded-4">
                <h4 class="mb-3">Informations de livraison</h4>

                <form action="{{ route('order.confirm') }}" method="POST">
                    @csrf

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="full_name" class="form-label">Nom complet</label>
                            <input
                                type="text"
                                id="full_name"
                                name="full_name"
                                class="form-control"
                                placeholder="Votre nom complet"
                                value="{{ old('full_name') }}"
                                required
                            >
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="phone" class="form-label">Téléphone</label>
                            <input
                                type="text"
                                id="phone"
                                name="phone"
                                class="form-control"
                                placeholder="Votre téléphone"
                                value="{{ old('phone') }}"
                                required
                            >
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="address" class="form-label">Adresse</label>
                        <input
                            type="text"
                            id="address"
                            name="address"
                            class="form-control"
                            placeholder="Votre adresse"
                            value="{{ old('address') }}"
                            required
                        >
                    </div>

                    <div class="mb-4">
                        <label for="city" class="form-label">Ville</label>
                        <input
                            type="text"
                            id="city"
                            name="city"
                            class="form-control"
                            placeholder="Votre ville"
                            value="{{ old('city') }}"
                            required
                        >
                    </div>

                    <button type="submit" class="btn btn-success">
                        Confirmer la commande
                    </button>
                </form>
            </div>
        </div>

        <div class="col-md-5">
            <div class="card p-4 shadow-sm border-0 rounded-4">
                <h4 class="mb-3">Résumé de la commande</h4>

                @php $total = 0; @endphp

                @forelse($cart as $id => $item)
                    @php
                        $subtotal = $item['price'] * $item['quantity'];
                        $total += $subtotal;
                    @endphp

                    <p class="mb-2">
                        {{ $item['name'] }} x{{ $item['quantity'] }}
                        <span class="float-end">{{ number_format($subtotal, 2) }} DH</span>
                    </p>
                @empty
                    <p class="text-muted">Votre panier est vide.</p>
                @endforelse

                <hr>

                <h5>
                    Total
                    <span class="float-end text-primary">{{ number_format($total, 2) }} DH</span>
                </h5>
            </div>
        </div>
    </div>
</div>
@endsection