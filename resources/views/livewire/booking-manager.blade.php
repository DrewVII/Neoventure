<div class="p-4 bg-white rounded-lg shadow-md">
    <!-- Affiche les messages de succès -->
    @if (session()->has('message'))
        <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg">
            {{ session('message') }}
        </div>
    @endif
    
    <!-- Affiche les messages d'erreur -->
    @if (session()->has('error'))
        <div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg">
            {{ session('error') }}
        </div>
    @endif

    <!-- Formulaire de réservation -->
    <!-- wire:submit.prevent="createBooking" est un événement Livewire qui appelle 
         la méthode createBooking quand le formulaire est soumis, en empêchant le 
         rechargement de la page -->
    <form wire:submit.prevent="createBooking" class="space-y-4">
        <div>
            <label for="property_id" class="block text-sm font-medium text-gray-700">Propriété</label>
            <!-- wire:model lie ce champ à la propriété $property_id du composant -->
            <select id="property_id" wire:model="property_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50">
                <option value="">Sélectionner une propriété</option>
                @foreach($properties as $property)
                    <option value="{{ $property->id }}">{{ $property->name }} ({{ $property->price_per_night }}€/nuit)</option>
                @endforeach
            </select>
            <!-- Affiche les erreurs de validation -->
            @error('property_id') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label for="start_date" class="block text-sm font-medium text-gray-700">Date d'arrivée</label>
                <!-- wire:model lie ce champ à la propriété $start_date du composant -->
                <input type="date" id="start_date" wire:model="start_date" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50">
                @error('start_date') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
            
            <div>
                <label for="end_date" class="block text-sm font-medium text-gray-700">Date de départ</label>
                <!-- wire:model lie ce champ à la propriété $end_date du composant -->
                <input type="date" id="end_date" wire:model="end_date" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50">
                @error('end_date') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
        </div>
        
        <button type="submit" class="w-full px-4 py-2 text-sm font-medium text-white bg-primary rounded-md hover:bg-primary-dark focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
            Réserver
        </button>
    </form>
    
    <!-- Affiche les réservations existantes -->
    @if(count($bookings) > 0)
        <div class="mt-6">
            <h3 class="text-lg font-medium text-gray-900">Réservations existantes</h3>
            <div class="mt-2 space-y-2">
                @foreach($bookings as $booking)
                    <div class="p-3 bg-gray-50 rounded-md">
                        <p class="text-sm text-gray-600">
                            <span class="font-medium">{{ $booking->user->name }}</span> • 
                            Du {{ \Carbon\Carbon::parse($booking->start_date)->format('d/m/Y') }} 
                            au {{ \Carbon\Carbon::parse($booking->end_date)->format('d/m/Y') }}
                        </p>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</div>