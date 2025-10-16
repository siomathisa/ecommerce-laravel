@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto mt-8">
    <h1 class="text-2xl font-bold mb-6">📦 Mes Commandes</h1>

    @if ($orders->isEmpty())
        <p>Vous n'avez encore passé aucune commande.</p>
    @else
        <div class="space-y-6">
            @foreach ($orders as $order)
                <div class="bg-white p-4 rounded shadow">
                    <div class="flex justify-between items-center">
                        <div>
                            <h2 class="font-semibold text-lg">Commande n°{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}
</h2>
                            <p class="text-gray-500 text-sm">
                                Passée le {{ $order->created_at->format('d/m/Y à H:i') }}
                            </p>
                            <p class="text-sm mt-1">Statut : 
                                <span class="font-semibold {{ $order->status === 'en cours' ? 'text-yellow-600' : 'text-green-600' }}">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </p>
                        </div>
                        <p class="font-bold text-lg">{{ number_format($order->total, 2) }} €</p>
                    </div>

                    <hr class="my-3">

                    <ul class="text-sm">
                        @foreach ($order->items as $item)
                            <li class="flex justify-between py-1">
                                <span>{{ $item->product->name }} × {{ $item->quantity }}</span>
                                <span>{{ number_format($item->price * $item->quantity, 2) }} €</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
