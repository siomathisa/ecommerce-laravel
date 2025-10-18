<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenue sur {{ config('app.name', 'E-Commerce Laravel') }}</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 flex flex-col items-center justify-center min-h-screen text-center">

    <div class="space-y-6">
        <!-- Logo Laravel -->
        <img src="https://laravel.com/img/logomark.min.svg" alt="Laravel" class="w-24 mx-auto animate-pulse">

        <!-- Texte d'accueil -->
        <h1 class="text-3xl font-bold text-gray-800">Bienvenue sur mon site e-commerce 🚀</h1>
        <p class="text-gray-600 max-w-lg mx-auto">
            Un projet développé avec <span class="font-semibold text-red-500">Laravel</span> et 
            <span class="font-semibold text-blue-500">TailwindCSS</span>
        </p>

        <!-- Boutons -->
        <div class="flex flex-col sm:flex-row justify-center items-center gap-3 mt-6">
            <a href="{{ route('products.index') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-5 py-2 rounded shadow transition">
                🛍️ Voir les produits
            </a>

            <a href="{{ route('login') }}" class="bg-gray-700 hover:bg-gray-800 text-white px-5 py-2 rounded shadow transition">
                🔑 Se connecter
            </a>

            <a href="{{ route('register') }}" class="bg-green-500 hover:bg-green-600 text-white px-5 py-2 rounded shadow transition">
                ✨ Créer un compte
            </a>
        </div>
    </div>

    <!-- Footer -->
    <footer class="mt-10 text-gray-500 text-sm">
        &copy; {{ date('Y') }} {{ config('app.name', 'E-Commerce Laravel') }} — Propulsé par Laravel ⚡
    </footer>

</body>
</html>
