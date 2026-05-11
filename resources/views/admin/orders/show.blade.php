@extends('layouts.app')

@section('content')
<div class="container my-5">
    <h1 class="mb-4">Commande #{{ $order->id }}</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row g-4">
        <div class="col-md-6">
            <div class="card p-4 shadow-sm border-0 rounded-4">
                <h4 class="mb-3">Informations client</h4>

                <p><strong>Nom :</strong> {{ $order->full_name ?? '-' }}</p>
                <p><strong>Email :</strong> {{ $order->email ?? '-' }}</p>
                <p><strong>Téléphone :</strong> {{ $order->phone ?? '-' }}</p>
                <p><strong>Adresse :</strong> {{ $order->address ?? '-' }}</p>
                <p><strong>Ville :</strong> {{ $order->city ?? '-' }}</p>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card p-4 shadow-sm border-0 rounded-4">
                <h4 class="mb-3">Informations commande</h4>

                <p><strong>Total :</strong> {{ number_format($order->total, 2) }} MAD</p>

                <p><strong>Mode de paiement :</strong>
                    @if($order->payment_method === 'cash')
                        Paiement à la livraison
                    @elseif($order->payment_method === 'bank')
                        Virement bancaire
                    @else
                        {{ $order->payment_method ?? '-' }}
                    @endif
                </p>

                <p><strong>Référence virement :</strong> {{ $order->bank_reference ?? '-' }}</p>
                <p><strong>Note :</strong> {{ $order->payment_note ?? '-' }}</p>
                <p><strong>Statut actuel :</strong> {{ ucfirst(str_replace('_', ' ', $order->status)) }}</p>

                <hr>

                <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Changer le statut</label>
                        <select name="status" class="form-select" required>
                            <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="awaiting_confirmation" {{ $order->status === 'awaiting_confirmation' ? 'selected' : '' }}>Awaiting confirmation</option>
                            <option value="paid" {{ $order->status === 'paid' ? 'selected' : '' }}>Paid</option>
                            <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-success">
                        Mettre à jour
                    </button>

                    <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary">
                        Retour
                    </a>
                </form>
            </div>
        </div>
    </div>

    <div class="card p-4 shadow-sm border-0 rounded-4 mt-4">
        <h4 class="mb-3">Produits de la commande</h4>

        <div class="table-responsive">
            <table class="table table-bordered align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Produit</th>
                        <th>Prix unitaire</th>
                        <th>Quantité</th>
                        <th>Sous-total</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($order->items as $item)
                        <tr>
                            <td>{{ $item->product->name ?? 'Produit supprimé' }}</td>
                            <td>{{ number_format($item->price, 2) }} MAD</td>
                            <td>{{ $item->quantity }}</td>
                            <td>{{ number_format($item->price * $item->quantity, 2) }} MAD</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">Aucun produit dans cette commande.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection