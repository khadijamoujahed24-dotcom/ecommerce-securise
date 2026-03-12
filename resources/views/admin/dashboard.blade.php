@extends('layouts.app')

@section('content')
<div class="container my-5">
    <h1 class="mb-4">Tableau de bord administrateur</h1>

    <!-- Statistiques rapides -->
    <div class="row g-4 mb-4">
        <div class="col-md-3">
            <div class="card p-4 text-center">
                <h5>Produits</h5>
                <h2 class="text-primary">120</h2>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card p-4 text-center">
                <h5>Commandes</h5>
                <h2 class="text-success">45</h2>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card p-4 text-center">
                <h5>Clients</h5>
                <h2 class="text-warning">78</h2>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card p-4 text-center">
                <h5>Revenus</h5>
                <h2 class="text-danger">25 000 DH</h2>
            </div>
        </div>
    </div>

    <!-- Dernières commandes -->
    <div class="card p-4">
        <h4 class="mb-3">Dernières commandes</h4>
        <div class="table-responsive">
            <table class="table table-bordered align-middle">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Client</th>
                        <th>Produit</th>
                        <th>Montant</th>
                        <th>Statut</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>#001</td>
                        <td>Mohamed</td>
                        <td>PC Gamer</td>
                        <td>12 000 DH</td>
                        <td><span class="badge bg-success">Payée</span></td>
                    </tr>
                    <tr>
                        <td>#002</td>
                        <td>Salma</td>
                        <td>Écran 24 pouces</td>
                        <td>1 800 DH</td>
                        <td><span class="badge bg-warning text-dark">En attente</span></td>
                    </tr>
                    <tr>
                        <td>#003</td>
                        <td>Youssef</td>
                        <td>Clavier mécanique</td>
                        <td>650 DH</td>
                        <td><span class="badge bg-primary">En préparation</span></td>
                    </tr>
                    <tr>
                        <td>#004</td>
                        <td>Fatima</td>
                        <td>Disque SSD 1TB</td>
                        <td>900 DH</td>
                        <td><span class="badge bg-danger">Annulée</span></td>
                    </tr>
                    <tr>
                        <td>#005</td>
                        <td>Ali</td>
                        <td>Routeur Wi-Fi</td>
                        <td>450 DH</td>
                        <td><span class="badge bg-success">Payée</span></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Liens rapides -->
    <div class="row mt-4 g-4">
        <div class="col-md-3">
            <a href="{{ route('products.index') }}" class="text-decoration-none">
                <div class="card p-3 text-center">
                    <h5>Gérer les produits</h5>
                </div>
            </a>
        </div>
        <div class="col-md-3">
            <a href="{{ route('orders.index') }}" class="text-decoration-none">
                <div class="card p-3 text-center">
                    <h5>Gérer les commandes</h5>
                </div>
            </a>
        </div>
        <div class="col-md-3">
            <a href="{{ route('categories.index') }}" class="text-decoration-none">
                <div class="card p-3 text-center">
                    <h5>Gérer les catégories</h5>
                </div>
            </a>
        </div>
        <div class="col-md-3">
            <a href="{{ route('users.index') }}" class="text-decoration-none">
                <div class="card p-3 text-center">
                    <h5>Gérer les utilisateurs</h5>
                </div>
            </a>
        </div>
    </div>
</div>
@endsection