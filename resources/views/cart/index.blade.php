@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto mt-10 px-4">
    <h1 class="text-3xl font-bold mb-6">🛒 Mon Panier</h1>

    @if($items->isEmpty())
    <div class="text-center py-10">
        <p class="text-gray-600 mb-4">Votre panier est vide.</p>
        <a href="{{ route('products.index') }}" class="text-indigo-600 hover:underline">← Continuer mes achats</a>
    </div>
    @else
    <div class="overflow-x-auto bg-white rounded-2xl shadow-md">
        <table class="w-full text-left border-collapse">
            <thead class="bg-gray-100 text-gray-700 uppercase text-sm">
                <tr>
                    <th class="p-4">Produit</th>
                    <th class="p-4 text-center">Quantité</th>
                    <th class="p-4 text-center">Prix</th>
                    <th class="p-4 text-center">Total</th>
                    <th class="p-4 text-center"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($items as $item)
                <tr class="border-b hover:bg-gray-50">
                    <td class="p-4 font-medium">{{ $item->product->name }}</td>
                    <td class="p-4 text-center">{{ $item->quantity }}</td>
                    <td class="p-4 text-center">{{ number_format($item->product->price, 2) }} €</td>
                    <td class="p-4 text-center font-semibold">{{ number_format($item->product->price * $item->quantity, 2) }} €</td>
                    <td class="p-4 text-center">
                        <form method="POST" action="{{ route('cart.destroy', $item) }}">
                            @csrf
                            @method('DELETE')
                            <button class="text-red-500 hover:underline">Supprimer</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="flex justify-between items-center mt-6">
        <a href="{{ route('products.index') }}" class="text-indigo-600 hover:underline">← Continuer mes achats</a>
        @if(!$items->isEmpty())
        <div class="text-right mt-4">
            <p class="text-lg font-semibold">💰 Total : {{ number_format($total, 2) }} €</p>
            <form method="POST" action="{{ route('orders.store') }}">
                @csrf
                <button class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded mt-3">
                    ✅ Passer la commande
                </button>
            </form>
        </div>
        @endif

    </div>
    @endif
</div>
@endsection