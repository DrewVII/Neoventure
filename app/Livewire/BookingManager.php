<?php

namespace App\Livewire;

use Livewire\Component;

use App\Models\Booking;
use App\Models\Property;

class BookingManager extends Component
{
    // Propriétés publiques qui seront liées au formulaire HTML
    public $property_id;
    public $start_date;
    public $end_date;
    public $bookings = [];
    public $total_price = 0;
    
    // Règles de validation pour les champs du formulaire
    protected $rules = [
        'property_id' => 'required|exists:properties,id',  // Doit exister dans la table properties
        'start_date' => 'required|date|after_or_equal:today',  // Date qui doit être >= aujourd'hui
        'end_date' => 'required|date|after:start_date',  // Date qui doit être > start_date
    ];
    
    // Méthode appelée à l'initialisation du composant
    public function mount($propertyId = null)
    {
        $this->property_id = $propertyId;  // Initialise avec l'ID de propriété passé en paramètre
        $this->loadBookings();  // Charge les réservations existantes
    }
    
    // Méthode pour charger les réservations d'une propriété
    public function loadBookings()
    {
        if ($this->property_id) {
            $this->bookings = Booking::where('property_id', $this->property_id)
                ->with('user')  // Charge aussi les données utilisateur (relation eager loading)
                ->get();
        }
    }
    
    // Méthode appelée quand le formulaire est soumis
    public function createBooking()
    {
        $this->validate();  // Vérifie les règles de validation définies plus haut
        
        // Vérifie si les dates ne chevauchent pas d'autres réservations
        $conflictingBookings = Booking::where('property_id', $this->property_id)
            ->where(function($query) {
                $query->whereBetween('start_date', [$this->start_date, $this->end_date])
                    ->orWhereBetween('end_date', [$this->start_date, $this->end_date])
                    ->orWhere(function($q) {
                        $q->where('start_date', '<=', $this->start_date)
                            ->where('end_date', '>=', $this->end_date);
                    });
            })
            ->count();
            
        if ($conflictingBookings > 0) {
            session()->flash('error', 'Ces dates sont déjà réservées.');
            return;
        }
        
        $this->calculateTotalPrice();
        
        // Crée une nouvelle réservation
        Booking::create([
            'user_id' => auth()->id(),  // ID de l'utilisateur connecté
            'property_id' => $this->property_id,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'total_price' => $this->total_price
        ]);
        
        // Réinitialise les champs du formulaire
        $this->reset(['start_date', 'end_date']);
        // Recharge les réservations pour mettre à jour la liste
        $this->loadBookings();
        
        // Affiche un message de succès
        session()->flash('message', 'Réservation créée avec succès!');
        // Émet un événement que d'autres composants peuvent écouter
        $this->dispatch('booking-created');
    }
    
    public function calculateTotalPrice()
    {
        if ($this->property_id && $this->start_date && $this->end_date) {
            $property = Property::find($this->property_id);
            $start = \Carbon\Carbon::parse($this->start_date);
            $end = \Carbon\Carbon::parse($this->end_date);
            $nights = $end->diffInDays($start);
            $this->total_price = $property->price_per_night * $nights;
        }
    }

    public function updatedStartDate()
    {
        $this->calculateTotalPrice();
    }

    public function updatedEndDate()
    {
        $this->calculateTotalPrice();
    }
    
    // Méthode appelée à chaque rendu du composant
    public function render()
    {
        $properties = Property::all();  // Charge toutes les propriétés
        return view('livewire.booking-manager', [
            'properties' => $properties,  // Passe les propriétés à la vue
        ]);
    }
}
