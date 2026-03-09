@extends('layouts.app')

@section('content')
<div class="container my-5">
    <h1 class="mb-4">Mon panier</h1>

    <div class="card p-4">
        <div class="table-responsive">
            <table class="table align-middle">
                <thead>
                    <tr>
                        <th>Produit</th>
                        <th>Prix</th>
                        <th>Quantité</th>
                        <th>Sous-total</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>PC Portable ASUS</td>
                        <td>8 999 DH</td>
                        <td><input type="number" class="form-control" value="1" min="1" style="width: 90px;"></td>
                        <td>8 999 DH</td>
                        <td><button class="btn btn-danger btn-sm">Supprimer</button></td>
                    </tr>
                    <tr>
                        <td>Souris Gaming</td>
                        <td>299 DH</td>
                        <td><input type="number" class="form-control" value="2" min="1" style="width: 90px;"></td>
                        <td>598 DH</td>
                        <td><button class="btn btn-danger btn-sm">Supprimer</button></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="text-end mt-4">
            <h4>Total : <span class="text-primary">9 597 DH</span></h4>
            <a href="{{ url('/checkout') }}" class="btn btn-success mt-2">Passer au checkout</a>
        </div>
    </div>
</div>
@endsection