@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-8 text-center text-gray-800">🛍️ Nos produits</h1>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @foreach ($products as $product)
            <div class="bg-white rounded-2xl shadow-md p-4 flex flex-col hover:shadow-lg transition-shadow">
                <h2 class="text-xl font-semibold text-gray-800 mb-2">{{ $product->name }}</h2>
                <p class="text-gray-600 text-sm flex-1">{{ $product->description }}</p>

                <div class="mt-4">
                    <span class="text-lg font-bold text-blue-600">{{ number_format($product->price, 2) }} €</span>
                    <p class="text-xs text-gray-500">Stock : {{ $product->stock }}</p>
                </div>

                <button
                    class="mt-4 bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition-colors">
                    Ajouter au panier
                </button>
            </div>
        @endforeach
    </div>

    @if ($products->isEmpty())
        <p class="text-center text-gray-500 mt-8">Aucun produit disponible pour le moment.</p>
    @endif
</div>
@endsection
