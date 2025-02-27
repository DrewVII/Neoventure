<?php

namespace App\Providers;

use App\Models\Booking;
use App\Policies\BookingPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        // ... existing policies ...
        Booking::class => BookingPolicy::class,
    ];

    public function boot()
    {
        $this->registerPolicies();
    }
} 