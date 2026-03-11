@extends('layouts.app')

@section('content')
<style>
    .categories-page {
        background: linear-gradient(180deg, #f8f9fa 0%, #ffffff 100%);
        min-height: 100vh;
        padding: 60px 0;
    }

    .categories-header {
        text-align: center;
        margin-bottom: 45px;
    }

    .categories-header h1 {
        font-size: 2.5rem;
        font-weight: 800;
        color: #1f2937;
        margin-bottom: 12px;
    }

    .categories-header p {
        color: #6b7280;
        max-width: 700px;
        margin: 0 auto;
        font-size: 1rem;
    }

    .category-box {
        background: #ffffff;
        border: none;
        border-radius: 20px;
        padding: 28px 22px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        transition: all 0.35s ease;
        height: 100%;
        text-align: center;
    }

    .category-box:hover {
        transform: translateY(-8px);
        box-shadow: 0 18px 40px rgba(0, 0, 0, 0.12);
    }

    .category-icon {
        width: 70px;
        height: 70px;
        margin: 0 auto 18px auto;
        border-radius: 50%;
        background: linear-gradient(135deg, #0d6efd, #0a58ca);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        font-size: 1.8rem;
        box-shadow: 0 10px 22px rgba(13, 110, 253, 0.25);
    }

    .category-name {
        font-size: 1.15rem;
        font-weight: 700;
        color: #111827;
        margin-bottom: 8px;
    }

    .category-text {
        font-size: 0.95rem;
        color: #6b7280;
        line-height: 1.6;
        margin-bottom: 0;
    }

    @media (max-width: 768px) {
        .categories-header h1 {
            font-size: 2rem;
        }
    }
</style>

<div class="categories-page">
    <div class="container">
        <div class="categories-header">
            <h1>Liste des catégories</h1>
            <p>
                Découvrez l’ensemble de nos catégories de matériel informatique
                et trouvez facilement les produits adaptés à vos besoins.
            </p>
        </div>

        <div class="row g-4">
            @foreach($categories as $category)
                <div class="col-md-4 col-lg-3">
                    <div class="category-box">
                        <div class="category-icon">
                            <i class="bi bi-grid"></i>
                        </div>

                        <div class="category-name">{{ $category->name }}</div>

                        <p class="category-text">
                            {{ $category->description ?? 'Découvrez les produits disponibles dans cette catégorie.' }}
                        </p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection