<h2>Paiement (Simulation)</h2>

<p><strong>Commande #{{ $order->id }}</strong></p>
<p>Total : {{ $order->total }} €</p>
<p>Statut : {{ $order->status }}</p>

<form action="{{ route('payment.pay', $order->id) }}" method="POST">
    @csrf

    <label>Mode de paiement :</label><br>

    <input type="radio" name="payment_method" value="card"> Carte bancaire<br>
    <input type="radio" name="payment_method" value="cash"> Espèces<br>
    <input type="radio" name="payment_method" value="bank"> Virement<br><br>

    <button type="submit">Confirmer le paiement</button>
</form>

