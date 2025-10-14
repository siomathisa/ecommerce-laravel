<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'E-Commerce') }}</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 min-h-screen flex flex-col">

    <!-- Header -->
    <header class="bg-gray-800 text-white">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <div class="flex items-center space-x-4">
                <a href="{{ url('/') }}" class="font-bold text-lg hover:text-yellow-300">Accueil</a>
                <a href="{{ route('products.index') }}" class="hover:text-yellow-300">Produits</a>
            </div>

            <div class="flex items-center space-x-4">
                @auth
                    <span class="hidden sm:inline">Salut, {{ Auth::user()->name }}</span>

                    @if(Auth::user()->is_admin)
                        <a href="{{ route('admin.products.index') }}" class="bg-yellow-500 hover:bg-yellow-600 px-3 py-1 rounded transition">Admin</a>
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

    <!-- Mobile menu toggle -->
    <div class="sm:hidden bg-gray-800 text-white px-4 py-2 flex justify-between items-center">
        <span class="font-bold text-lg">Menu</span>
        <button id="mobile-toggle" class="focus:outline-none">
            &#9776;
        </button>
    </div>

    <!-- Mobile menu -->
    <div id="mobile-menu" class="sm:hidden hidden bg-gray-700 text-white px-4 py-2 flex flex-col space-y-2">
        <a href="{{ url('/') }}" class="hover:text-yellow-300">Accueil</a>
        <a href="{{ route('products.index') }}" class="hover:text-yellow-300">Produits</a>

        @auth
            @if(Auth::user()->is_admin)
                <a href="{{ route('admin.products.index') }}" class="bg-yellow-500 hover:bg-yellow-600 px-3 py-1 rounded transition">Admin</a>
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

    <!-- Script pour menu mobile -->
    <script>
        const toggle = document.getElementById('mobile-toggle');
        const menu = document.getElementById('mobile-menu');
        toggle?.addEventListener('click', () => {
            menu.classList.toggle('hidden');
        });
    </script>
</body>
</html>
