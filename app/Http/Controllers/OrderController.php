<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;


class OrderController extends Controller
{
    public function checkout()
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')
                ->with('error', 'Votre panier est vide.');
        }

        return view('orders.checkout', compact('cart'));
    }

    public function confirm()
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart.index')
                ->with('error', 'Votre panier est vide.');
        }

         //  Étape calcul du total
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        // Création de la commande
        $order = Order::create([
            'user_id' => auth()->id(),
            'total'   => $total,
            'status'  => 'pending'
        ]);
        foreach ($cart as $id => $details) {
            OrderItem::create([
                'order_id'  => $order->id,
                'product_id'=> $id,
                'quantity'  => $details['quantity'],
                'price'     => $details['price']
            ]);
        }
        session()->forget('cart');

        return redirect()->route('payment.show', $order->id);
    }


    public function paymentForm($id)
    {
       $order = Order::findOrFail($id);
        // Sécurité: l'utilisateur ne doit voir que ses commandes
       if ($order->user_id !== auth()->id()) {
         abort(403);
       }

        return view('orders.payment', compact('order'));
   }
       public function pay(Request $request, $id)
    {
       $order = Order::findOrFail($id);
       if ($order->user_id !== auth()->id()) {
         abort(403);
        }
        $request->validate([
          'payment_method' => 'required|in:card,cash,bank'
        ]);
        $order->update([
          'payment_method' => $request->payment_method,
          'status' => 'paid'
        ]);
        return redirect()->route('products.index')
           ->with('success', 'Paiement simulé effectué. Commande validée.');
    }
}  