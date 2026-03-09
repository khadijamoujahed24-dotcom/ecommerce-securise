<h2>Modifier le produit</h2>

@if($errors->any())
    <ul>
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif

<form action="{{ route('products.update', $product->id) }}" method="POST">
    @csrf
    @method('PUT')

    <label>Nom du produit</label><br>
    <input type="text" name="name" value="{{ $product->name }}"><br><br>

    <label>Prix</label><br>
    <input type="text" name="price" value="{{ $product->price }}"><br><br>

    <label>Stock</label><br>
    <input type="number" name="stock" value="{{ $product->stock }}"><br><br>

    <button type="submit">Mettre à jour</button>
</form>

