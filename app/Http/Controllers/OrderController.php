<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    // Page checkout
    public function checkout()
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')
                ->with('error', 'Votre panier est vide.');
        }

        return view('orders.checkout', compact('cart'));
    }

    // Confirmer la commande
    public function confirm()
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart.index')
                ->with('error', 'Votre panier est vide.');
        }

        // Étape calcul du total
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        // Utilisateur connecté
        /** @var \App\Models\User $user */
        $user = Auth::user();

        // Création de la commande
        $order = Order::create([
            'user_id' => $user->id,
            'total'   => $total,
            'status'  => 'pending'
        ]);

        // Création des items de la commande
        foreach ($cart as $id => $details) {
            OrderItem::create([
                'order_id'   => $order->id,
                'product_id' => $id,
                'quantity'   => $details['quantity'],
                'price'      => $details['price']
            ]);
        }

        session()->forget('cart');

        return redirect()->route('payment.show', $order->id);
    }

    // Formulaire paiement
    public function paymentForm($id)
    {
        $order = Order::findOrFail($id);

        /** @var \App\Models\User $user */
        $user = Auth::user();

        if ($order->user_id !== $user->id) {
            Log::warning('UNAUTHORIZED_PAYMENT_PAGE_ACCESS', [
                'actor_id'   => $user->id,
                'order_id'   => $id,
                'ip'         => request()->ip(),
                'user_agent' => request()->userAgent(),
            ]);
            abort(403);
        }

        return view('orders.payment', compact('order'));
    }

    // Effectuer le paiement
    public function pay(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        /** @var \App\Models\User $user */
        $user = Auth::user();

        if ($order->user_id !== $user->id) {
            Log::warning('UNAUTHORIZED_PAYMENT_ATTEMPT', [
                'actor_id' => $user->id,
                'order_id' => $id,
                'ip'       => request()->ip(),
            ]);
            abort(403);
        }

        $request->validate([
            'payment_method' => 'required|in:card,cash,bank'
        ]);

        try {
            Log::notice('PAYMENT_START', [
                'actor_id'   => $user->id,
                'order_id'   => $id,
                'method'     => $request->payment_method,
                'ip'         => request()->ip(),
                'user_agent' => request()->userAgent(),
            ]);

            $order->update([
                'payment_method' => $request->payment_method,
                'status'         => 'paid'
            ]);

            Log::notice('PAYMENT_SUCCESS', [
                'actor_id' => $user->id,
                'order_id' => $id,
                'ip'       => request()->ip(),
            ]);

            return redirect()->route('products.index')
                 ->with('success', 'Paiement simulé effectué. Commande validée.');

        } catch (\Throwable $e) {
            Log::error('PAYMENT_FAILED', [
                'actor_id' => $user->id,
                'order_id' => $id,
                'ip'       => request()->ip(),
                'error'    => $e->getMessage(),
            ]);

            throw $e;
        }
    }
}