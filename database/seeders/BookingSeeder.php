<?php

namespace Database\Seeders;

use App\Models\Booking;
use App\Models\Property;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class BookingSeeder extends Seeder
{
    public function run(): void
    {
        // Assurez-vous d'avoir au moins un utilisateur
        $user = User::first();
        
        if (!$user) {
            $user = User::create([
                'name' => 'Test User',
                'email' => 'test@example.com',
                'password' => bcrypt('password'),
            ]);
        }

        // Créer quelques réservations
        $properties = Property::all();
        
        foreach ($properties as $property) {
            // Réservation pour le mois prochain
            $startDate = Carbon::now()->addMonth()->startOfMonth();
            $endDate = $startDate->copy()->addDays(5);
            
            Booking::create([
                'user_id' => $user->id,
                'property_id' => $property->id,
                'start_date' => $startDate,
                'end_date' => $endDate,
                'total_price' => $property->price_per_night * 5,
            ]);

            // Réservation pour dans deux mois
            $startDate = Carbon::now()->addMonths(2)->startOfMonth();
            $endDate = $startDate->copy()->addDays(3);
            
            Booking::create([
                'user_id' => $user->id,
                'property_id' => $property->id,
                'start_date' => $startDate,
                'end_date' => $endDate,
                'total_price' => $property->price_per_night * 3,
            ]);
        }
    }
}