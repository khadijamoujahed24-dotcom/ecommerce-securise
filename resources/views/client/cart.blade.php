@extends('layouts.app')

@section('content')
<div class="container my-4">
    <h1>Votre Panier</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(empty($cart))
        <p>Votre panier est vide.</p>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Produit</th>
                    <th>Prix unitaire</th>
                    <th>Quantité</th>
                    <th>Total</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cart as $id => $item)
                <tr>
                    <td>{{ $item['name'] }}</td>
                    <td>{{ $item['price'] }} MAD</td>
                    <td>
                        <form action="{{ route('cart.update', $id) }}" method="POST" style="display:flex;">
                            @csrf
                            <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" class="form-control" style="width:80px;">
                            <button type="submit" class="btn btn-sm btn-primary ml-2">Modifier</button>
                        </form>
                    </td>
                    <td>{{ $item['price'] * $item['quantity'] }} MAD</td>
                    <td>
                        <a href="{{ route('cart.remove', $id) }}" class="btn btn-sm btn-danger">Supprimer</a>
                    </td>
                </tr>
                @endforeach
                <tr>
                    <td colspan="3"><strong>Total général</strong></td>
                    <td colspan="2"><strong>{{ $total }} MAD</strong></td>
                </tr>
            </tbody>
        </table>

        <form action="{{ route('order.confirm') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-success">Valider la commande</button>
        </form>
    @endif
</div>
@endsection