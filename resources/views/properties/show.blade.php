<x-app-layout>
    <x-slot name="title">{{ $property->name }}</x-slot>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ $property->name }}
            </h2>
            <div class="flex space-x-4">
                @can('update', $property)
                    <a href="{{ route('properties.edit', $property) }}" class="btn-primary">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                        Modifier
                    </a>
                @endcan
                <a href="{{ route('properties.index') }}" class="btn-secondary">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Retour
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <!-- Galerie d'images -->
            <div class="bg-white overflow-hidden shadow-sm rounded-lg mb-6">
                <div class="relative pb-2/3">
                    <img src="https://images.unsplash.com/photo-1600585154340-be6161a56a0c?ixlib=rb-4.0.3&auto=format&fit=crop&w=1470&q=80" 
                         alt="{{ $property->name }}"
                         class="absolute h-full w-full object-cover">
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Informations principales -->
                <div class="lg:col-span-2">
                    <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                        <div class="p-6">
                            <div class="flex justify-between items-start mb-6">
                                <div>
                                    <h1 class="text-3xl font-bold text-gray-900">{{ $property->name }}</h1>
                                    <p class="text-gray-500 mt-2">Ajoutée le {{ $property->created_at->format('d/m/Y') }}</p>
                                </div>
                                <span class="px-4 py-2 rounded-full text-sm font-semibold {{ $property->status === 'available' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ $property->status === 'available' ? 'Disponible' : 'Indisponible' }}
                                </span>
                            </div>

                            <div class="prose max-w-none">
                                <h3 class="text-xl font-semibold mb-4">Description</h3>
                                <p class="text-gray-600">{{ $property->description }}</p>
                            </div>

                            <div class="mt-8">
                                <h3 class="text-xl font-semibold mb-4">Caractéristiques</h3>
                                <div class="grid grid-cols-2 gap-4">
                                    <div class="flex items-center">
                                        <svg class="w-5 h-5 text-indigo-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                                        </svg>
                                        <span class="text-gray-600">Type: Villa</span>
                                    </div>
                                    <div class="flex items-center">
                                        <svg class="w-5 h-5 text-indigo-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        <span class="text-gray-600">Check-in: 15:00</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Section des réservations -->
                    <div class="bg-white overflow-hidden shadow-sm rounded-lg mt-6">
                        <div class="p-6">
                            <h3 class="text-xl font-semibold mb-4">Réservations à venir</h3>
                            @forelse($property->bookings->where('start_date', '>=', now()) as $booking)
                                <div class="border-b border-gray-200 py-4 last:border-0">
                                    <div class="flex justify-between items-center">
                                        <div>
                                            <p class="font-medium text-gray-900">
                                                Du {{ $booking->start_date->format('d/m/Y') }} au {{ $booking->end_date->format('d/m/Y') }}
                                            </p>
                                            <p class="text-sm text-gray-500">
                                                Réservé par {{ $booking->user->name }}
                                            </p>
                                        </div>
                                        <span class="text-indigo-600 font-semibold">
                                            {{ number_format($booking->total_price, 2) }}€
                                        </span>
                                    </div>
                                </div>
                            @empty
                                <p class="text-gray-500">Aucune réservation à venir.</p>
                            @endforelse
                        </div>
                    </div>
                </div>

                <!-- Sidebar avec prix et réservation -->
                <div class="lg:col-span-1">
                    <div class="bg-white overflow-hidden shadow-sm rounded-lg sticky top-6">
                        <div class="p-6">
                            <div class="text-center mb-6">
                                <span class="text-3xl font-bold text-indigo-600">{{ number_format($property->price_per_night, 2) }}€</span>
                                <span class="text-gray-500">/nuit</span>
                            </div>

                            @if($property->status === 'available')
                                <form action="{{ route('bookings.store') }}" method="POST" class="space-y-4">
                                    @csrf
                                    <input type="hidden" name="property_id" value="{{ $property->id }}">
                                    
                                    <div>
                                        <label for="start_date" class="block text-sm font-medium text-gray-700">Date d'arrivée</label>
                                        <input type="date" name="start_date" id="start_date" required
                                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    </div>

                                    <div>
                                        <label for="end_date" class="block text-sm font-medium text-gray-700">Date de départ</label>
                                        <input type="date" name="end_date" id="end_date" required
                                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    </div>

                                    <button type="submit" class="w-full btn-primary">
                                        Réserver maintenant
                                    </button>
                                </form>
                            @else
                                <div class="text-center p-4 bg-gray-50 rounded-lg">
                                    <p class="text-gray-500">Cette propriété n'est pas disponible à la réservation.</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 