<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\CommodityPrice;
use App\Models\Crop;
use App\Models\FarmingGuide;
use App\Models\Livestock;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

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
                'totalFarmers' => \App\Models\User::where('role', 'farmer')->count(),
                'pendingVerifications' => \App\Models\User::where('role', 'farmer')->where('status', 'pending')->count(),
                'distributionRequests' => 8,
                'systemAlerts' => 0,
            ];
        }

        return view('dashboard.main', $data);
    }

    /**
     * Display crops management
     */
    public function crops(): View
    {
        $crops = auth()->user()->crops()->get();
        return view('dashboard.crops', ['crops' => $crops]);
    }

    /**
     * Show create crop form
     */
    public function createCrop(): View
    {
        return view('dashboard.crops-create');
    }

    /**
     * Store new crop
     */
    public function storeCrop(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'area' => 'required|numeric',
            'planting_date' => 'required|date',
            'expected_harvest_date' => 'required|date|after:planting_date',
            'status' => 'required|string',
            'description' => 'nullable|string',
        ]);

        auth()->user()->crops()->create($request->all());

        return redirect()->route('crops.index')->with('success', 'Crop added successfully!');
    }

    /**
     * Edit crop
     */
    public function editCrop($id): View
    {
        $crop = Crop::where('user_id', auth()->id())->findOrFail($id);
        return view('dashboard.crops-edit', ['crop' => $crop]);
    }

    /**
     * Update crop
     */
    public function updateCrop(Request $request, $id): RedirectResponse
    {
        $crop = Crop::where('user_id', auth()->id())->findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'area' => 'required|numeric',
            'planting_date' => 'required|date',
            'expected_harvest_date' => 'required|date|after:planting_date',
            'status' => 'required|string',
            'description' => 'nullable|string',
        ]);

        $crop->update($request->all());

        return redirect()->route('crops.index')->with('success', 'Crop updated successfully!');
    }

    /**
     * Delete crop
     */
    public function deleteCrop($id): RedirectResponse
    {
        $crop = Crop::where('user_id', auth()->id())->findOrFail($id);
        $crop->delete();

        return redirect()->route('crops.index')->with('success', 'Crop deleted successfully!');
    }

    /**
     * Display livestock management
     */
    public function livestock(): View
    {
        $livestock = auth()->user()->livestock()->get();
        return view('dashboard.livestock', ['livestock' => $livestock]);
    }

    /**
     * Show create livestock form
     */
    public function createLivestock(): View
    {
        return view('dashboard.livestock-create');
    }

    /**
     * Store new livestock
     */
    public function storeLivestock(Request $request): RedirectResponse
    {
        $request->validate([
            'type' => 'required|string|max:255',
            'count' => 'required|integer|min:1',
            'health_status' => 'required|string',
            'notes' => 'nullable|string',
        ]);

        auth()->user()->livestock()->create($request->all());

        return redirect()->route('livestock.index')->with('success', 'Livestock added successfully!');
    }

    /**
     * Edit livestock
     */
    public function editLivestock($id): View
    {
        $animal = Livestock::where('user_id', auth()->id())->findOrFail($id);
        return view('dashboard.livestock-edit', ['livestock' => $animal]);
    }

    /**
     * Update livestock
     */
    public function updateLivestock(Request $request, $id): RedirectResponse
    {
        $animal = Livestock::where('user_id', auth()->id())->findOrFail($id);

        $request->validate([
            'type' => 'required|string|max:255',
            'count' => 'required|integer|min:1',
            'health_status' => 'required|string',
            'notes' => 'nullable|string',
        ]);

        $animal->update($request->all());

        return redirect()->route('livestock.index')->with('success', 'Livestock updated successfully!');
    }

    /**
     * Delete livestock
     */
    public function deleteLivestock($id): RedirectResponse
    {
        $animal = Livestock::where('user_id', auth()->id())->findOrFail($id);
        $animal->delete();

        return redirect()->route('livestock.index')->with('success', 'Livestock deleted successfully!');
    }

    /**
     * Display weather information
     */
    public function weather(): View
    {
        $weatherData = [
            'temperature' => 28,
            'humidity' => 65,
            'rainfall' => 5,
            'windSpeed' => 12,
            'forecast' => 'Partly Cloudy',
        ];

        return view('dashboard.weather', $weatherData);
    }

    /**
     * Display market prices
     */
    public function marketPrices(): View
    {
        $prices = [
            ['crop' => 'Rice', 'price' => '$500/ton', 'trend' => 'up'],
            ['crop' => 'Corn', 'price' => '$400/ton', 'trend' => 'stable'],
            ['crop' => 'Wheat', 'price' => '$450/ton', 'trend' => 'down'],
        ];

        return view('dashboard.market-prices', ['prices' => $prices]);
    }

    /**
     * Display user profile
     */
    public function profile(): View
    {
        return view('dashboard.profile', ['user' => auth()->user()]);
    }

    /**
     * Update user profile
     */
    public function updateProfile(Request $request): RedirectResponse
    {
        $user = auth()->user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'nullable|string',
            'address' => 'nullable|string',
        ]);

        $user->update($request->all());

        return back()->with('success', 'Profile updated successfully!');
    }

    /**
     * Update user password
     */
    public function updatePassword(Request $request): RedirectResponse
    {
        $user = auth()->user();

        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);

        // Check if current password is correct
        if (!\Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect']);
        }

        // Update password
        $user->password = \Hash::make($request->new_password);
        $user->save();

        return back()->with('success', 'Password updated successfully!');
    }

    /**
     * Display farmer's own comprehensive information
     */
    public function farmerInformation(): View
    {
        // Get Farmer model data for current authenticated user
        $farmer = \App\Models\Farmer::where('user_id', auth()->id())
            ->orderByDesc('created_at')
            ->first();

        return view('farmer.information', ['farmer' => $farmer]);
    }
}
