<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function store()
    {
        $user = Auth::user();

        // Récupération du panier de l'utilisateur
        $cartItems = CartItem::where('user_id', $user->id)->with('product')->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Votre panier est vide.');
        }

        DB::transaction(function () use ($user, $cartItems) {
            $total = $cartItems->sum(fn($item) => $item->product->price * $item->quantity);

            // ✅ Création de la commande
            $order = Order::create([
                'user_id' => $user->id,
                'total' => $total,
                'status' => 'en cours',
            ]);

            // ✅ Pour chaque article du panier
            foreach ($cartItems as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price' => $item->product->price,
                ]);

                // 🧮 Réduction du stock produit
                $item->product->decrement('stock', $item->quantity);
            }

            // 🧹 Vider le panier
            CartItem::where('user_id', $user->id)->delete();
        });

        return redirect()->route('orders.index')->with('success', 'Commande passée avec succès !');
    }

    // 🧾 Liste des commandes de l'utilisateur
    public function index()
    {
        $orders = Order::where('user_id', Auth::id())->with('items.product')->latest()->get();
        return view('orders.index', compact('orders'));
    }
}
