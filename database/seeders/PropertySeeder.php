<?php

namespace Database\Seeders;

use App\Models\Property;
use Illuminate\Database\Seeder;

class PropertySeeder extends Seeder
{
    public function run(): void
    {
        $properties = [
            [
                'name' => 'Villa Vue Mer',
                'description' => 'Magnifique villa avec vue sur la mer, 4 chambres, piscine privée',
                'price_per_night' => 350.00,
                'status' => 'available',
            ],
            [
                'name' => 'Appartement Centre-Ville',
                'description' => 'Bel appartement rénové en plein centre, 2 chambres',
                'price_per_night' => 150.00,
                'status' => 'available',
            ],
            [
                'name' => 'Chalet Montagne',
                'description' => 'Chalet authentique avec vue sur les montagnes, 3 chambres',
                'price_per_night' => 250.00,
                'status' => 'available',
            ],
            [
                'name' => 'Studio Moderne',
                'description' => 'Studio moderne et confortable, parfait pour un couple',
                'price_per_night' => 80.00,
                'status' => 'available',
            ],
            [
                'name' => 'Maison de Campagne',
                'description' => 'Grande maison avec jardin, 5 chambres, idéale pour les familles',
                'price_per_night' => 200.00,
                'status' => 'available',
            ],
        ];

        foreach ($properties as $property) {
            Property::create($property);
        }
    }
}