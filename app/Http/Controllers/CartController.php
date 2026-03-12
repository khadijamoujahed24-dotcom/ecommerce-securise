<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
       public function index()
    {
        $cart = session()->get('cart', []);
        return view('cart.index', compact('cart'));
    }

    public function add($id)
    {
        $product = Product::findOrFail($id);

        $cart = session()->get('cart', []);

        if(isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                "name" => $product->name,
                "price" => $product->price,
                "quantity" => 1
            ];
        }

        session()->put('cart', $cart);
        return redirect()->back()
         ->with('success', 'Produit ajouté au panier');
    }

    public function remove(Product $product)
    {
    $cart = session()->get('cart', []);

    if(isset($cart[$product->id])) {
        unset($cart[$product->id]);
        session()->put('cart', $cart);
    }

    return redirect()->back()
        ->with('success', 'Produit supprimé du panier');
    
    }

}

