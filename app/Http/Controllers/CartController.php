<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    // Afficher le panier
    public function index()
    {
        $cart = session()->get('cart', []); // récupérer le panier depuis la session
        $total = 0;

        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return view('client.cart', compact('cart', 'total'));
    }

    // Ajouter un produit au panier
    public function add(Product $product)
    {
        $cart = session()->get('cart', []);

        if(isset($cart[$product->id])) {
            $cart[$product->id]['quantity'] += 1; // si déjà présent, incrémente la quantité
        } else {
            $cart[$product->id] = [
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => 1
            ];
        }

        session()->put('cart', $cart);

        return redirect()->back()->with('success', $product->name.' ajouté au panier !');
    }

    // Supprimer un produit du panier
    public function remove(Product $product)
    {
        $cart = session()->get('cart', []);

        if(isset($cart[$product->id])) {
            unset($cart[$product->id]); // supprimer le produit
            session()->put('cart', $cart);
        }

        return redirect()->back()->with('success', $product->name.' retiré du panier.');
    }

    // Mettre à jour la quantité d’un produit
    public function update(Request $request, Product $product)
    {
        $cart = session()->get('cart', []);

        if(isset($cart[$product->id])) {
            $quantity = $request->input('quantity');
            if($quantity > 0){
                $cart[$product->id]['quantity'] = $quantity;
            } else {
                unset($cart[$product->id]); // supprime si quantité <= 0
            }
            session()->put('cart', $cart);
        }

        return redirect()->back()->with('success', 'Quantité mise à jour.');
    }
}