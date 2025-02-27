<x-app-layout>
    <x-slot name="title">Nos Propriétés</x-slot>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Nos Propriétés d\'Exception') }}
            </h2>
            @can('create', App\Models\Property::class)
                <a href="{{ route('properties.create') }}" 
                   class="btn-primary">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                    </svg>
                    Ajouter une propriété
                </a>
            @endcan
        </div>
    </x-slot>

    <!-- Filtres et recherche -->
    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-lg shadow p-6 mb-6">
                <form action="{{ route('properties.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div>
                        <label for="price_min" class="block text-sm font-medium text-gray-700">Prix minimum</label>
                        <input type="number" name="price_min" id="price_min" 
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                               value="{{ request('price_min') }}">
                    </div>
                    <div>
                        <label for="price_max" class="block text-sm font-medium text-gray-700">Prix maximum</label>
                        <input type="number" name="price_max" id="price_max" 
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                               value="{{ request('price_max') }}">
                    </div>
                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700">Statut</label>
                        <select name="status" id="status" 
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="">Tous</option>
                            <option value="available" {{ request('status') === 'available' ? 'selected' : '' }}>Disponible</option>
                            <option value="unavailable" {{ request('status') === 'unavailable' ? 'selected' : '' }}>Indisponible</option>
                        </select>
                    </div>
                    <div class="flex items-end">
                        <button type="submit" class="btn-secondary w-full">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                            Filtrer
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Liste des propriétés -->
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($properties as $property)
                    <div class="bg-white overflow-hidden shadow-sm rounded-lg hover:shadow-lg transition-shadow duration-300">
                        <!-- Image de la propriété -->
                        <div class="relative pb-2/3">
                            <img src="https://images.unsplash.com/photo-1600585154340-be6161a56a0c?ixlib=rb-4.0.3&auto=format&fit=crop&w=1470&q=80" 
                                 alt="{{ $property->name }}"
                                 class="absolute h-full w-full object-cover">
                            <div class="absolute top-4 right-4">
                                <span class="px-3 py-1 rounded-full text-sm font-semibold {{ $property->status === 'available' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ $property->status === 'available' ? 'Disponible' : 'Indisponible' }}
                                </span>
                            </div>
                        </div>

                        <!-- Informations de la propriété -->
                        <div class="p-6">
                            <h3 class="text-xl font-semibold text-gray-900 mb-2">{{ $property->name }}</h3>
                            <p class="text-gray-600 mb-4">{{ Str::limit($property->description, 100) }}</p>
                            
                            <div class="flex items-center justify-between mb-4">
                                <span class="text-2xl font-bold text-indigo-600">
                                    {{ number_format($property->price_per_night, 2) }}€
                                </span>
                                <span class="text-gray-500">par nuit</span>
                            </div>

                            <!-- Actions -->
                            <div class="flex justify-end space-x-2">
                                <a href="{{ route('properties.show', $property) }}" 
                                   class="btn-secondary">
                                    Voir les détails
                                </a>
                                @can('update', $property)
                                    <a href="{{ route('properties.edit', $property) }}" 
                                       class="btn-primary">
                                        Modifier
                                    </a>
                                @endcan
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-3">
                        <div class="bg-white rounded-lg shadow-sm p-6 text-center">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900">Aucune propriété</h3>
                            <p class="mt-1 text-sm text-gray-500">
                                Aucune propriété n'est disponible pour le moment.
                            </p>
                        </div>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            <div class="mt-6">
                {{ $properties->links() }}
            </div>
        </div>
    </div>
</x-app-layout> 