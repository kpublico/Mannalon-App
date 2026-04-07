<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\FarmDetail;
use App\Models\CropReport;
use Illuminate\Support\Facades\DB;

class WelcomeController extends Controller
{
    public function index()
    {
        // Fetch statistics from database
        $totalYieldKg = CropReport::sum('actual_yield_kg') ?? 0;
        $tonsHarvested = $totalYieldKg / 1000; // Convert kg to tons
        
        $stats = [
            'activeFarmers' => User::where('role', 'farmer')
                ->where('status', 'active')
                ->count(),
            'monitoredFarms' => FarmDetail::count(),
            'tonsHarvested' => round($tonsHarvested, 1),
        ];

        return view('welcome', $stats);
    }
}
