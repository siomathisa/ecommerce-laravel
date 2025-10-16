<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderAdminController extends Controller
{
    // 🧾 Liste de toutes les commandes
    public function index()
    {
        $user = auth()->user();
        if (!$user || !$user->is_admin) {
            abort(403);
        }

        $orders = Order::with('user', 'items.product')->latest()->get();
        return view('admin.orders.index', compact('orders'));
    }

    // 🔄 Mettre à jour le statut d'une commande
    public function updateStatus(Request $request, Order $order)
    {
        $user = auth()->user();
        if (!$user || !$user->is_admin) {
            abort(403);
        }

        $request->validate([
            'status' => 'required|string',
        ]);

        $order->update(['status' => $request->status]);

        return redirect()->route('admin.orders.index')->with('success', 'Statut mis à jour !');
    }
}
