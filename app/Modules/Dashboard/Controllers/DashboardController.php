<?php

namespace App\Modules\Dashboard\Controllers;

use App\Modules\Announcement\Models\Announcement;
use App\Modules\Market\Models\CommodityPrice;
use App\Modules\Farm\Models\Crop;
use App\Modules\Guide\Models\FarmingGuide;
use App\Modules\Farm\Models\Livestock;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    /**
     * Display farmer home dashboard.
     */
    public function farmerHome(): View
    {
        $newNotices = Announcement::query()
            ->where(function ($q): void {
                $q->whereNull('expiry_date')->orWhereDate('expiry_date', '>=', now()->toDateString());
            })
            ->count();

        $latestPrice = CommodityPrice::query()->max('date_updated');

        return view('farmer.home', [
            'newNotices' => $newNotices,
            'latestPriceDate' => $latestPrice,
        ]);
    }

    /**
     * Display announcements posted by admin.
     */
    public function farmerAnnouncements(Request $request): View
    {
        $category = trim((string) $request->query('category', ''));
        $search = trim((string) $request->query('search', ''));

        // Get current farmer's profile and group
        $user = auth()->user();
        $farmerProfile = $user->farmerProfileV2 ?? null;
        $farmerGroupId = $farmerProfile?->farmer_group_id;

        $query = Announcement::query()
            ->where(function ($q) use ($farmerGroupId): void {
                // Show announcements that are either:
                // 1. For all farmers (audience_scope = 'all')
                // 2. For this specific farmer's group (audience_scope = 'specific_group' and target_group_id matches)
                $q->where('audience_scope', 'all')
                    ->orWhere(function ($subQ) use ($farmerGroupId): void {
                        $subQ->where('audience_scope', 'specific_group')
                            ->where('target_group_id', $farmerGroupId);
                    });
            })
            ->where(function ($q): void {
                // Only show published announcements
                $q->where('is_published', true);
            })
            ->where(function ($q): void {
                // Check if announcement is active based on date range
                $q->whereNull('starts_at')->orWhereDate('starts_at', '<=', now())
                    ->where(function ($subQ): void {
                        $subQ->whereNull('ends_at')->orWhereDate('ends_at', '>=', now());
                    });
            })
            ->where(function ($q): void {
                // Check expiry date if set
                $q->whereNull('expiry_date')->orWhereDate('expiry_date', '>=', now()->toDateString());
            })
            ->orderByDesc('created_at');

        if ($category !== '') {
            $query->where('category', $category);
        }

        if ($search !== '') {
            $query->where(function ($q) use ($search): void {
                $q->where('title', 'like', '%' . $search . '%')
                    ->orWhere('content', 'like', '%' . $search . '%');
            });
        }

        $announcements = $query->paginate(10)->appends($request->query());

        return view('farmer.announcements', [
            'announcements' => $announcements,
            'category' => $category,
            'search' => $search,
        ]);
    }

    /**
     * Display farming guides posted by admin.
     */
    public function farmerGuides(Request $request): View
    {
        $cropType = trim((string) $request->query('crop_type', ''));
        $search = trim((string) $request->query('search', ''));

        $query = FarmingGuide::query()->orderByDesc('created_at');

        if ($cropType !== '') {
            $query->where('crop_type', $cropType);
        }

        if ($search !== '') {
            $query->where(function ($q) use ($search): void {
                $q->where('title', 'like', '%' . $search . '%')
                    ->orWhere('steps', 'like', '%' . $search . '%');
            });
        }

        $guides = $query->paginate(12)->appends($request->query());

        return view('farmer.guides', [
            'guides' => $guides,
            'cropType' => $cropType,
            'search' => $search,
        ]);
    }

    /**
     * Display weather page with admin weather-related advisories.
     */
    public function farmerWeather(): View
    {
        // Get current farmer's profile and group
        $user = auth()->user();
        $farmerProfile = $user->farmerProfileV2 ?? null;
        $farmerGroupId = $farmerProfile?->farmer_group_id;

        $weatherAnnouncements = Announcement::query()
            ->whereIn('category', ['Weather', 'Alert'])
            ->where(function ($q) use ($farmerGroupId): void {
                // Show announcements that are either:
                // 1. For all farmers (audience_scope = 'all')
                // 2. For this specific farmer's group (audience_scope = 'specific_group' and target_group_id matches)
                $q->where('audience_scope', 'all')
                    ->orWhere(function ($subQ) use ($farmerGroupId): void {
                        $subQ->where('audience_scope', 'specific_group')
                            ->where('target_group_id', $farmerGroupId);
                    });
            })
            ->where(function ($q): void {
                // Only show published announcements
                $q->where('is_published', true);
            })
            ->where(function ($q): void {
                // Check if announcement is active based on date range
                $q->whereNull('starts_at')->orWhereDate('starts_at', '<=', now())
                    ->where(function ($subQ): void {
                        $subQ->whereNull('ends_at')->orWhereDate('ends_at', '>=', now());
                    });
            })
            ->where(function ($q): void {
                // Check expiry date if set
                $q->whereNull('expiry_date')->orWhereDate('expiry_date', '>=', now()->toDateString());
            })
            ->orderByDesc('created_at')
            ->limit(6)
            ->get();

        return view('farmer.weather', ['weatherAnnouncements' => $weatherAnnouncements]);
    }

    /**
     * Display market prices updated by admin.
     */
    public function farmerMarketPrices(Request $request): View
    {
        $search = trim((string) $request->query('search', ''));

        $query = CommodityPrice::query()
            ->orderByDesc('date_updated')
            ->orderBy('commodity');

        if ($search !== '') {
            $query->where('commodity', 'like', '%' . $search . '%');
        }

        $prices = $query->paginate(20)->appends($request->query());

        return view('farmer.market-prices', [
            'prices' => $prices,
            'search' => $search,
        ]);
    }

    /**
     * Display the main dashboard (Farmer or Admin)
     */
    public function index(): View|RedirectResponse
    {
        $user = auth()->user();
        
        // Ensure user is authenticated
        if (!$user) {
            return redirect()->route('login');
        }

        $data = [];

        if ($user->role === 'farmer') {
            // Farmer Dashboard Data
            $data = [
                'activeRequests' => 2,
                'subsidiesReady' => 15000,
                'completedHarvests' => 5,
                'alerts' => 1,
            ];
        } elseif ($user->role === 'admin') {
            // Admin Dashboard Data
            $data = [
                'totalFarmers' => \App\Modules\Auth\Models\User::where('role', 'farmer')->count(),
                'pendingVerifications' => \App\Modules\Auth\Models\User::where('role', 'farmer')->where('status', 'pending')->count(),
                'distributionRequests' => 8,
                'systemAlerts' => 0,
            ];
        }

        return view('dashboard.main', $data);
    }
}
