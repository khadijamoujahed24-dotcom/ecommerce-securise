<h2>Liste des produits</h2>
@if(session('success'))
    <p>{{ session('success') }}</p>
@endif
<table border="1" cellpadding="8">
    <tr>
        <th>ID</th>
        <th>Nom</th>
        <th>Description</th>
        <th>Prix</th>
        <th>Stock</th>
        <th>Actions</th>
    </tr>
    @forelse($products as $product)
        <tr>
            <td>{{ $product->id }}</td>
            <td>{{ $product->name }}</td>
            <td>{{ $product->description }}</td>
            <td>{{ $product->price }} €</td>
            <td>{{ $product->stock }}</td>
            <td>
                <!-- Bouton Ajouter au panier -->
                <a href="{{ route('cart.add', $product->id) }}">
                    Ajouter au panier
                </a>
            
                 <br>
                <!-- Bouton Modifier -->
                <a href="{{ route('products.edit', $product->id) }}">
                   Modifier
                 </a>
                <br>
                <!-- Bouton Supprimer -->
                <form action="{{ route('products.destroy', $product->id) }}"
                  method="POST"
                  style="display:inline;">
                 @csrf
                  @method('DELETE')
                 <button type="submit">Supprimer</button>
                </form>
             
        </tr>
    @empty
        <tr>
            <td colspan="6">Aucun produit disponible</td>
        </tr>
    @endforelse
</table>
