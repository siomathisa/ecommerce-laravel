@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <div class="max-w-md mx-auto bg-white shadow-md rounded-lg p-6 text-center">
        <h1 class="text-2xl font-bold mb-3">{{ $product->name }}</h1>
        <p class="text-gray-600 mb-3">{{ $product->description }}</p>
        <p class="text-lg font-bold mb-5">{{ number_format($product->price, 2) }} €</p>

        @auth
            <form action="{{ route('cart.store', $product) }}" method="POST">
                @csrf
                <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
                    Ajouter au panier
                </button>
            </form>
        @else
            <a href="{{ route('login') }}" class="bg-gray-500 text-white px-4 py-2 rounded">Connecte-toi</a>
        @endauth

        <div class="mt-4">
            <a href="{{ route('products.index') }}" class="text-blue-500 hover:underline">← Retour à la liste</a>
        </div>
    </div>
</div>
@endsection
