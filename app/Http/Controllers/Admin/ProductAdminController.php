<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductAdminController extends Controller
{
    // Petite fonction pour vérifier si l'utilisateur est admin
    private function checkAdmin() {
        $user = auth()->user();
        if (!$user || !$user->is_admin) {
            abort(403); // interdit l'accès si pas admin
        }
    }

    // Liste des produits
    public function index()
    {
        $this->checkAdmin();
        $products = Product::all();
        return view('admin.products.index', compact('products'));
    }

    // Formulaire création
    public function create()
    {
        $this->checkAdmin();
        return view('admin.products.create');
    }

    // Stockage produit
    public function store(Request $request)
    {
        $this->checkAdmin();

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
        ]);

        Product::create($data);

        return redirect()->route('admin.products.index')->with('success', 'Produit créé !');
    }

    // Formulaire édition
    public function edit(Product $product)
    {
        $this->checkAdmin();
        return view('admin.products.edit', compact('product'));
    }

    // Mise à jour produit
    public function update(Request $request, Product $product)
    {
        $this->checkAdmin();

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
        ]);

        $product->update($data);

        return redirect()->route('admin.products.index')->with('success', 'Produit mis à jour !');
    }

    // Suppression produit
    public function destroy(Product $product)
    {
        $this->checkAdmin();
        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'Produit supprimé !');
    }
}
