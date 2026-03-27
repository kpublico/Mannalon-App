<?php

namespace App\Http\Controllers;

use App\Models\Beneficiary;
use App\Models\FarmDetail;
use App\Models\Farmer;
use App\Models\ServiceAccessLog;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class AdminLandManagementController extends Controller
{
    /**
     * Create a farmer directory record entered by admin.
     */
    public function storeFarmer(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'farm_location' => ['nullable', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:30'],
        ]);

        Farmer::create($validated);

        return redirect()->route('admin.land.index')->with('success', 'Farmer information added successfully.');
    }

    /**
     * Create or update a farmer land detail record entered by admin.
     */
    public function storeFarmDetail(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'farmer_id' => ['required', 'exists:farmers,id'],
            'latitude' => ['nullable', 'numeric', 'between:-90,90'],
            'longitude' => ['nullable', 'numeric', 'between:-180,180'],
            'farm_size' => ['required', 'numeric', 'min:0'],
            'land_type' => ['nullable', 'string', 'max:100'],
            'notes' => ['nullable', 'string', 'max:1000'],
        ]);

        FarmDetail::updateOrCreate(
            ['farmer_id' => $validated['farmer_id']],
            [
                'latitude' => $validated['latitude'] ?? null,
                'longitude' => $validated['longitude'] ?? null,
                'farm_size' => $validated['farm_size'],
                'land_type' => $validated['land_type'] ?? null,
                'notes' => $validated['notes'] ?? null,
            ]
        );

        return redirect()->route('admin.land.index')->with('success', 'Land detail saved successfully.');
    }

    /**
     * Main admin land management dashboard.
     */
    public function index(Request $request): View
    {
        $search = trim((string) $request->query('search', ''));

        $farmerQuery = Farmer::query()->with('farmDetail');
        if ($search !== '') {
            $farmerQuery->where(function ($q) use ($search): void {
                $q->where('name', 'like', '%' . $search . '%')
                    ->orWhere('farm_location', 'like', '%' . $search . '%');
            });
        }

        $farmers = $farmerQuery->orderBy('name')->get();
        $beneficiaries = Beneficiary::with('farmer')->latest()->limit(30)->get();
        $ayudaBeneficiaries = Beneficiary::with('farmer')
            ->where('service_type', 'Ayuda')
            ->latest()
            ->get();
        $serviceAccessLogs = ServiceAccessLog::with('farmer')
            ->orderByDesc('last_accessed_at')
            ->limit(30)
            ->get();
        $farmDetails = FarmDetail::with('farmer')->whereNotNull('latitude')->whereNotNull('longitude')->get();

        $viewData = [
            'search' => $search,
            'farmers' => $farmers,
            'beneficiaries' => $beneficiaries,
            'ayudaBeneficiaries' => $ayudaBeneficiaries,
            'serviceAccessLogs' => $serviceAccessLogs,
            'farmDetails' => $farmDetails,
            'admin' => $request->user(),
            'totalFarmers' => Farmer::count(),
            'totalLandArea' => FarmDetail::sum('farm_size'),
            'pendingAyuda' => Beneficiary::where('service_type', 'Ayuda')->where('ayuda_status', 'pending')->count(),
        ];

        if ($request->ajax()) {
            return view('admin.land-management-content', $viewData);
        }

        return view('admin.land-management.index', $viewData);
    }

    /**
     * Update administrator profile and optional password.
     */
    public function updateProfile(Request $request): RedirectResponse
    {
        $admin = $request->user();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', Rule::unique('users', 'email')->ignore($admin->id)],
            'new_password' => ['nullable', 'string', 'min:8', 'confirmed'],
            'current_password' => ['nullable', 'string'],
        ]);

        $admin->name = $validated['name'];
        $admin->email = $validated['email'];

        if (!empty($validated['new_password'])) {
            if (empty($validated['current_password']) || !Hash::check($validated['current_password'], $admin->password)) {
                return back()->withErrors([
                    'current_password' => 'Current password is incorrect.',
                ])->withInput();
            }

            $admin->password = Hash::make($validated['new_password']);
        }

        $admin->save();

        return redirect()->route('admin.land.index')->with('success', 'Admin profile updated successfully.');
    }

    /**
     * Create new beneficiary entry with server-side validation.
     */
    public function storeBeneficiary(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'farmer_id' => ['required', 'exists:farmers,id'],
            'service_type' => ['required', 'string', 'max:100'],
            'program_name' => ['nullable', 'string', 'max:150'],
            'aid_amount' => ['nullable', 'numeric', 'min:0'],
            'ayuda_status' => ['required', Rule::in(['pending', 'claimed'])],
            'distributed_at' => ['nullable', 'date'],
            'notes' => ['nullable', 'string', 'max:1000'],
        ]);

        Beneficiary::create($validated);

        return redirect()->route('admin.land.index')->with('success', 'Beneficiary added successfully.');
    }

    /**
     * Update existing beneficiary entry.
     */
    public function updateBeneficiary(Request $request, Beneficiary $beneficiary): RedirectResponse
    {
        $validated = $request->validate([
            'farmer_id' => ['required', 'exists:farmers,id'],
            'service_type' => ['required', 'string', 'max:100'],
            'program_name' => ['nullable', 'string', 'max:150'],
            'aid_amount' => ['nullable', 'numeric', 'min:0'],
            'ayuda_status' => ['required', Rule::in(['pending', 'claimed'])],
            'distributed_at' => ['nullable', 'date'],
            'notes' => ['nullable', 'string', 'max:1000'],
        ]);

        $beneficiary->update($validated);

        return redirect()->route('admin.land.index')->with('success', 'Beneficiary updated successfully.');
    }

    /**
     * Delete beneficiary entry.
     */
    public function destroyBeneficiary(Beneficiary $beneficiary): RedirectResponse
    {
        $beneficiary->delete();

        return redirect()->route('admin.land.index')->with('success', 'Beneficiary removed successfully.');
    }

    /**
     * Toggle Ayuda distribution status between pending and claimed.
     */
    public function toggleAyudaStatus(Beneficiary $beneficiary): RedirectResponse
    {
        $nextStatus = $beneficiary->ayuda_status === 'claimed' ? 'pending' : 'claimed';

        $payload = ['ayuda_status' => $nextStatus];
        if ($nextStatus === 'claimed' && empty($beneficiary->distributed_at)) {
            $payload['distributed_at'] = now()->format('Y-m-d H:i:s');
        }

        $beneficiary->update($payload);

        return redirect()->route('admin.land.index')->with('success', 'Ayuda status updated successfully.');
    }
}
