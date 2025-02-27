<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'description',
        'price_per_night',
        'status', // 'available' ou 'unavailable'
    ];
    
    protected $casts = [
        'price_per_night' => 'decimal:2',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
    
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function isAvailable($start_date, $end_date)
    {
        return !$this->bookings()
            ->where(function($query) use ($start_date, $end_date) {
                $query->whereBetween('start_date', [$start_date, $end_date])
                    ->orWhereBetween('end_date', [$start_date, $end_date])
                    ->orWhere(function($q) use ($start_date, $end_date) {
                        $q->where('start_date', '<=', $start_date)
                          ->where('end_date', '>=', $end_date);
                    });
            })
            ->exists();
    }
}
