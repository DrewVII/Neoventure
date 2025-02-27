<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Détails de la réservation') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h3 class="text-lg font-semibold mb-4">Informations de réservation</h3>
                            <div class="space-y-4">
                                <p><span class="font-medium">Propriété :</span> {{ $booking->property->name }}</p>
                                <p><span class="font-medium">Dates :</span> 
                                    Du {{ $booking->start_date->format('d/m/Y') }}
                                    au {{ $booking->end_date->format('d/m/Y') }}
                                </p>
                                <p><span class="font-medium">Durée :</span> 
                                    {{ $booking->start_date->diffInDays($booking->end_date) }} nuits
                                </p>
                                <p><span class="font-medium">Prix total :</span> 
                                    {{ number_format($booking->total_price, 2) }} €
                                </p>
                            </div>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold mb-4">Détails de la propriété</h3>
                            <div class="space-y-4">
                                <p>{{ $booking->property->description }}</p>
                                <p><span class="font-medium">Prix par nuit :</span> 
                                    {{ number_format($booking->property->price_per_night, 2) }} €
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
