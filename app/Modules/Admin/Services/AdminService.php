<?php

namespace App\Modules\Admin\Services;

use App\Modules\Farmer\Models\Farmer;
use App\Modules\Auth\Models\User;
use App\Modules\Shared\Models\ServiceAccessLog;
use Exception;

class AdminService
{
    /**
     * Get admin dashboard metrics
     */
    public function getDashboardMetrics(): array
    {
        return [
            'totalUsers' => User::count(),
            'totalAdmins' => User::where('role', 'admin')->count(),
            'totalFarmers' => User::where('role', 'farmer')->count(),
            'activeFarmers' => User::where('role', 'farmer')->where('status', 'active')->count(),
            'activeUsers' => User::where('status', 'active')->count(),
        ];
    }

    /**
     * Log user access
     */
    public function logAccess(User $user, string $action = 'admin_access'): void
    {
        try {
            ServiceAccessLog::updateOrCreate(
                ['user_id' => $user->id],
                ['last_accessed_at' => now()]
            );
        } catch (Exception $e) {
            // Silently fail access logging
        }
    }

    /**
     * Get recent farmers
     */
    public function getRecentFarmers(int $limit = 5): \Illuminate\Database\Eloquent\Collection
    {
        return Farmer::orderByDesc('created_at')->limit($limit)->get();
    }
}
