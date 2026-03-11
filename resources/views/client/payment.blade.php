@extends('layouts.app')

@section('content')
<div class="container my-4">
    <h1>Paiement de la commande #{{ $order->id }}</h1>

    <p><strong>Montant total :</strong> {{ $order->total }} MAD</p>
    <p><strong>Status actuel :</strong> {{ $order->status }}</p>

    <form action="{{ route('payment.confirm', $order) }}" method="POST">
        @csrf
        <div class="form-group mb-3">
            <label for="payment_method">Choisir un mode de paiement</label>
            <select name="payment_method" id="payment_method" class="form-control" required>
                <option value="Carte bancaire">Carte bancaire</option>
                <option value="PayPal">PayPal</option>
                <option value="Virement">Virement bancaire</option>
            </select>
        </div>
        <button type="submit" class="btn btn-success">Confirmer le paiement</button>
    </form>
</div>
@endsection