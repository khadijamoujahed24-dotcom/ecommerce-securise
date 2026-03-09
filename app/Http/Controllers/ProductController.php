<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // ---------------------------------------------------
    // Admin : Afficher liste des produits
    // ---------------------------------------------------
    public function index()
    {
        // Récupérer les produits avec leur catégorie, 10 par page
        $products = Product::with('category')->paginate(10);

        // Retourner la vue admin.products.index
        return view('admin.products.index', compact('products'));
    }

    // ---------------------------------------------------
    // Admin : Formulaire ajout produit
    // ---------------------------------------------------
    public function create()
    {
        $categories = Category::all(); // Liste des catégories
        return view('admin.products.create', compact('categories'));
    }

    // ---------------------------------------------------
    // Admin : Stocker nouveau produit
    // ---------------------------------------------------
    public function store(Request $request)
    {
        // Validation des champs
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'category_id' => 'required|exists:categories,id',
        ]);

        // Création du produit
        Product::create($request->all());

        return redirect()->route('admin.products.index')->with('success', 'Produit ajouté avec succès.');
    }

    // ---------------------------------------------------
    // Admin : Formulaire modification produit
    // ---------------------------------------------------
    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    // ---------------------------------------------------
    // Admin : Mise à jour produit
    // ---------------------------------------------------
    public function update(Request $request, Product $product)
    {
        // Validation des champs
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'category_id' => 'required|exists:categories,id',
        ]);

        // Mise à jour
        $product->update($request->all());

        return redirect()->route('admin.products.index')->with('success', 'Produit modifié avec succès.');
    }

    // ---------------------------------------------------
    // Admin : Supprimer produit
    // ---------------------------------------------------
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'Produit supprimé avec succès.');
    }

    // ---------------------------------------------------
    // Frontend : Afficher catalogue côté client
    // ---------------------------------------------------
    public function catalog()
    {
        $products = Product::with('category')->paginate(12); // Pagination côté client
        $categories = Category::all();
        return view('client.catalog', compact('products', 'categories'));
    }

    // Frontend : Afficher détail produit
    public function show(Product $product)
    {
        return view('client.show', compact('product'));
    }
}