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
        $stats = [
            'activeFarmers' => User::where('role', 'farmer')
                ->where('status', 'active')
                ->count(),
            'monitoredFarms' => FarmDetail::count(),
            'tonsHarvested' => (CropReport::sum('actual_yield_kg') ?? 0) / 1000, // Convert kg to tons
        ];

        return view('welcome', $stats);
    }
}
