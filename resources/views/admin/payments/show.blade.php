@extends('layouts.app')

@section('content')
<div class="container my-5">
    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-body p-4">

            <h2 class="mb-4 text-center">Paiement</h2>

            <div class="mb-3">
                <p><strong>Commande :</strong> #{{ $order->id }}</p>
                <p><strong>Total :</strong> {{ number_format($order->total, 2) }} MAD</p>
                <p>
                    <strong>Statut :</strong>
                    <span class="badge bg-warning text-dark">
                        {{ $order->status }}
                    </span>
                </p>
            </div>

            <form action="{{ route('payment.pay', $order->id) }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label"><strong>Mode de paiement :</strong></label>

                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="payment_method" value="card" required>
                        <label class="form-check-label">Carte bancaire</label>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="payment_method" value="cash">
                        <label class="form-check-label">Espèces</label>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="payment_method" value="bank">
                        <label class="form-check-label">Virement bancaire</label>
                    </div>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('products.catalogue') }}" class="btn btn-outline-secondary">
                        Retour
                    </a>

                    <button type="submit" class="btn btn-success">
                        Confirmer le paiement
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection