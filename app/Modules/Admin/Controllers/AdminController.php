<?php

namespace App\Modules\Admin\Controllers;

use App\Modules\Auth\Models\User;
use App\Modules\Farm\Models\Crop;
use App\Modules\Farm\Models\Livestock;
use App\Modules\Farmer\Models\Farmer;
use App\Modules\Announcement\Models\Announcement;
use App\Modules\Farmer\Models\FarmerGroup;
use App\Modules\Guide\Models\FarmingGuide;
use App\Modules\Market\Models\CommodityPrice;
use App\Modules\Shared\Models\ServiceAccessLog;
use Illuminate\View\View; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Symfony\Component\HttpFoundation\StreamedResponse;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    /**
     * Display admin dashboard
     */
    public function index(Request $request): View
    {
        $isSuperAdmin = auth()->check() && auth()->user()->isSuperAdmin();

        $dashboardData = [
            'totalUsers' => User::count(),
            'totalAdmins' => User::where('role', 'admin')->count(),
            'totalSuperAdmins' => User::where('role', 'super_admin')->count(),
            'totalFarmers' => User::where('role', 'farmer')->count(),
            'activeFarmers' => User::where('role', 'farmer')->where('status', 'active')->count(),
            'inactiveFarmers' => User::where('role', 'farmer')->where('status', 'inactive')->count(),
            'totalCrops' => Crop::count(),
            'totalLivestock' => Livestock::count(),
            'totalAnnouncements' => Announcement::count(),
            'totalGuides' => FarmingGuide::count(),
            'totalCommodityRows' => CommodityPrice::count(),
            'activeUsers' => User::where('status', 'active')->count(),
            'recentFarmers' => User::where('role', 'farmer')->orderByDesc('created_at')->limit(5)->get(),
            'recentAnnouncements' => Announcement::orderByDesc('created_at')->limit(5)->get(),
            'recentGuides' => FarmingGuide::orderByDesc('created_at')->limit(5)->get(),
            'recentCommodityPrices' => CommodityPrice::orderByDesc('date_updated')->limit(5)->get(),
        ];

        // Log access
        ServiceAccessLog::updateOrCreate(
            ['user_id' => auth()->id()],
            ['last_accessed_at' => now()]
        );

        return view('admin.dashboard', $dashboardData);
    }
}
