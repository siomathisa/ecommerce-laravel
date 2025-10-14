@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-bold mb-4">Gestion des produits</h1>

@if(session('success'))
    <div class="bg-green-200 text-green-800 px-4 py-2 rounded mb-4">
        {{ session('success') }}
    </div>
@endif

<a href="{{ route('admin.products.create') }}" class="bg-green-600 text-white px-4 py-2 rounded mb-4 inline-block">Ajouter un produit</a>

<table class="w-full border">
    <thead>
        <tr class="bg-gray-200">
            <th class="p-2 border">Nom</th>
            <th class="p-2 border">Prix</th>
            <th class="p-2 border">Stock</th>
            <th class="p-2 border">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($products as $product)
        <tr class="border-t">
            <td class="p-2 border">{{ $product->name }}</td>
            <td class="p-2 border">{{ $product->price }} €</td>
            <td class="p-2 border">{{ $product->stock }}</td>
            <td class="p-2 border flex space-x-2">
                <a href="{{ route('admin.products.edit', $product) }}" class="bg-yellow-500 text-white px-2 py-1 rounded">Éditer</a>
                <form action="{{ route('admin.products.destroy', $product) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="bg-red-500 text-white px-2 py-1 rounded" onclick="return confirm('Supprimer ce produit ?')">Supprimer</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
