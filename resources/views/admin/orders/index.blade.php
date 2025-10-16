@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto mt-8">
    <h1 class="text-2xl font-bold mb-6">📋 Gestion des Commandes</h1>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if ($orders->isEmpty())
        <p>Aucune commande pour le moment.</p>
    @else
        <table class="w-full bg-white rounded shadow border-collapse">
            <thead class="bg-gray-200 text-left">
                <tr>
                    <th class="p-3 border-b">ID</th>
                    <th class="p-3 border-b">Utilisateur</th>
                    <th class="p-3 border-b">Date</th>
                    <th class="p-3 border-b">Total</th>
                    <th class="p-3 border-b">Statut</th>
                    <th class="p-3 border-b">Produits</th>
                    <th class="p-3 border-b">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="p-3">#{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</td>
                        <td class="p-3">{{ $order->user->name }}</td>
                        <td class="p-3">{{ $order->created_at->format('d/m/Y H:i') }}</td>
                        <td class="p-3 font-semibold">{{ number_format($order->total, 2) }} €</td>
                        <td class="p-3">
                            <form action="{{ route('admin.orders.updateStatus', $order) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <select name="status" class="border rounded px-2 py-1 text-sm" onchange="this.form.submit()">
                                    <option value="en attente" {{ $order->status === 'en attente' ? 'selected' : '' }}>🕓 En attente</option>
                                    <option value="en cours" {{ $order->status === 'en cours' ? 'selected' : '' }}>🚚 En cours</option>
                                    <option value="expédiée" {{ $order->status === 'expédiée' ? 'selected' : '' }}>📦 Expédiée</option>
                                    <option value="livrée" {{ $order->status === 'livrée' ? 'selected' : '' }}>✅ Livrée</option>
                                </select>
                            </form>
                        </td>
                        <td class="p-3">
                            <ul class="text-sm text-gray-700">
                                @foreach ($order->items as $item)
                                    <li>{{ $item->product->name }} × {{ $item->quantity }}</li>
                                @endforeach
                            </ul>
                        </td>
                        <td class="p-3 text-center">
                            <span class="text-gray-400 text-sm">—</span>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
