<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    // Page checkout
    public function checkout()
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()
                ->route('cart.index')
                ->with('error', 'Votre panier est vide.');
        }

        return view('orders.checkout', compact('cart'));
    }

    // Confirmer la commande
    public function confirm()
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()
                ->route('cart.index')
                ->with('error', 'Votre panier est vide.');
        }

        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        /** @var \App\Models\User $user */
        $user = Auth::user();

        $order = Order::create([
            'user_id' => $user->id,
            'total' => $total,
            'status' => 'pending',
        ]);

        foreach ($cart as $id => $details) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $id,
                'quantity' => $details['quantity'],
                'price' => $details['price'],
            ]);
        }

        session()->forget('cart');

        return redirect()->route('payment.show', $order->id);
    }

    // Formulaire paiement client
    public function paymentForm($id)
    {
        $order = Order::findOrFail($id);

        /** @var \App\Models\User $user */
        $user = Auth::user();

        if ($order->user_id !== $user->id) {
            Log::warning('UNAUTHORIZED_PAYMENT_PAGE_ACCESS', [
                'actor_id' => $user->id,
                'order_id' => $id,
                'ip' => request()->ip(),
                'user_agent' => request()->userAgent(),
            ]);

            abort(403, 'Accès interdit.');
        }

        return view('orders.payment', compact('order'));
    }

    // Validation du mode de paiement sans Stripe
    public function pay(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        /** @var \App\Models\User $user */
        $user = Auth::user();

        if ($order->user_id !== $user->id) {
            Log::warning('UNAUTHORIZED_PAYMENT_ATTEMPT', [
                'actor_id' => $user->id,
                'order_id' => $id,
                'ip' => request()->ip(),
            ]);

            abort(403, 'Accès interdit.');
        }

        if ($order->status === 'paid') {
            return redirect()
                ->route('payment.show', $order->id)
                ->with('error', 'Cette commande est déjà payée.');
        }

        $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:50',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:100',
            'payment_method' => 'required|in:cash,bank',
            'bank_reference' => 'nullable|string|max:255',
            'payment_note' => 'nullable|string|max:1000',
        ]);
        if ($request->payment_method === 'bank' && empty($request->bank_reference)) {
             return redirect()
                   ->back()
                   ->withInput()
                   ->withErrors([
                      'bank_reference' => 'La référence de virement est obligatoire.'
                    ]);
        }            
        try {
            Log::notice('OFFLINE_PAYMENT_SELECTED', [
                'actor_id' => $user->id,
                'order_id' => $id,
                'method' => $request->payment_method,
                'ip' => request()->ip(),
                'user_agent' => request()->userAgent(),
            ]);

            $order->update([
                'full_name' => $request->full_name,
                'email' => $user->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'city' => $request->city,
                'payment_method' => $request->payment_method,
                'bank_reference' => $request->bank_reference,
                'payment_note' => $request->payment_note,
                'status' => 'awaiting_confirmation',
            ]);

            return redirect()
               ->route('order.confirmation', $order->id)
               ->with('success', 'Votre commande a été enregistrée avec succès.');
        } catch (\Throwable $e) {
            Log::error('OFFLINE_PAYMENT_FAILED', [
                'actor_id' => $user->id,
                'order_id' => $id,
                'ip' => request()->ip(),
                'error' => $e->getMessage(),
            ]);

            return redirect()
                ->route('payment.show', $order->id)
                ->with('error', 'Erreur lors de l’enregistrement du mode de paiement.');
        }
    }
    
    public function confirmation($id)
    {
      $order = Order::findOrFail($id);

      /** @var \App\Models\User $user */
      $user = Auth::user();

      if ($order->user_id !== $user->id) {
         abort(403, 'Accès interdit.');
       }

      return view('orders.confirmation', compact('order'));
    }
    
    public function adminOrders()
    {
         $orders = Order::with('user')->latest()->paginate(10);
         return view('admin.orders.index', compact('orders'));
    }

    public function adminOrderShow($id)
    {
       $order = Order::with('items.product')->findOrFail($id);

      return view('admin.orders.show', compact('order'));
    }

    public function adminUpdateStatus(Request $request, $id)
    {
       $order = Order::findOrFail($id);
 
       $request->validate([
          'status' => 'required|in:pending,awaiting_confirmation,paid,cancelled',
        ]);

        $order->update([
          'status' => $request->status,
        ]);

        return redirect()
          ->route('admin.orders.show', $order->id)
          ->with('success', 'Statut de la commande mis à jour avec succès.');
    }
    public function adminDashboard()
    {
       $latestOrders = Order::latest()->take(5)->get();

       $productsCount = \App\Models\Product::count();
       $ordersCount = Order::count();
       $clientsCount = \App\Models\User::where('role', 'client')->count();
       $revenues = Order::where('status', 'paid')->sum('total');

        return view('admin.dashboard', compact(
          'latestOrders',
          'productsCount',
          'ordersCount',
          'clientsCount',
          'revenues'
        ));
    }

}