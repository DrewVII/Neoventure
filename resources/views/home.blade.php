<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Neoventure</title>
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased">
    <!-- Navigation -->
    <nav class="bg-white bg-opacity-90 fixed w-full z-10 backdrop-blur-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="flex items-center">
                        <span class="text-2xl font-bold text-indigo-600">Neo</span>
                        <span class="text-2xl font-bold text-gray-900">venture</span>
                    </a>
                </div>
                <div class="flex items-center space-x-4">
                    @auth
                        <a href="{{ route('dashboard') }}" class="btn-secondary">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="btn-secondary">
                            Connexion
                        </a>
                        <a href="{{ route('register') }}" class="btn-primary">
                            Inscription
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="relative min-h-screen">
        <div class="absolute inset-0">
            <img src="https://images.unsplash.com/photo-1600596542815-ffad4c1539a9?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80" 
                 class="w-full h-full object-cover" alt="Luxury Villa">
            <div class="absolute inset-0 bg-black opacity-50"></div>
        </div>

        <div class="relative min-h-screen flex items-center">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-32 text-center">
                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold text-white mb-8 fade-in">
                    Découvrez des Propriétés d'Exception
                </h1>
                <p class="text-xl sm:text-2xl text-white mb-12 max-w-3xl mx-auto fade-in">
                    Location de villas et appartements de luxe pour des séjours inoubliables
                </p>
                <div class="space-x-4 fade-in">
                    <a href="{{ route('register') }}" class="btn-primary text-lg py-3 px-8">
                        Commencer l'aventure
                    </a>
                    <a href="#discover" class="btn-secondary text-lg py-3 px-8">
                        En savoir plus
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <section id="discover" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-4">
                    Pourquoi choisir Neoventure ?
                </h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                    Une expérience unique de location de propriétés de luxe
                </p>
            </div>

            <div class="grid md:grid-cols-3 gap-12">
                <div class="text-center">
                    <div class="w-16 h-16 bg-indigo-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-8 h-8 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-4">Propriétés Vérifiées</h3>
                    <p class="text-gray-600">Chaque propriété est minutieusement sélectionnée et inspectée.</p>
                </div>

                <div class="text-center">
                    <div class="w-16 h-16 bg-indigo-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-8 h-8 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-4">Réservation Sécurisée</h3>
                    <p class="text-gray-600">Système de paiement sûr et réservation instantanée.</p>
                </div>

                <div class="text-center">
                    <div class="w-16 h-16 bg-indigo-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-8 h-8 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-4">Support 24/7</h3>
                    <p class="text-gray-600">Une équipe dédiée à votre service à tout moment.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="bg-indigo-600 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl font-bold text-white mb-8">
                Prêt à découvrir votre prochaine destination ?
            </h2>
            <a href="{{ route('register') }}" class="inline-flex items-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-indigo-600 bg-white hover:bg-indigo-50">
                Créer un compte gratuitement
            </a>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-4 gap-8">
                <div>
                    <div class="flex items-center mb-4">
                        <span class="text-2xl font-bold text-indigo-400">Neo</span>
                        <span class="text-2xl font-bold text-white">venture</span>
                    </div>
                    <p class="text-gray-400">
                        Location de propriétés de luxe pour des séjours inoubliables.
                    </p>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-4">Navigation</h3>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="#" class="hover:text-white">Accueil</a></li>
                        <li><a href="#discover" class="hover:text-white">À propos</a></li>
                        <li><a href="{{ route('login') }}" class="hover:text-white">Connexion</a></li>
                        <li><a href="{{ route('register') }}" class="hover:text-white">Inscription</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-4">Légal</h3>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="#" class="hover:text-white">Conditions d'utilisation</a></li>
                        <li><a href="#" class="hover:text-white">Politique de confidentialité</a></li>
                        <li><a href="#" class="hover:text-white">Mentions légales</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-4">Contact</h3>
                    <ul class="space-y-2 text-gray-400">
                        <li>support@neoventure.com</li>
                        <li>+33 1 23 45 67 89</li>
                        <li>Paris, France</li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-800 mt-12 pt-8 text-center text-gray-400">
                <p>© {{ date('Y') }} Neoventure. Tous droits réservés.</p>
            </div>
        </div>
    </footer>
</body>
</html>
