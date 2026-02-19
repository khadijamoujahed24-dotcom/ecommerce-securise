<h2>Mon Panier</h2>

@foreach($cart as $id => $details)
    <p><strong>{{ $details['name'] }}</strong></p>
    <p>Prix : {{ $details['price'] }} €</p>
    <p>Quantité : {{ $details['quantity'] }}</p>

    <a href="{{ route('cart.remove', $id) }}">Supprimer</a>

    <hr>
@endforeach

@if(count($cart) > 0)
    <form action="{{ route('order.confirm') }}" method="POST">
        @csrf
        <button type="submit">Valider la commande</button>
    </form>
@endif
