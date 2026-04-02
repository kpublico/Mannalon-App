<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Crop;
use App\Models\Livestock;
use App\Models\Farmer;
use App\Models\Announcement;
use App\Models\FarmerGroup;
use App\Models\FarmingGuide;
use App\Models\CommodityPrice;
use App\Models\ServiceAccessLog;
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
            'recentAdmins' => User::whereIn('role', ['admin', 'super_admin'])->orderByDesc('created_at')->limit(5)->get(),
            'allFarmers' => Farmer::orderBy('last_name')->orderBy('first_name')->get(),
        ];

        // Handle farmer selection from query parameter
        $selectedFarmerId = $request->query('selected_farmer');
        $selectedDashboardFarmer = null;

        if ($selectedFarmerId) {
            $selectedDashboardFarmer = Farmer::find($selectedFarmerId);
        }

        $dashboardData['selectedDashboardFarmer'] = $selectedDashboardFarmer;

        if ($request->header('X-Requested-With') === 'XMLHttpRequest') {
            if ($isSuperAdmin) {
                return view('admin.super-dashboard-content', $dashboardData);
            }
            return view('admin.dashboard-content', $dashboardData);
        }
        return view('admin.dashboard', $dashboardData);
    }

    /**
     * Display all farmers
     */
    public function farmers(Request $request): View
    {
        $search = trim((string) $request->query('search', ''));

        $query = Farmer::query()->with('farmDetail');
        if ($search !== '') {
            $query->where(function ($q) use ($search): void {
                $q->where('name', 'like', '%' . $search . '%')
                    ->orWhere('first_name', 'like', '%' . $search . '%')
                    ->orWhere('last_name', 'like', '%' . $search . '%')
                    ->orWhere('phone', 'like', '%' . $search . '%')
                    ->orWhere('farm_location', 'like', '%' . $search . '%');
            });
        }

        $farmers = $query->orderBy('last_name')->orderBy('first_name')->paginate(15);
        $registeredFarmerUsers = User::query()
            ->where('role', 'farmer')
            ->whereDoesntHave('farmerProfile')
            ->orderBy('name')
            ->get(['id', 'name', 'email', 'phone']);

        if ($request->header('X-Requested-With') === 'XMLHttpRequest') {
            return view('admin.farmers-content', [
                'farmers' => $farmers,
                'search' => $search,
                'registeredFarmerUsers' => $registeredFarmerUsers,
            ]);
        }
        return view('admin.farmers.index', [
            'farmers' => $farmers,
            'search' => $search,
            'registeredFarmerUsers' => $registeredFarmerUsers,
        ]);
    }

    /**
     * Store farmer information.
     */
    public function farmersStore(Request $request): RedirectResponse
    {
        $validated = $request->validate($this->farmerValidationRules());

        DB::transaction(function () use ($request, $validated): void {
            $payload = $this->buildFarmerPayload($validated);
            $payload['registered_by'] = auth()->id();
            $payload['valid_id_path'] = $this->storeFarmerDocument($request, 'valid_id');
            $payload['land_document_path'] = $this->storeFarmerDocument($request, 'land_document');
            $payload['farm_photos_path'] = $this->storeFarmerDocument($request, 'farm_photo');
            $payload['barangay_certification_path'] = $this->storeFarmerDocument($request, 'barangay_certification');

            Farmer::create($payload);
        });

        return redirect()->route('admin.farmers.index')->with('success', 'Farmer information created successfully.');
    }

    /**
     * Update farmer information.
     */
    public function farmersUpdate(Request $request, Farmer $farmer): RedirectResponse
    {
        $validated = $request->validate($this->farmerValidationRules($farmer));

        DB::transaction(function () use ($request, $validated, $farmer): void {
            $payload = $this->buildFarmerPayload($validated);

            $validIdPath = $this->storeFarmerDocument($request, 'valid_id');
            if ($validIdPath !== null) {
                $payload['valid_id_path'] = $validIdPath;
            }

            $landDocumentPath = $this->storeFarmerDocument($request, 'land_document');
            if ($landDocumentPath !== null) {
                $payload['land_document_path'] = $landDocumentPath;
            }

            $farmPhotoPath = $this->storeFarmerDocument($request, 'farm_photo');
            if ($farmPhotoPath !== null) {
                $payload['farm_photos_path'] = $farmPhotoPath;
            }

            $barangayCertificationPath = $this->storeFarmerDocument($request, 'barangay_certification');
            if ($barangayCertificationPath !== null) {
                $payload['barangay_certification_path'] = $barangayCertificationPath;
            }

            $farmer->update($payload);
        });

        return back()->with('success', 'Farmer information updated successfully.');
    }

    /**
     * Delete farmer information.
     */
    public function farmersDestroy(Farmer $farmer): RedirectResponse
    {
        $farmer->delete();

        return back()->with('success', 'Farmer information deleted successfully.');
    }

    /**
     * Show farmer details
     */
    public function farmerDetails($id): View
    {
        $farmer = Farmer::with(['farmDetail', 'beneficiaries', 'user'])->findOrFail($id);
        $user = $farmer->user;
        $crops = $user ? $user->crops()->get() : collect();
        $livestock = $user ? $user->livestock()->get() : collect();

        return view('admin.farmers.show', [
            'farmer' => $farmer,
            'crops' => $crops,
            'livestock' => $livestock,
        ]);
    }

    /**
     * Display farmer information dashboard with selector and analytics
     */
    public function farmerInformationDashboard(Request $request): View
    {
        $selectedFarmerId = $request->query('farmer_id');
        $farmer = null;
        $analytics = [];

        // Get all farmers for the selector dropdown
        $allFarmers = Farmer::orderBy('last_name')->orderBy('first_name')->get();

        if ($selectedFarmerId) {
            $farmer = Farmer::with(['farmDetail', 'beneficiaries', 'user'])->findOrFail($selectedFarmerId);
            $user = $farmer->user;
            $crops = $user ? $user->crops()->get() : collect();
            $livestock = $user ? $user->livestock()->get() : collect();

            // Build analytics data
            $analytics = [
                'farmer_id' => $farmer->id,
                'full_name' => $farmer->first_name . ' ' . $farmer->last_name,
                'email' => $user?->email ?? 'N/A',
                'phone' => $farmer->phone ?? 'N/A',
                'status' => $farmer->profile_status ?? 'active',
                'user_status' => $user?->status ?? 'inactive',
                'registration_date' => $farmer->created_at?->format('M d, Y'),
                'location' => ($farmer->municipality_city ?? 'N/A') . ', ' . ($farmer->province ?? 'N/A'),
                'farmer_type' => $farmer->farmer_type ?? 'Not specified',
                'years_in_farming' => $farmer->years_in_farming ?? 0,
                'farm_size_hectares' => $farmer->farm_size_hectares ?? 0,
                'land_ownership' => $farmer->land_ownership_type ?? 'Not specified',
                'total_crops' => $crops->count(),
                'total_livestock' => $livestock->count(),
                'is_association_member' => $farmer->is_association_member ? 'Yes' : 'No',
                'association_name' => $farmer->association_name ?? 'None',
                'crops' => $crops->pluck('name')->join(', ') ?: 'None',
                'livestock_types' => $livestock->pluck('name')->join(', ') ?: 'None',
                'government_id_type' => $farmer->government_id_type ?? 'Not provided',
                'government_id_number' => $farmer->government_id_number ?? 'Not provided',
            ];
        }

        return view('admin.farmer-information-dashboard', [
            'farmer' => $farmer,
            'allFarmers' => $allFarmers,
            'analytics' => $analytics,
            'selectedFarmerId' => $selectedFarmerId,
        ]);
    }

    /**
     * Update farmer status
     */
    public function updateFarmerStatus(Request $request, $id): RedirectResponse
    {
        $farmer = Farmer::findOrFail($id);

        $request->validate(['status' => ['required', Rule::in(['active', 'inactive', 'verified'])]]);
        $farmer->update(['profile_status' => $request->status]);

        if ($farmer->user) {
            $userStatus = $request->status === 'inactive' ? 'inactive' : 'active';
            $farmer->user->update(['status' => $userStatus]);
        }

        return back()->with('success', 'Farmer status updated successfully!');
    }

    /**
     * Farmer validation rules for create and update.
     */
    private function farmerValidationRules(?Farmer $farmer = null): array
    {
        $userIdRules = [
            $farmer ? 'nullable' : 'required',
            Rule::exists('users', 'id')->where(static fn ($query) => $query->where('role', 'farmer')),
            Rule::unique('farmers', 'user_id')->ignore($farmer?->id),
        ];

        return [
            'user_id' => $userIdRules,
            'first_name' => ['required_without:user_id', 'nullable', 'string', 'max:100'],
            'middle_name' => ['nullable', 'string', 'max:100'],
            'last_name' => ['required_without:user_id', 'nullable', 'string', 'max:100'],
            'gender' => ['nullable', Rule::in(['male', 'female', 'other'])],
            'date_of_birth' => ['nullable', 'date'],
            'age' => ['nullable', 'integer', 'min:1', 'max:120'],
            'civil_status' => ['nullable', Rule::in(['single', 'married', 'divorced', 'widowed', 'separated'])],
            'phone' => ['nullable', 'string', 'max:30'],
            'email' => ['nullable', 'email', 'max:255'],
            'government_id_type' => ['nullable', 'string', 'max:60'],
            'government_id_number' => ['nullable', 'string', 'max:120'],
            'region' => ['nullable', 'string', 'max:120'],
            'province' => ['nullable', 'string', 'max:120'],
            'municipality_city' => ['nullable', 'string', 'max:120'],
            'barangay' => ['nullable', 'string', 'max:120'],
            'sitio_purok' => ['nullable', 'string', 'max:120'],
            'gps_latitude' => ['nullable', 'numeric', 'between:-90,90'],
            'gps_longitude' => ['nullable', 'numeric', 'between:-180,180'],
            'land_boundary_points' => ['nullable', 'string'],
            'farmer_type' => ['nullable', Rule::in(['owner', 'tenant', 'farm_worker'])],
            'years_in_farming' => ['nullable', 'integer', 'min:0', 'max:80'],
            'primary_occupation' => ['nullable', 'string', 'max:150'],
            'secondary_occupation' => ['nullable', 'string', 'max:150'],
            'is_association_member' => ['nullable', 'boolean'],
            'association_name' => ['nullable', 'string', 'max:180'],
            'farm_location' => ['nullable', 'string', 'max:255'],
            'farm_size_hectares' => ['nullable', 'numeric', 'min:0'],
            'land_ownership_type' => ['nullable', Rule::in(['owned', 'leased', 'shared'])],
            'number_of_parcels' => ['nullable', 'integer', 'min:0'],
            'crop_types' => ['nullable', 'string'],
            'crop_area_per_type' => ['nullable', 'string'],
            'cropping_season' => ['nullable', Rule::in(['wet', 'dry', 'wet_dry'])],
            'yield_per_harvest' => ['nullable', 'string', 'max:120'],
            'livestock_types' => ['nullable', 'string'],
            'livestock_count' => ['nullable', 'integer', 'min:0'],
            'farm_equipment' => ['nullable', 'string'],
            'irrigation_type' => ['nullable', Rule::in(['rainfed', 'irrigated', 'mixed'])],
            'water_source' => ['nullable', 'string', 'max:120'],
            'fertilizer_usage' => ['nullable', Rule::in(['organic', 'inorganic', 'mixed'])],
            'pesticide_usage' => ['nullable', 'string'],
            'average_monthly_income' => ['nullable', 'numeric', 'min:0'],
            'average_annual_income' => ['nullable', 'numeric', 'min:0'],
            'income_source' => ['nullable', Rule::in(['farm', 'non_farm', 'both'])],
            'has_credit_access' => ['nullable', 'boolean'],
            'insurance_coverage' => ['nullable', 'string', 'max:150'],
            'is_rsbsa_registered' => ['nullable', 'boolean'],
            'programs_availed' => ['nullable', 'string'],
            'program_registration_date' => ['nullable', 'date'],
            'profile_status' => ['nullable', Rule::in(['active', 'inactive', 'verified'])],
            'valid_id' => ['nullable', 'file', 'mimes:jpg,jpeg,png,pdf', 'max:5120'],
            'land_document' => ['nullable', 'file', 'mimes:jpg,jpeg,png,pdf', 'max:5120'],
            'farm_photo' => ['nullable', 'file', 'mimes:jpg,jpeg,png,pdf', 'max:5120'],
            'barangay_certification' => ['nullable', 'file', 'mimes:jpg,jpeg,png,pdf', 'max:5120'],
        ];
    }

    /**
     * Build normalized farmer payload from validated request data.
     */
    private function buildFarmerPayload(array $validated): array
    {
        if (!empty($validated['user_id'])) {
            $linkedUser = User::query()
                ->where('role', 'farmer')
                ->find($validated['user_id']);

            if ($linkedUser) {
                $nameParts = preg_split('/\s+/', trim((string) $linkedUser->name)) ?: [];
                if (($validated['first_name'] ?? '') === '' && count($nameParts) > 0) {
                    $validated['first_name'] = $nameParts[0];
                }
                if (($validated['last_name'] ?? '') === '' && count($nameParts) > 1) {
                    $validated['last_name'] = $nameParts[count($nameParts) - 1];
                }
                if (($validated['middle_name'] ?? '') === '' && count($nameParts) > 2) {
                    $validated['middle_name'] = implode(' ', array_slice($nameParts, 1, -1));
                }
                if (($validated['email'] ?? '') === '' && !empty($linkedUser->email)) {
                    $validated['email'] = $linkedUser->email;
                }
                if (($validated['phone'] ?? '') === '' && !empty($linkedUser->phone)) {
                    $validated['phone'] = $linkedUser->phone;
                }
            }
        }

        $fullName = trim(implode(' ', array_filter([
            $validated['first_name'] ?? null,
            $validated['middle_name'] ?? null,
            $validated['last_name'] ?? null,
        ])));

        $validated['name'] = $fullName !== '' ? $fullName : 'Unnamed Farmer';
        $validated['is_association_member'] = (bool) ($validated['is_association_member'] ?? false);
        $validated['has_credit_access'] = (bool) ($validated['has_credit_access'] ?? false);
        $validated['is_rsbsa_registered'] = (bool) ($validated['is_rsbsa_registered'] ?? false);
        $validated['profile_status'] = $validated['profile_status'] ?? 'active';

        if (!empty($validated['land_boundary_points'])) {
            $decodedPoints = json_decode((string) $validated['land_boundary_points'], true);
            if (is_array($decodedPoints)) {
                $points = [];
                foreach ($decodedPoints as $point) {
                    if (!is_array($point)) {
                        continue;
                    }

                    $lat = isset($point['lat']) ? (float) $point['lat'] : null;
                    $lng = isset($point['lng']) ? (float) $point['lng'] : null;
                    if ($lat === null || $lng === null) {
                        continue;
                    }
                    if ($lat < -90 || $lat > 90 || $lng < -180 || $lng > 180) {
                        continue;
                    }

                    $points[] = ['lat' => $lat, 'lng' => $lng];
                }

                if (count($points) > 0) {
                    $validated['land_boundary_points'] = $points;
                    if (($validated['gps_latitude'] ?? null) === null) {
                        $validated['gps_latitude'] = $points[0]['lat'];
                    }
                    if (($validated['gps_longitude'] ?? null) === null) {
                        $validated['gps_longitude'] = $points[0]['lng'];
                    }
                } else {
                    $validated['land_boundary_points'] = null;
                }
            } else {
                $validated['land_boundary_points'] = null;
            }
        }

        return $validated;
    }

    /**
     * Save a farmer attachment and return relative storage path.
     */
    private function storeFarmerDocument(Request $request, string $field): ?string
    {
        if (!$request->hasFile($field)) {
            return null;
        }

        return $request->file($field)->store('farmer-documents', 'public');
    }

    /**
     * Display all crops
     */
    public function crops(): View
    {
        $crops = Crop::with('user')->paginate(15);
        return view('admin.crops.index', ['crops' => $crops]);
    }

    /**
     * Display all livestock
     */
    public function livestock(): View
    {
        $livestock = Livestock::with('user')->paginate(15);
        return view('admin.livestock.index', ['livestock' => $livestock]);
    }

    /**
     * Display analytics
     */
    public function analytics(Request $request): View
    {
        $cropsByStatus = Crop::select('status')->selectRaw('count(*) as total')->groupBy('status')->get();
        $livestockTypeColumn = $this->getLivestockTypeColumn();
        $livestockByType = Livestock::select($livestockTypeColumn . ' as type')
            ->selectRaw('count(*) as total')
            ->groupBy($livestockTypeColumn)
            ->get();

        if ($request->header('X-Requested-With') === 'XMLHttpRequest') {
            return view('admin.analytics-content', [
                'cropsByStatus' => $cropsByStatus,
                'livestockByType' => $livestockByType,
            ]);
        }

        return view('admin.analytics', [
            'cropsByStatus' => $cropsByStatus,
            'livestockByType' => $livestockByType,
        ]);
    }

    /**
     * Display reports and analytics
     */
    public function reportsAnalytics(Request $request): View
    {
        $reportData = $this->buildReportsAnalyticsData();

        // Handle farmer selection
        $selectedFarmerId = $request->query('farmer_id');
        $selectedFarmer = null;

        if ($selectedFarmerId) {
            $selectedFarmer = Farmer::with(['farmDetail', 'beneficiaries', 'user'])->find($selectedFarmerId);
        }

        $reportData['selectedFarmerId'] = $selectedFarmerId;
        $reportData['selectedFarmer'] = $selectedFarmer;

        if ($request->header('X-Requested-With') === 'XMLHttpRequest') {
            return view('admin.reports-analytics-content', $reportData);
        }

        return view('layouts.admin-dashboard');
    }

    /**
     * Export global reports in CSV format.
     */
    public function exportReportsCsv(): StreamedResponse
    {
        $data = $this->buildReportsAnalyticsData();
        $filename = 'global-reports-' . now()->format('Ymd_His') . '.csv';

        return response()->streamDownload(function () use ($data): void {
            $output = fopen('php://output', 'w');
            if ($output === false) {
                return;
            }

            fputcsv($output, ['Metric', 'Value']);
            foreach ($data['summaryRows'] as $row) {
                fputcsv($output, [$row['metric'], $row['value']]);
            }

            fputcsv($output, []);
            fputcsv($output, ['Category', 'Label', 'Count']);
            foreach ($data['breakdownRows'] as $row) {
                fputcsv($output, [$row['category'], $row['label'], $row['count']]);
            }

            fclose($output);
        }, $filename, ['Content-Type' => 'text/csv']);
    }

    /**
     * Export global reports in PDF format.
     */
    public function exportReportsPdf()
    {
        $data = $this->buildReportsAnalyticsData();

        $lines = [
            'MannalonApp - Global Reports',
            'Generated: ' . $data['generatedAt'],
            '',
            'Summary',
        ];

        foreach ($data['summaryRows'] as $row) {
            $lines[] = $row['metric'] . ': ' . $row['value'];
        }

        $lines[] = '';
        $lines[] = 'Breakdown';
        foreach ($data['breakdownRows'] as $row) {
            $lines[] = $row['category'] . ' - ' . $row['label'] . ': ' . $row['count'];
        }

        $pdf = $this->buildSimplePdf($lines);
        $filename = 'global-reports-' . now()->format('Ymd_His') . '.pdf';

        return response($pdf, 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ]);
    }

    /**
     * Build report metrics and grouped breakdowns.
     */
    private function buildReportsAnalyticsData(): array
    {
        $totalUsers = User::count();
        $activeUsers = User::where('status', 'active')->count();
        $activeToday = Schema::hasTable('service_access_logs')
            ? ServiceAccessLog::whereDate('created_at', now()->toDateString())->count()
            : 0;

        $cropsByStatus = Crop::select('status')
            ->selectRaw('COUNT(*) as total')
            ->groupBy('status')
            ->orderBy('status')
            ->get();

        $livestockTypeColumn = $this->getLivestockTypeColumn();
        $livestockByType = Livestock::select($livestockTypeColumn . ' as type')
            ->selectRaw('COUNT(*) as total')
            ->groupBy($livestockTypeColumn)
            ->orderBy($livestockTypeColumn)
            ->get();

        $systemHealth = $totalUsers > 0 ? (int) round(($activeUsers / $totalUsers) * 100) : 0;

        $farmerProfiles = Farmer::query()
            ->orderByDesc('created_at')
            ->get();

        // Analytics for charts
        $farmersByType = Farmer::select('farmer_type')
            ->selectRaw('COUNT(*) as count')
            ->groupBy('farmer_type')
            ->get();

        $farmersByLocation = Farmer::select('municipality_city')
            ->selectRaw('COUNT(*) as count')
            ->groupBy('municipality_city')
            ->orderByDesc('count')
            ->limit(10)
            ->get();

        $farmersByStatus = Farmer::select('profile_status')
            ->selectRaw('COUNT(*) as count')
            ->groupBy('profile_status')
            ->get();

        $farmSizeRanges = [
            '0-1ha' => Farmer::where('farm_size_hectares', '<', 1)->count(),
            '1-5ha' => Farmer::whereBetween('farm_size_hectares', [1, 5])->count(),
            '5-10ha' => Farmer::whereBetween('farm_size_hectares', [5, 10])->count(),
            '10+ha' => Farmer::where('farm_size_hectares', '>=', 10)->count(),
        ];

        $incomeRanges = [
            'Under 20k' => Farmer::where('average_monthly_income', '<', 20000)->count(),
            '20k-50k' => Farmer::whereBetween('average_monthly_income', [20000, 50000])->count(),
            '50k-100k' => Farmer::whereBetween('average_monthly_income', [50000, 100000])->count(),
            '100k+' => Farmer::where('average_monthly_income', '>=', 100000)->count(),
        ];

        $summaryRows = [
            ['metric' => 'Total Farmers', 'value' => User::where('role', 'farmer')->count()],
            ['metric' => 'Active Today', 'value' => $activeToday],
            ['metric' => 'Total Crops', 'value' => Crop::count()],
            ['metric' => 'Total Livestock', 'value' => Livestock::count()],
            ['metric' => 'Total Announcements', 'value' => Announcement::count()],
            ['metric' => 'Total Guides', 'value' => FarmingGuide::count()],
            ['metric' => 'System Health (%)', 'value' => $systemHealth],
        ];

        $breakdownRows = [];
        foreach ($cropsByStatus as $row) {
            $breakdownRows[] = [
                'category' => 'Crops by Status',
                'label' => (string) ($row->status ?? 'Unknown'),
                'count' => (int) $row->total,
            ];
        }
        foreach ($livestockByType as $row) {
            $breakdownRows[] = [
                'category' => 'Livestock by Type',
                'label' => (string) ($row->type ?? 'Unknown'),
                'count' => (int) $row->total,
            ];
        }

        return [
            'totalFarmers' => $summaryRows[0]['value'],
            'activeToday' => $summaryRows[1]['value'],
            'totalCrops' => $summaryRows[2]['value'],
            'systemHealth' => $systemHealth,
            'summaryRows' => $summaryRows,
            'breakdownRows' => $breakdownRows,
            'farmerProfiles' => $farmerProfiles,
            'generatedAt' => now()->format('M d, Y h:i A'),
            'farmersByType' => $farmersByType,
            'farmersByLocation' => $farmersByLocation,
            'farmersByStatus' => $farmersByStatus,
            'farmSizeRanges' => $farmSizeRanges,
            'incomeRanges' => $incomeRanges,
        ];
    }

    /**
     * Resolve livestock type column across schema versions.
     */
    private function getLivestockTypeColumn(): string
    {
        if (Schema::hasTable('livestock') && Schema::hasColumn('livestock', 'animal_type')) {
            return 'animal_type';
        }

        return 'type';
    }

    /**
     * Generate a minimal valid PDF file from plain text lines.
     */
    private function buildSimplePdf(array $lines): string
    {
        $escapedLines = array_map(static function (string $line): string {
            return str_replace(['\\', '(', ')'], ['\\\\', '\\(', '\\)'], $line);
        }, $lines);

        $content = "BT\n/F1 12 Tf\n14 TL\n50 800 Td\n";
        foreach ($escapedLines as $line) {
            $content .= '(' . $line . ") Tj\nT*\n";
        }
        $content .= "ET\n";

        $objects = [
            "1 0 obj\n<< /Type /Catalog /Pages 2 0 R >>\nendobj\n",
            "2 0 obj\n<< /Type /Pages /Kids [3 0 R] /Count 1 >>\nendobj\n",
            "3 0 obj\n<< /Type /Page /Parent 2 0 R /MediaBox [0 0 612 792] /Resources << /Font << /F1 4 0 R >> >> /Contents 5 0 R >>\nendobj\n",
            "4 0 obj\n<< /Type /Font /Subtype /Type1 /BaseFont /Helvetica >>\nendobj\n",
            "5 0 obj\n<< /Length " . strlen($content) . " >>\nstream\n" . $content . "endstream\nendobj\n",
        ];

        $pdf = "%PDF-1.4\n";
        $offsets = [];

        foreach ($objects as $object) {
            $offsets[] = strlen($pdf);
            $pdf .= $object;
        }

        $xrefOffset = strlen($pdf);
        $pdf .= "xref\n0 " . (count($objects) + 1) . "\n";
        $pdf .= "0000000000 65535 f \n";
        foreach ($offsets as $offset) {
            $pdf .= sprintf("%010d 00000 n \n", $offset);
        }

        $pdf .= "trailer\n<< /Size " . (count($objects) + 1) . " /Root 1 0 R >>\n";
        $pdf .= "startxref\n" . $xrefOffset . "\n%%EOF";

        return $pdf;
    }

    /**
     * Display weather management
     */
    public function weatherIndex(Request $request): View
    {
        if ($request->header('X-Requested-With') === 'XMLHttpRequest') {
            return view('admin.weather-content');
        }
        return view('admin.weather.index');
    }

    /**
     * Store weather update
     */
    public function weatherStore(Request $request)
    {
        // Store weather update logic
        return back()->with('success', 'Weather update posted successfully!');
    }

    /**
     * Display market prices management
     */
    public function marketPricesIndex(Request $request): View
    {
        $prices = CommodityPrice::orderByDesc('date_updated')->orderBy('commodity')->get();

        if ($request->header('X-Requested-With') === 'XMLHttpRequest') {
            return view('admin.market-prices-content', ['prices' => $prices]);
        }
        return view('admin.market-prices.index', ['prices' => $prices]);
    }

    /**
     * Edit market prices
     */
    public function marketPricesEdit(): View
    {
        return view('admin.market-prices.edit');
    }

    /**
     * Update market prices
     */
    public function marketPricesUpdate(Request $request)
    {
        $validated = $request->validate([
            'commodity' => ['required', 'string', 'max:120'],
            'price_per_kilo' => ['required', 'numeric', 'min:0'],
            'date_updated' => ['required', 'date'],
            'source_market' => ['nullable', 'string', 'max:120'],
        ]);

        CommodityPrice::create($validated + ['updated_by' => auth()->id()]);

        return back()->with('success', 'Market prices updated successfully!');
    }

    /**
     * Update selected commodity price row.
     */
    public function marketPriceRowUpdate(Request $request, CommodityPrice $commodityPrice): RedirectResponse
    {
        $validated = $request->validate([
            'commodity' => ['required', 'string', 'max:120'],
            'price_per_kilo' => ['required', 'numeric', 'min:0'],
            'date_updated' => ['required', 'date'],
            'source_market' => ['nullable', 'string', 'max:120'],
        ]);

        $commodityPrice->update($validated + ['updated_by' => auth()->id()]);

        return back()->with('success', 'Commodity price updated successfully.');
    }

    /**
     * Delete selected commodity price row.
     */
    public function marketPriceRowDestroy(CommodityPrice $commodityPrice): RedirectResponse
    {
        $commodityPrice->delete();

        return back()->with('success', 'Commodity price deleted successfully.');
    }

    /**
     * Display announcements list
     */
    public function announcementsIndex(Request $request): View
    {
        $category = trim((string) $request->query('category', ''));
        $search = trim((string) $request->query('search', ''));

        $query = Announcement::query()->orderByDesc('created_at');
        if ($category !== '') {
            $query->where('category', $category);
        }
        if ($search !== '') {
            $query->where(function ($q) use ($search): void {
                $q->where('title', 'like', '%' . $search . '%')
                    ->orWhere('content', 'like', '%' . $search . '%');
            });
        }

        $announcements = $query->paginate(10);
        $groups = FarmerGroup::all();

        if ($request->header('X-Requested-With') === 'XMLHttpRequest') {
            return view('admin.announcements-content', [
                'announcements' => $announcements,
                'category' => $category,
                'search' => $search,
                'groups' => $groups,
            ]);
        }
        return view('admin.announcements.index', [
            'announcements' => $announcements,
            'category' => $category,
            'search' => $search,
            'groups' => $groups,
        ]);
    }

    /**
     * Show create announcement form
     */
    public function announcementsCreate(): View
    {
        $groups = FarmerGroup::all();
        return view('admin.announcements.create', ['groups' => $groups]);
    }

    /**
     * Store new announcement
     */
    public function announcementsStore(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'category' => ['required', Rule::in(['Alert', 'General', 'Weather'])],
            'expiry_date' => ['nullable', 'date'],
            'content' => ['required', 'string'],
            'audience_scope' => ['required', Rule::in(['all', 'specific_group'])],
            'target_group_id' => ['nullable', 'integer', 'exists:farmer_groups,id'],
            'is_published' => ['sometimes', 'boolean'],
            'starts_at' => ['nullable', 'date_time'],
            'ends_at' => ['nullable', 'date_time'],
        ]);

        // Ensure target_group_id is required if audience_scope is specific_group
        if ($validated['audience_scope'] === 'specific_group' && empty($validated['target_group_id'])) {
            return back()->withErrors(['target_group_id' => 'Target group is required when audience scope is specific.'])->withInput();
        }

        $validated['is_published'] = $request->has('is_published') ? true : false;
        $validated['posted_by'] = auth()->id();

        Announcement::create($validated);

        return back()->with('success', 'Announcement created successfully!');
    }

    /**
     * Show edit announcement form
     */
    public function announcementsEdit($id): View
    {
        $announcement = Announcement::findOrFail($id);
        $groups = FarmerGroup::all();
        return view('admin.announcements.edit', ['announcement' => $announcement, 'groups' => $groups, 'id' => $id]);
    }

    /**
     * Update announcement
     */
    public function announcementsUpdate(Request $request, $id)
    {
        $announcement = Announcement::findOrFail($id);

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'category' => ['required', Rule::in(['Alert', 'General', 'Weather'])],
            'expiry_date' => ['nullable', 'date'],
            'content' => ['required', 'string'],
            'audience_scope' => ['required', Rule::in(['all', 'specific_group'])],
            'target_group_id' => ['nullable', 'integer', 'exists:farmer_groups,id'],
            'is_published' => ['sometimes', 'boolean'],
            'starts_at' => ['nullable', 'date_time'],
            'ends_at' => ['nullable', 'date_time'],
        ]);

        // Ensure target_group_id is required if audience_scope is specific_group
        if ($validated['audience_scope'] === 'specific_group' && empty($validated['target_group_id'])) {
            return back()->withErrors(['target_group_id' => 'Target group is required when audience scope is specific.'])->withInput();
        }

        $validated['is_published'] = $request->has('is_published') ? true : false;

        $announcement->update($validated);

        return back()->with('success', 'Announcement updated successfully!');
    }

    /**
     * Delete announcement
     */
    public function announcementsDestroy($id)
    {
        Announcement::findOrFail($id)->delete();

        return back()->with('success', 'Announcement deleted successfully!');
    }

    /**
     * Display guides list
     */
    public function guidesIndex(Request $request): View
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

        $guides = $query->paginate(12);
        
        if ($request->header('X-Requested-With') === 'XMLHttpRequest') {
            return view('admin.guides-content', [
                'guides' => $guides,
                'cropType' => $cropType,
                'search' => $search,
            ]);
        }
        return view('admin.guides.index', [
            'guides' => $guides,
            'cropType' => $cropType,
            'search' => $search,
        ]);
    }

    /**
     * Create new user (Admin only)
     */
    public function usersCreate(Request $request): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'sex' => 'required|in:male,female',
            'role' => 'required|in:farmer,admin,super_admin,coordinator',
            'state' => 'required|string|max:100',
            'city' => 'required|string|max:100',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $validated = $validator->validated();

        User::create([
            'name' => $validated['first_name'] . ' ' . $validated['last_name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role'],
            'status' => 'active',
            'sex' => $validated['sex'],
            'phone' => $validated['phone'] ?? null,
            'address' => $validated['address'] ?? null,
            'city' => $validated['city'],
            'state' => $validated['state'],
        ]);

        return back()->with('success', 'User account created successfully!');
    }

    /**
     * Show create guide form
     */
    public function guidesCreate(): View
    {
        return view('admin.guides.create');
    }

    /**
     * Store new guide
     */
    public function guidesStore(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'crop_type' => ['nullable', 'string', 'max:100'],
            'season' => ['nullable', 'string', 'max:100'],
            'steps' => ['required', 'string'],
            'resource_url' => ['nullable', 'url', 'max:500'],
            'pdf_file' => ['nullable', 'file', 'mimes:pdf', 'max:10240'], // 10MB max
        ]);

        // Handle PDF upload
        if ($request->hasFile('pdf_file')) {
            $path = $request->file('pdf_file')->store('farm_guides', 'public');
            $validated['pdf_file'] = $path;
        }

        FarmingGuide::create($validated + ['posted_by' => auth()->id()]);

        return redirect()->route('admin.guides.index')->with('success', 'Guide created successfully!');
    }

    /**
     * Show edit guide form
     */
    public function guidesEdit($id): View
    {
        $guide = FarmingGuide::findOrFail($id);
        return view('admin.guides.edit', ['guide' => $guide]);
    }

    /**
     * Update guide
     */
    public function guidesUpdate(Request $request, $id)
    {
        $guide = FarmingGuide::findOrFail($id);

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'crop_type' => ['nullable', 'string', 'max:100'],
            'season' => ['nullable', 'string', 'max:100'],
            'steps' => ['required', 'string'],
            'resource_url' => ['nullable', 'url', 'max:500'],
            'pdf_file' => ['nullable', 'file', 'mimes:pdf', 'max:10240'], // 10MB max
        ]);

        // Handle PDF upload
        if ($request->hasFile('pdf_file')) {
            // Delete old PDF if exists
            if ($guide->pdf_file && \Storage::disk('public')->exists($guide->pdf_file)) {
                \Storage::disk('public')->delete($guide->pdf_file);
            }
            // Store new PDF
            $path = $request->file('pdf_file')->store('farm_guides', 'public');
            $validated['pdf_file'] = $path;
        }

        $guide->update($validated);

        return redirect()->route('admin.guides.index')->with('success', 'Guide updated successfully!');
    }

    /**
     * Delete guide
     */
    public function guidesDestroy($id)
    {
        FarmingGuide::findOrFail($id)->delete();

        return back()->with('success', 'Guide deleted successfully!');
    }

    /**
     * Display users management
     */
    public function usersIndex(Request $request): View
    {
        $search = trim((string) $request->query('search', ''));

        $query = User::query()->orderByDesc('created_at');
        if ($search !== '') {
            $query->where(function ($q) use ($search): void {
                $q->where('name', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%')
                    ->orWhere('role', 'like', '%' . $search . '%');
            });
        }

        $users = $query->paginate(15);
        if ($request->header('X-Requested-With') === 'XMLHttpRequest') {
            return view('admin.users-content', ['users' => $users, 'search' => $search]);
        }
        return view('admin.users.index', ['users' => $users, 'search' => $search]);
    }

    /**
     * Update user
     */
    public function usersUpdate(Request $request, $id): RedirectResponse
    {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', Rule::unique('users', 'email')->ignore($user->id)],
            'role' => ['required', Rule::in(['super_admin', 'admin', 'coordinator', 'farmer'])],
            'status' => ['required', Rule::in(['active', 'inactive'])],
        ]);

        $user->update($validated);

        return back()->with('success', 'User updated successfully!');
    }

    /**
     * Delete user account.
     */
    public function usersDestroy($id): RedirectResponse
    {
        $user = User::findOrFail($id);
        if (auth()->id() === $user->id) {
            return back()->with('error', 'You cannot delete your own account.');
        }

        $user->delete();

        return back()->with('success', 'User deleted successfully!');
    }

    /**
     * Display system settings
     */
    public function settings(Request $request): View
    {
        if ($request->header('X-Requested-With') === 'XMLHttpRequest') {
            return view('admin.settings-content');
        }
        return view('admin.settings');
    }

    /**
     * API endpoint to get all Philippine regions (PSGC data)
     */
    public function getRegions()
    {
        $regions = \App\Models\Address\PhRegion::orderBy('region_id')
            ->get(['code', 'name', 'region_id'])
            ->map(fn ($r) => ['code' => $r->region_id, 'name' => $r->name]);

        return response()->json($regions);
    }

    /**
     * API endpoint to get provinces by region code (PSGC data)
     */
    public function getProvincesByRegion(Request $request)
    {
        $regionCode = $request->query('region_code');
        if (!$regionCode) {
            return response()->json(['error' => 'Region code is required'], 422);
        }

        $provinces = \App\Models\Address\PhProvince::where('region_id', $regionCode)
            ->orderBy('name')
            ->get(['code', 'name', 'region_id', 'province_id'])
            ->map(fn ($p) => ['code' => $p->province_id, 'name' => $p->name]);

        return response()->json($provinces);
    }

    /**
     * API endpoint to get municipalities/cities by province code (PSGC data)
     */
    public function getMunicipalitiesByProvince(Request $request)
    {
        $provinceCode = $request->query('province_code');
        if (!$provinceCode) {
            return response()->json(['error' => 'Province code is required'], 422);
        }

        $cities = \App\Models\Address\PhCity::where('province_id', $provinceCode)
            ->orderBy('name')
            ->get(['code', 'name', 'province_id', 'city_id'])
            ->map(fn ($c) => ['code' => $c->city_id, 'name' => $c->name]);

        return response()->json($cities);
    }

    /**
     * API endpoint to get barangays by city/municipality code (PSGC data)
     */
    public function getBarangaysByMunicipality(Request $request)
    {
        $municipalityCode = $request->query('municipality_code');
        if (!$municipalityCode) {
            return response()->json(['error' => 'Municipality code is required'], 422);
        }

        $barangays = \App\Models\Address\PhBarangay::where('city_id', $municipalityCode)
            ->orderBy('name')
            ->get(['code', 'name', 'city_id'])
            ->map(fn ($b) => ['code' => $b->code, 'name' => $b->name]);

        return response()->json($barangays);
    }

    /**
     * API endpoint for sitios/puroks (not in PSGC; returns empty array)
     */
    public function getSitiosByBarangay(Request $request)
    {
        return response()->json([]);
    }
}
