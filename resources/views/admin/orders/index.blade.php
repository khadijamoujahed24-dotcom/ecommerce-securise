@extends('layouts.app')

@section('content')
<div class="container my-5">
    <h1 class="mb-4">Gestion des commandes</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card p-4 shadow-sm border-0 rounded-4">
        <div class="table-responsive">
            <table class="table table-bordered align-middle">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Client</th>
                        <th>Email</th>
                        <th>Total</th>
                        <th>Paiement</th>
                        <th>Statut</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                        <tr>
                            <td>#{{ $order->id }}</td>
                            <td>{{ $order->full_name ?? '-' }}</td>
                            <td>{{ $order->email ?? '-' }}</td>
                            <td>{{ number_format($order->total, 2) }} MAD</td>
                            <td>{{ $order->payment_method ?? '-' }}</td>
                            <td>{{ ucfirst(str_replace('_', ' ', $order->status)) }}</td>
                            <td>
                                <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-sm btn-primary">
                                    Voir
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">Aucune commande trouvée.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-3">
            {{ $orders->links() }}
        </div>
    </div>
</div>
@endsection