<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        return view('categories.index', compact('categories'));
    }
    public function show(Category $category)
    {
    $products = Product::with('category')
        ->where('category_id', $category->id)
        ->paginate(12);

    return view('client.category-show', compact('category', 'products'));
    }
}