@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">🛍️ Nos produits</h1>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @foreach($products as $product)
            <div class="bg-white shadow-md rounded-lg p-4 text-center">
                <h2 class="text-xl font-semibold mb-2">{{ $product->name }}</h2>
                <p class="text-gray-600 mb-2">{{ $product->description }}</p>
                <p class="text-lg font-bold mb-4">{{ number_format($product->price, 2) }} €</p>

                <div class="flex justify-center gap-2">
                    <!-- Voir détails -->
                    <a href="{{ route('products.show', $product) }}" class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">
                        Voir
                    </a>

                    <!-- Ajouter au panier -->
                    @auth
                        <form action="{{ route('cart.store', $product) }}" method="POST">
                            @csrf
                            <button type="submit" class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600">
                                Ajouter au panier
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="bg-gray-500 text-white px-3 py-1 rounded">Connecte-toi</a>
                    @endauth
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
