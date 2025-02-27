<x-app-layout>
    <x-slot name="title">Tableau de bord</x-slot>
    <div class="relative bg-indigo-600">
        <div class="absolute inset-0">
            <img class="w-full h-full object-cover" src="https://images.unsplash.com/photo-1564013799919-ab600027ffc6?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1470&q=80" alt="Luxury home">
            <div class="absolute inset-0 bg-indigo-600 mix-blend-multiply"></div>
        </div>
        
        <div class="relative max-w-7xl mx-auto py-24 px-4 sm:py-32 sm:px-6 lg:px-8">
            <h1 class="text-4xl font-extrabold tracking-tight text-white sm:text-5xl lg:text-6xl">Bienvenue sur Neoventure</h1>
            <p class="mt-6 text-xl text-indigo-100 max-w-3xl">Découvrez des propriétés d'exception pour vos séjours inoubliables. Location de villas, appartements et maisons de luxe dans les plus belles destinations.</p>
            <div class="mt-10">
                <a href="{{ route('properties.index') }}" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-indigo-600 bg-white hover:bg-indigo-50">
                    Découvrir nos propriétés
                </a>
            </div>
        </div>
    </div>

    <!-- Featured Properties Section -->
    <div class="py-12 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h2 class="text-3xl font-extrabold text-gray-900 sm:text-4xl">
                    Propriétés en vedette
                </h2>
                <p class="mt-3 max-w-2xl mx-auto text-xl text-gray-500 sm:mt-4">
                    Découvrez notre sélection de propriétés exceptionnelles
                </p>
            </div>

            <div class="mt-12 grid gap-8 md:grid-cols-2 lg:grid-cols-3">
                @foreach($featuredProperties ?? [] as $property)
                    <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                        <div class="relative pb-2/3">
                            <img class="absolute h-full w-full object-cover" src="https://images.unsplash.com/photo-1512917774080-9991f1c4c750?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="{{ $property->name }}">
                        </div>
                        <div class="p-6">
                            <h3 class="text-lg font-semibold text-gray-900">{{ $property->name }}</h3>
                            <p class="mt-2 text-gray-500">{{ Str::limit($property->description, 100) }}</p>
                            <div class="mt-4 flex justify-between items-center">
                                <span class="text-indigo-600 font-semibold">{{ number_format($property->price_per_night, 2) }}€ / nuit</span>
                                <a href="{{ route('properties.show', $property) }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">
                                    Voir plus
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <div class="bg-gray-50 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h2 class="text-3xl font-extrabold text-gray-900 sm:text-4xl">
                    Pourquoi choisir Neoventure ?
                </h2>
            </div>

            <div class="mt-12 grid gap-8 md:grid-cols-3">
                <div class="text-center">
                    <div class="flex items-center justify-center h-12 w-12 rounded-md bg-indigo-600 text-white mx-auto">
                        <!-- Heroicon name: outline/check -->
                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                    <h3 class="mt-6 text-lg font-medium text-gray-900">Propriétés vérifiées</h3>
                    <p class="mt-2 text-base text-gray-500">Toutes nos propriétés sont soigneusement sélectionnées et vérifiées.</p>
                </div>

                <div class="text-center">
                    <div class="flex items-center justify-center h-12 w-12 rounded-md bg-indigo-600 text-white mx-auto">
                        <!-- Heroicon name: outline/shield-check -->
                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                    </div>
                    <h3 class="mt-6 text-lg font-medium text-gray-900">Réservation sécurisée</h3>
                    <p class="mt-2 text-base text-gray-500">Paiements sécurisés et confirmation instantanée.</p>
                </div>

                <div class="text-center">
                    <div class="flex items-center justify-center h-12 w-12 rounded-md bg-indigo-600 text-white mx-auto">
                        <!-- Heroicon name: outline/phone -->
                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                        </svg>
                    </div>
                    <h3 class="mt-6 text-lg font-medium text-gray-900">Support 24/7</h3>
                    <p class="mt-2 text-base text-gray-500">Notre équipe est disponible pour vous assister à tout moment.</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
