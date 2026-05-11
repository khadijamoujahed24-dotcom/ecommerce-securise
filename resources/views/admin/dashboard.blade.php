@extends('layouts.app')

@section('content')
<div class="container my-5">
    <h1 class="mb-4">Tableau de bord administrateur</h1>

    <!-- Statistiques rapides -->
    <div class="row g-4 mb-4">
        <div class="col-md-3">
            <div class="card p-4 text-center shadow-sm rounded-4 border-0 h-100">
                <h5>Produits</h5>
                <h2 class="text-primary">{{ $productsCount }}</h2>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card p-4 text-center shadow-sm rounded-4 border-0 h-100">
                <h5>Commandes</h5>
                <h2 class="text-success">{{ $ordersCount }}</h2>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card p-4 text-center shadow-sm rounded-4 border-0 h-100">
                <h5>Clients</h5>
                <h2 class="text-warning">{{ $clientsCount }}</h2>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card p-4 text-center shadow-sm rounded-4 border-0 h-100">
                <h5>Revenus</h5>
                <h2 class="text-danger">{{ number_format($revenues, 2) }} DH</h2>
            </div>
        </div>
    </div>

    <!-- Dernières commandes -->
    <div class="card p-4 shadow-sm border-0 rounded-4">
        <h4 class="mb-3">Dernières commandes</h4>

        <div class="table-responsive">
            <table class="table table-bordered align-middle">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Client</th>
                        <th>Email</th>
                        <th>Montant</th>
                        <th>Paiement</th>
                        <th>Statut</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($latestOrders as $order)
                        <tr>
                            <td>#{{ $order->id }}</td>
                            <td>{{ $order->full_name ?? 'Client inconnu' }}</td>
                            <td>{{ $order->email ?? '-' }}</td>
                            <td>{{ number_format($order->total, 2) }} DH</td>
                            <td>
                                @if($order->payment_method === 'cash')
                                    Paiement à la livraison
                                @elseif($order->payment_method === 'bank')
                                    Virement bancaire
                                @else
                                    {{ $order->payment_method ?? '-' }}
                                @endif
                            </td>
                            <td>
                                @if($order->status === 'paid')
                                    <span class="badge bg-success">Payée</span>
                                @elseif($order->status === 'awaiting_confirmation')
                                    <span class="badge bg-warning text-dark">En attente</span>
                                @elseif($order->status === 'cancelled')
                                    <span class="badge bg-danger">Annulée</span>
                                @elseif($order->status === 'pending')
                                    <span class="badge bg-secondary">Pending</span>
                                @else
                                    <span class="badge bg-secondary">{{ ucfirst(str_replace('_', ' ', $order->status)) }}</span>
                                @endif
                            </td>
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
    </div>

    <!-- Liens rapides -->
    <div class="row mt-4 g-4">
        <div class="col-md-3">
            <a href="{{ route('admin.products.index') }}" class="text-decoration-none">
                <div class="card p-4 text-center shadow-sm rounded-4 border-0 h-100">
                    <h5 class="mb-0">Gérer les produits</h5>
                </div>
            </a>
        </div>

        <div class="col-md-3">
            <a href="{{ route('admin.orders.index') }}" class="text-decoration-none">
                <div class="card p-4 text-center shadow-sm rounded-4 border-0 h-100">
                    <h5 class="mb-0">Gérer les commandes</h5>
                </div>
            </a>
        </div>

        <div class="col-md-3">
            <a href="{{ route('categories.index') }}" class="text-decoration-none">
                <div class="card p-4 text-center shadow-sm rounded-4 border-0 h-100">
                    <h5 class="mb-0">Voir les catégories</h5>
                </div>
            </a>
        </div>

        <div class="col-md-3">
            <a href="{{ route('admin.users.index') }}" class="text-decoration-none">
                <div class="card p-4 text-center shadow-sm rounded-4 border-0 h-100">
                    <h5>Gérer les utilisateurs</h5>
                    <p class="text-muted mb-0">Consulter, modifier et supprimer</p>
                </div>
            </a>
        </div>
    </div>
</div>
@endsection