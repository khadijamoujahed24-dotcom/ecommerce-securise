<h2>Ajouter un produit</h2>

<form action="{{ route('products.store') }}" method="POST">
    @csrf

    <input type="text" name="name" placeholder="Nom du produit">
    <textarea name="description" placeholder="Description"></textarea>
    <input type="number" step="0.01" name="price" placeholder="Prix">
    <input type="number" name="stock" placeholder="Stock">

    <button type="submit">Enregistrer</button>
</form>

