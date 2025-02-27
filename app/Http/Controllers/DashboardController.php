<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $featuredProperties = Property::where('status', 'available')
            ->latest()
            ->take(6)
            ->get();

        return view('dashboard', compact('featuredProperties'));
    }
} 