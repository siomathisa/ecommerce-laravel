<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CartItemController extends Controller
{
    // Voir le panier
    public function index()
    {
        $items = CartItem::where('user_id', Auth::id())->with('product')->get();
        $total = $items->sum(fn($item) => $item->product->price * $item->quantity);
        return view('cart.index', compact('items', 'total'));
    }

    // Ajouter au panier
    public function store(Request $request, Product $product)
    {
        $item = CartItem::where('user_id', Auth::id())
            ->where('product_id', $product->id)
            ->first();

        if ($item) {
            $item->increment('quantity');
        } else {
            CartItem::create([
                'user_id' => Auth::id(),
                'product_id' => $product->id,
                'quantity' => 1,
            ]);
        }

        return redirect()->route('cart.index')->with('success', 'Produit ajouté au panier !');
    }

    // Supprimer du panier
    public function destroy(CartItem $cartItem)
    {
        $cartItem->delete();
        return redirect()->route('cart.index')->with('success', 'Produit retiré du panier.');
    }
}
