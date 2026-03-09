<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Catégories</title>
</head>
<body>
    <h1>Liste des catégories</h1>

    @if($categories->isEmpty())
        <p>Aucune catégorie trouvée.</p>
    @else
        <ul>
            @foreach($categories as $category)
                <li>{{ $category->name }}</li>
            @endforeach
        </ul>
    @endif
</body>
</html>
