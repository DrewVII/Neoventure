<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    // Méthode pour afficher la liste des propriétés
    public function index()
    {
        $properties = Property::with('bookings')
            ->latest()
            ->paginate(9); // Pagination avec 9 éléments par page
            
        return view('properties.index', compact('properties'));
    }
    
    // Méthode pour afficher les détails d'une propriété
    // La liaison de modèle route (Property $property) injecte automatiquement
    // l'instance de Property correspondant à l'ID dans l'URL
    public function show(Property $property)
    {
        $property->load('bookings');
        
        return view('properties.show', compact('property'));
    }

    public function create()
    {
        $this->authorize('create', Property::class);
        return view('properties.create');
    }

    public function store(Request $request)
    {
        $this->authorize('create', Property::class);
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price_per_night' => 'required|numeric|min:0',
            'status' => 'required|in:available,unavailable',
        ]);

        $property = Property::create($validated);

        return redirect()->route('properties.show', $property)
            ->with('success', 'Propriété créée avec succès.');
    }

    public function edit(Property $property)
    {
        $this->authorize('update', $property);
        return view('properties.edit', compact('property'));
    }

    public function update(Request $request, Property $property)
    {
        $this->authorize('update', $property);
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price_per_night' => 'required|numeric|min:0',
            'status' => 'required|in:available,unavailable',
        ]);

        $property->update($validated);

        return redirect()->route('properties.show', $property)
            ->with('success', 'Propriété mise à jour avec succès.');
    }

    public function destroy(Property $property)
    {
        $this->authorize('delete', $property);
        
        $property->delete();

        return redirect()->route('properties.index')
            ->with('success', 'Propriété supprimée avec succès.');
    }
}