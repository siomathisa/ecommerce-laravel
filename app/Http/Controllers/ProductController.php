<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product; // 👈 important pour accéder au modèle

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all(); // récupère tous les produits
        return view('products.index', compact('products')); // envoie à la vue
    }
}
