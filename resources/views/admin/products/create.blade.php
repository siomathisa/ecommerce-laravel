@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-bold mb-4">Ajouter un produit</h1>

<form action="{{ route('admin.products.store') }}" method="POST" class="space-y-4">
    @csrf

    <div>
        <label class="block mb-1 font-medium">Nom</label>
        <input type="text" name="name" class="w-full border rounded px-3 py-2" value="{{ old('name') }}">
        @error('name') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="block mb-1 font-medium">Description</label>
        <textarea name="description" class="w-full border rounded px-3 py-2">{{ old('description') }}</textarea>
        @error('description') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="block mb-1 font-medium">Prix (€)</label>
        <input type="number" step="0.01" name="price" class="w-full border rounded px-3 py-2" value="{{ old('price') }}">
        @error('price') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="block mb-1 font-medium">Stock</label>
        <input type="number" name="stock" class="w-full border rounded px-3 py-2" value="{{ old('stock') }}">
        @error('stock') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
    </div>

    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Ajouter</button>
</form>
@endsection
