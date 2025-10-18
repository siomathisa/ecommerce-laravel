<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'E-Commerce') }}</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100 min-h-screen flex flex-col">

    <!-- Navbar Desktop -->
    <header class="bg-gray-800 text-white hidden sm:flex">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <!-- Liens principaux gauche -->
            <div class="flex items-center space-x-6">
                <a href="{{ url('/') }}" class="font-bold text-lg hover:text-yellow-300">🏠 Accueil</a>
                <a href="{{ route('products.index') }}" class="hover:text-yellow-300">🛍️ Produits</a>

                @auth
                <a href="{{ route('cart.index') }}" class="flex items-center gap-1 text-white hover:text-yellow-300 relative">
                    🛒 Panier
                    @php
                    $count = \App\Models\CartItem::where('user_id', auth()->id())->count();
                    @endphp
                    @if($count > 0)
                    <span class="absolute -top-2 -right-3 bg-yellow-500 text-white text-xs px-2 py-0.5 rounded-full">{{ $count }}</span>
                    @endif
                </a>
                @endauth
                @auth
                <a href="{{ route('orders.index') }}" class="hover:text-yellow-300">📦 Mes commandes</a>
                @endauth

            </div>

            <!-- Utilisateur / admin / logout droite -->
            <div class="flex items-center space-x-4">
                @auth
                <span class="hidden sm:inline">Salut, {{ Auth::user()->name }}</span>

                @if(Auth::user()->is_admin)
                <a href="{{ route('admin.products.index') }}"
                    class="bg-yellow-500 hover:bg-yellow-600 px-3 py-1 rounded transition">
                    Produits
                </a>
                <a href="{{ route('admin.orders.index') }}"
                    class="bg-yellow-500 hover:bg-yellow-600 px-3 py-1 rounded transition">
                    Commandes
                </a>
                @endif


                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="bg-red-500 hover:bg-red-600 px-3 py-1 rounded transition">Déconnexion</button>
                </form>
                @else
                <a href="{{ route('login') }}" class="bg-blue-500 hover:bg-blue-600 px-3 py-1 rounded transition">Connexion</a>
                @endauth
            </div>
        </div>
    </header>

    <!-- Navbar Mobile -->
    <div class="sm:hidden bg-gray-800 text-white px-4 py-2 flex justify-between items-center">
        <span class="font-bold text-lg">Menu</span>
        <button id="mobile-toggle" class="focus:outline-none text-2xl">&#9776;</button>
    </div>

    <div id="mobile-menu" class="sm:hidden hidden bg-gray-700 text-white px-4 py-2 flex flex-col space-y-2">
        <a href="{{ url('/') }}" class="hover:text-yellow-300">🏠 Accueil</a>
        <a href="{{ route('products.index') }}" class="hover:text-yellow-300">🛍️ Produits</a>

        @auth
        <a href="{{ route('cart.index') }}" class="hover:text-yellow-300 flex items-center justify-between">
            🛒 Panier
            @php
            $count = \App\Models\CartItem::where('user_id', auth()->id())->count();
            @endphp
            @if($count > 0)
            <span class="bg-yellow-500 text-white text-xs px-2 py-0.5 rounded-full">{{ $count }}</span>
            @endif
        </a>
        @endauth
        @auth
        <a href="{{ route('orders.index') }}" class="hover:text-yellow-300">📦 Mes commandes</a>
        @endauth


        @auth
        @if(Auth::user()->is_admin)
        <a href="{{ route('admin.products.index') }}"
            class="bg-yellow-500 hover:bg-yellow-600 px-3 py-1 rounded transition">
            Produits
        </a>
        <a href="{{ route('admin.orders.index') }}"
            class="bg-yellow-500 hover:bg-yellow-600 px-3 py-1 rounded transition">
            Commandes
        </a>
        @endif

        <form action="{{ route('logout') }}" method="POST" class="inline">
            @csrf
            <button type="submit" class="bg-red-500 hover:bg-red-600 px-3 py-1 rounded transition w-full text-left">Déconnexion</button>
        </form>
        @else
        <a href="{{ route('login') }}" class="bg-blue-500 hover:bg-blue-600 px-3 py-1 rounded transition">Connexion</a>
        @endauth
    </div>

    <!-- Main content -->
    <main class="flex-grow container mx-auto px-4 py-6">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white text-center py-4">
        &copy; {{ date('Y') }} {{ config('app.name', 'E-Commerce') }}. Tous droits réservés.
    </footer>

    <!-- Script menu mobile -->
    <script>
        const toggle = document.getElementById('mobile-toggle');
        const menu = document.getElementById('mobile-menu');
        toggle?.addEventListener('click', () => {
            menu.classList.toggle('hidden');
        });
    </script>

</body>

</html>