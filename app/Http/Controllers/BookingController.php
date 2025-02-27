<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Property;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class BookingController extends Controller
{
    use AuthorizesRequests;

    // Méthode pour afficher la liste des réservations de l'utilisateur
    public function index()
    {
        $bookings = auth()->user()
            ->bookings()
            ->with(['property', 'user'])
            ->latest()
            ->paginate(10); // Pagination avec 10 réservations par page

        return view('bookings.index', compact('bookings'));
    }

    // Méthode pour afficher les détails d'une réservation
    // La liaison de modèle route (Booking $booking) injecte automatiquement la réservation
    public function show(Booking $booking)
    {
        // Vérification que l'utilisateur peut voir cette réservation
        $this->authorize('view', $booking);
        
        // Charge la relation property si pas déjà chargée
        $booking->load(['property', 'user']);
        
        // Retourne la vue avec la réservation
        return view('bookings.show', compact('booking'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'property_id' => 'required|exists:properties,id',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after:start_date',
        ]);

        // Calcul du prix total
        $property = Property::findOrFail($validated['property_id']);
        $start = Carbon::parse($validated['start_date']);
        $end = Carbon::parse($validated['end_date']);
        $nights = $end->diffInDays($start);
        $total_price = $property->price_per_night * $nights;

        $booking = Booking::create([
            'user_id' => auth()->id(),
            'property_id' => $validated['property_id'],
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
            'total_price' => $total_price,
        ]);

        return redirect()->route('bookings.show', $booking)
            ->with('success', 'Réservation créée avec succès!');
    }

    public function cancel(Booking $booking)
    {
        // Vérifier que l'utilisateur est autorisé à annuler cette réservation
        $this->authorize('cancel', $booking);

        // Annuler la réservation
        $booking->delete();

        return redirect()->route('bookings.index')
            ->with('success', 'Votre réservation a été annulée avec succès.');
    }
}