<?php

namespace App\Modules\Dashboard\Services;

use App\Modules\Auth\Models\User;
use App\Modules\Farm\Models\Crop;
use App\Modules\Farm\Models\Livestock;
use App\Modules\Announcement\Models\Announcement;
use App\Modules\Guide\Models\FarmingGuide;
use App\Modules\Market\Models\CommodityPrice;

class DashboardService
{
    /**
     * Get admin dashboard data
     */
    public function getAdminDashboard(): array
    {
        return [
            'totalUsers' => User::count(),
            'totalAdmins' => User::where('role', 'admin')->count(),
            'totalFarmers' => User::where('role', 'farmer')->count(),
            'activeFarmers' => User::where('role', 'farmer')->where('status', 'active')->count(),
            'activeUsers' => User::where('status', 'active')->count(),
            'totalCrops' => Crop::count(),
            'totalLivestock' => Livestock::count(),
            'totalAnnouncements' => Announcement::count(),
            'totalGuides' => FarmingGuide::count(),
            'recentFarmers' => User::where('role', 'farmer')->orderByDesc('created_at')->limit(5)->get(),
            'recentAnnouncements' => Announcement::orderByDesc('created_at')->limit(5)->get(),
            'recentGuides' => FarmingGuide::orderByDesc('created_at')->limit(5)->get(),
        ];
    }

    /**
     * Get farmer dashboard data
     */
    public function getFarmerDashboard(User $user): array
    {
        return [
            'newNotices' => Announcement::where('is_published', true)
                ->where(function ($q) {
                    $q->whereNull('expiry_date')
                        ->orWhereDate('expiry_date', '>=', now()->toDateString());
                })
                ->count(),
            'activeCrops' => Crop::where('user_id', $user->id)->where('status', 'active')->count(),
            'livestock' => Livestock::where('user_id', $user->id)->sum('count') ?? 0,
            'latestPrice' => CommodityPrice::latest('date_updated')->first(),
            'recentGuides' => FarmingGuide::orderByDesc('created_at')->limit(5)->get(),
        ];
    }

    /**
     * Get quick stats
     */
    public function getQuickStats(User $user): array
    {
        if ($user->role === 'admin' || $user->role === 'super_admin') {
            return $this->getAdminDashboard();
        }

        return $this->getFarmerDashboard($user);
    }
}
