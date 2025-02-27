<x-guest-layout>
    <!-- Section principale avec image de fond -->
    <div class="min-h-screen flex">
        <!-- Partie gauche : Image décorative -->
        <div class="hidden lg:block lg:w-1/2 relative">
            <div class="absolute inset-0">
                <img src="https://images.unsplash.com/photo-1512917774080-9991f1c4c750?ixlib=rb-4.0.3&auto=format&fit=crop&w=1470&q=80" 
                     alt="Luxury Home" 
                     class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-indigo-900 bg-opacity-40"></div>
            </div>
            <!-- Texte superposé sur l'image -->
            <div class="absolute inset-0 flex items-center justify-center">
                <div class="text-white text-center">
                    <h2 class="text-4xl font-bold mb-4">Rejoignez Neoventure</h2>
                    <p class="text-xl">Créez votre compte et commencez l'aventure</p>
                </div>
            </div>
        </div>

        <!-- Partie droite : Formulaire d'inscription -->
        <div class="w-full lg:w-1/2 flex items-center justify-center p-8">
            <div class="w-full max-w-md">
                <!-- Logo -->
                <div class="text-center mb-8">
                    <a href="/" class="inline-flex items-center">
                        <span class="text-3xl font-bold text-indigo-600">Neo</span>
                        <span class="text-3xl font-bold text-gray-900">venture</span>
                    </a>
                </div>

                <!-- Formulaire d'inscription -->
                <form method="POST" action="{{ route('register') }}" class="space-y-6">
                    @csrf

                    <!-- Champ Nom -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">
                            Nom
                        </label>
                        <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Champ Email -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">
                            Email
                        </label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        @error('email')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Champ Mot de passe -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700">
                            Mot de passe
                        </label>
                        <input id="password" type="password" name="password" required
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        @error('password')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Champ Confirmation du mot de passe -->
                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700">
                            Confirmer le mot de passe
                        </label>
                        <input id="password_confirmation" type="password" name="password_confirmation" required
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>

                    <!-- Bouton d'inscription -->
                    <button type="submit"
                            class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        S'inscrire
                    </button>

                    <!-- Lien de connexion -->
                    <div class="text-center">
                        <span class="text-sm text-gray-600">Déjà inscrit ?</span>
                        <a href="{{ route('login') }}"
                           class="ml-1 text-sm font-medium text-indigo-600 hover:text-indigo-500">
                            Se connecter
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
