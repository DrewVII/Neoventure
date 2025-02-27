<x-app-layout>
    <x-slot name="title">Mes Réservations</x-slot>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Mes Réservations') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <!-- Filtres -->
            <div class="bg-white overflow-hidden shadow-sm rounded-lg mb-6">
                <div class="p-6">
                    <form action="{{ route('bookings.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700">Statut</label>
                            <select name="status" id="status" 
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="">Tous</option>
                                <option value="upcoming" {{ request('status') === 'upcoming' ? 'selected' : '' }}>À venir</option>
                                <option value="past" {{ request('status') === 'past' ? 'selected' : '' }}>Passées</option>
                                <option value="cancelled" {{ request('status') === 'cancelled' ? 'selected' : '' }}>Annulées</option>
                            </select>
                        </div>
                        <div>
                            <label for="date" class="block text-sm font-medium text-gray-700">Date</label>
                            <input type="month" name="date" id="date" 
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                   value="{{ request('date') }}">
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

            <!-- Liste des réservations -->
            <div class="space-y-6">
                @forelse($bookings as $booking)
                    <div class="bg-white overflow-hidden shadow-sm rounded-lg hover:shadow-md transition-shadow duration-300">
                        <div class="p-6">
                            <div class="flex flex-col md:flex-row justify-between">
                                <!-- Informations de la propriété -->
                                <div class="flex-1">
                                    <div class="flex items-start space-x-4">
                                        <div class="w-24 h-24 rounded-lg overflow-hidden">
                                            <img src="https://images.unsplash.com/photo-1600585154340-be6161a56a0c?ixlib=rb-4.0.3&auto=format&fit=crop&w=1470&q=80" 
                                                 alt="{{ $booking->property->name }}"
                                                 class="w-full h-full object-cover">
                                        </div>
                                        <div>
                                            <h3 class="text-lg font-semibold text-gray-900">
                                                {{ $booking->property->name }}
                                            </h3>
                                            <p class="text-gray-500 text-sm">
                                                Réservation #{{ $booking->id }}
                                            </p>
                                            <div class="mt-2 flex items-center space-x-2">
                                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                                </svg>
                                                <span class="text-gray-600">
                                                    Du {{ $booking->start_date->format('d/m/Y') }} au {{ $booking->end_date->format('d/m/Y') }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Prix et statut -->
                                <div class="mt-4 md:mt-0 md:ml-6 flex flex-col items-end justify-between">
                                    <div class="text-right">
                                        <span class="text-2xl font-bold text-indigo-600">
                                            {{ number_format($booking->total_price, 2) }}€
                                        </span>
                                        <p class="text-sm text-gray-500">
                                            {{ $booking->nights_count }} nuit(s) à {{ number_format($booking->property->price_per_night, 2) }}€
                                        </p>
                                    </div>

                                    <div class="mt-4 flex space-x-2">
                                        @if($booking->start_date->isFuture())
                                            <form action="{{ route('bookings.cancel', $booking) }}" method="POST" 
                                                  onsubmit="return confirm('Êtes-vous sûr de vouloir annuler cette réservation ?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn-secondary text-sm">
                                                    Annuler
                                                </button>
                                            </form>
                                        @endif
                                        <a href="{{ route('properties.show', $booking->property) }}" class="btn-primary text-sm">
                                            Voir la propriété
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="bg-white rounded-lg shadow-sm p-6 text-center">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900">Aucune réservation</h3>
                        <p class="mt-1 text-sm text-gray-500">
                            Vous n'avez pas encore effectué de réservation.
                        </p>
                        <div class="mt-6">
                            <a href="{{ route('properties.index') }}" class="btn-primary">
                                Découvrir nos propriétés
                            </a>
                        </div>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            <div class="mt-6">
                {{ $bookings->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
