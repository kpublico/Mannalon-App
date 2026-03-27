<div class="space-y-6">
    <div class="bg-emerald-50 border border-emerald-200 rounded-xl px-4 py-3">
        <p class="text-emerald-800 font-semibold">Updated View Loaded: Farmer Information by Category is now available below.</p>
    </div>

    <!-- EXPORT BUTTONS -->
    <div class="flex gap-3 flex-wrap">
        <button id="export-reports-csv" class="px-5 py-2.5 bg-white text-emerald-600 border-2 border-emerald-600 rounded-lg hover:bg-emerald-50 transition font-semibold">
            <i class="fas fa-file-csv mr-2"></i>Export CSV
        </button>
        <button id="export-reports-pdf" class="px-5 py-2.5 bg-white text-emerald-600 border-2 border-emerald-600 rounded-lg hover:bg-emerald-50 transition font-semibold">
            <i class="fas fa-file-pdf mr-2"></i>Export PDF
        </button>
        <button id="refresh-reports" class="px-5 py-2.5 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 transition font-semibold">
            <i class="fas fa-sync-alt mr-2"></i>Refresh
        </button>
    </div>

    <p class="text-sm text-gray-500">Generated at: {{ $generatedAt ?? 'N/A' }}</p>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="bg-white rounded-xl shadow-md border-l-4 border-emerald-600 p-6">
            <p class="text-gray-600 text-sm font-medium">Total Farmers</p>
            <p class="text-4xl font-bold mt-2 text-gray-900">{{ $totalFarmers ?? 0 }}</p>
        </div>
        <div class="bg-white rounded-xl shadow-md border-l-4 border-emerald-600 p-6">
            <p class="text-gray-600 text-sm font-medium">Active Today</p>
            <p class="text-4xl font-bold mt-2 text-gray-900">{{ $activeToday ?? 0 }}</p>
        </div>
        <div class="bg-white rounded-xl shadow-md border-l-4 border-emerald-600 p-6">
            <p class="text-gray-600 text-sm font-medium">Total Crops</p>
            <p class="text-4xl font-bold mt-2 text-gray-900">{{ $totalCrops ?? 0 }}</p>
        </div>
        <div class="bg-white rounded-xl shadow-md border-l-4 border-emerald-600 p-6">
            <p class="text-gray-600 text-sm font-medium">System Health</p>
            <p class="text-4xl font-bold mt-2 text-gray-900">{{ $systemHealth ?? 0 }}%</p>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-md border border-gray-100 p-6 overflow-x-auto">
        <h3 class="text-xl font-bold text-gray-900 mb-4">Report Breakdown</h3>

        @if(!empty($breakdownRows))
            <table class="min-w-full text-sm">
                <thead>
                    <tr class="text-left text-gray-600 border-b">
                        <th class="py-2 pr-4">Category</th>
                        <th class="py-2 pr-4">Label</th>
                        <th class="py-2 pr-4">Count</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($breakdownRows as $row)
                        <tr class="border-b border-gray-100">
                            <td class="py-2 pr-4">{{ $row['category'] }}</td>
                            <td class="py-2 pr-4">{{ $row['label'] }}</td>
                            <td class="py-2 pr-4 font-semibold">{{ $row['count'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p class="text-gray-600">No report data is currently available.</p>
        @endif
    </div>

    <div class="bg-white rounded-xl shadow-md border border-gray-100 p-6 space-y-4">
        <h3 class="text-xl font-bold text-gray-900">Farmer Information by Category</h3>
        <p class="text-sm text-gray-500">All entered farmer details are separated below by category.</p>

        @if(!empty($farmerProfiles) && count($farmerProfiles) > 0)
            @php
                $yn = static function ($v) {
                    return $v ? 'Yes' : 'No';
                };
            @endphp

            <details class="border border-emerald-100 rounded-lg p-4" open>
                <summary class="font-semibold text-emerald-800 cursor-pointer">1. Personal Information</summary>
                <div class="mt-3 overflow-x-auto">
                    <table class="min-w-full text-sm">
                        <thead><tr class="text-left text-gray-600 border-b"><th class="py-2 pr-3">Farmer</th><th class="py-2 pr-3">Gender</th><th class="py-2 pr-3">DOB</th><th class="py-2 pr-3">Age</th><th class="py-2 pr-3">Civil Status</th><th class="py-2 pr-3">Phone</th><th class="py-2 pr-3">Email</th><th class="py-2 pr-3">Gov ID</th></tr></thead>
                        <tbody>
                        @foreach($farmerProfiles as $farmer)
                            <tr class="border-b border-gray-100">
                                <td class="py-2 pr-3 font-semibold">{{ $farmer->name }}</td>
                                <td class="py-2 pr-3">{{ $farmer->gender ?? 'N/A' }}</td>
                                <td class="py-2 pr-3">{{ optional($farmer->date_of_birth)->format('Y-m-d') ?? 'N/A' }}</td>
                                <td class="py-2 pr-3">{{ $farmer->age ?? 'N/A' }}</td>
                                <td class="py-2 pr-3">{{ $farmer->civil_status ?? 'N/A' }}</td>
                                <td class="py-2 pr-3">{{ $farmer->phone ?? 'N/A' }}</td>
                                <td class="py-2 pr-3">{{ $farmer->email ?? 'N/A' }}</td>
                                <td class="py-2 pr-3">{{ ($farmer->government_id_type ?? 'N/A') . ' / ' . ($farmer->government_id_number ?? 'N/A') }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </details>

            <details class="border border-emerald-100 rounded-lg p-4">
                <summary class="font-semibold text-emerald-800 cursor-pointer">2. Address Information</summary>
                <div class="mt-3 overflow-x-auto">
                    <table class="min-w-full text-sm">
                        <thead><tr class="text-left text-gray-600 border-b"><th class="py-2 pr-3">Farmer</th><th class="py-2 pr-3">Region</th><th class="py-2 pr-3">Province</th><th class="py-2 pr-3">Municipality</th><th class="py-2 pr-3">Barangay</th><th class="py-2 pr-3">Sitio/Purok</th><th class="py-2 pr-3">GPS</th></tr></thead>
                        <tbody>
                        @foreach($farmerProfiles as $farmer)
                            <tr class="border-b border-gray-100">
                                <td class="py-2 pr-3 font-semibold">{{ $farmer->name }}</td>
                                <td class="py-2 pr-3">{{ $farmer->region ?? 'N/A' }}</td>
                                <td class="py-2 pr-3">{{ $farmer->province ?? 'N/A' }}</td>
                                <td class="py-2 pr-3">{{ $farmer->municipality_city ?? 'N/A' }}</td>
                                <td class="py-2 pr-3">{{ $farmer->barangay ?? 'N/A' }}</td>
                                <td class="py-2 pr-3">{{ $farmer->sitio_purok ?? 'N/A' }}</td>
                                <td class="py-2 pr-3">{{ ($farmer->gps_latitude ?? 'N/A') . ', ' . ($farmer->gps_longitude ?? 'N/A') }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </details>

            <details class="border border-emerald-100 rounded-lg p-4">
                <summary class="font-semibold text-emerald-800 cursor-pointer">3. Farming Profile</summary>
                <div class="mt-3 overflow-x-auto">
                    <table class="min-w-full text-sm">
                        <thead><tr class="text-left text-gray-600 border-b"><th class="py-2 pr-3">Farmer</th><th class="py-2 pr-3">Type</th><th class="py-2 pr-3">Years</th><th class="py-2 pr-3">Primary Occupation</th><th class="py-2 pr-3">Secondary Occupation</th><th class="py-2 pr-3">Association Member</th><th class="py-2 pr-3">Association Name</th></tr></thead>
                        <tbody>
                        @foreach($farmerProfiles as $farmer)
                            <tr class="border-b border-gray-100">
                                <td class="py-2 pr-3 font-semibold">{{ $farmer->name }}</td>
                                <td class="py-2 pr-3">{{ $farmer->farmer_type ?? 'N/A' }}</td>
                                <td class="py-2 pr-3">{{ $farmer->years_in_farming ?? 'N/A' }}</td>
                                <td class="py-2 pr-3">{{ $farmer->primary_occupation ?? 'N/A' }}</td>
                                <td class="py-2 pr-3">{{ $farmer->secondary_occupation ?? 'N/A' }}</td>
                                <td class="py-2 pr-3">{{ $yn($farmer->is_association_member) }}</td>
                                <td class="py-2 pr-3">{{ $farmer->association_name ?? 'N/A' }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </details>

            <details class="border border-emerald-100 rounded-lg p-4">
                <summary class="font-semibold text-emerald-800 cursor-pointer">4. Farm Information</summary>
                <div class="mt-3 overflow-x-auto">
                    <table class="min-w-full text-sm">
                        <thead><tr class="text-left text-gray-600 border-b"><th class="py-2 pr-3">Farmer</th><th class="py-2 pr-3">Location</th><th class="py-2 pr-3">Size (ha)</th><th class="py-2 pr-3">Ownership</th><th class="py-2 pr-3">Parcels</th><th class="py-2 pr-3">Boundary Points</th></tr></thead>
                        <tbody>
                        @foreach($farmerProfiles as $farmer)
                            <tr class="border-b border-gray-100">
                                <td class="py-2 pr-3 font-semibold">{{ $farmer->name }}</td>
                                <td class="py-2 pr-3">{{ $farmer->farm_location ?? 'N/A' }}</td>
                                <td class="py-2 pr-3">{{ $farmer->farm_size_hectares ?? 'N/A' }}</td>
                                <td class="py-2 pr-3">{{ $farmer->land_ownership_type ?? 'N/A' }}</td>
                                <td class="py-2 pr-3">{{ $farmer->number_of_parcels ?? 'N/A' }}</td>
                                <td class="py-2 pr-3">{{ is_array($farmer->land_boundary_points) ? count($farmer->land_boundary_points) : 0 }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </details>

            <details class="border border-emerald-100 rounded-lg p-4">
                <summary class="font-semibold text-emerald-800 cursor-pointer">5. Crop and Livestock Information</summary>
                <div class="mt-3 overflow-x-auto">
                    <table class="min-w-full text-sm">
                        <thead><tr class="text-left text-gray-600 border-b"><th class="py-2 pr-3">Farmer</th><th class="py-2 pr-3">Crops</th><th class="py-2 pr-3">Crop Area</th><th class="py-2 pr-3">Season</th><th class="py-2 pr-3">Yield</th><th class="py-2 pr-3">Livestock</th><th class="py-2 pr-3">Count</th></tr></thead>
                        <tbody>
                        @foreach($farmerProfiles as $farmer)
                            <tr class="border-b border-gray-100">
                                <td class="py-2 pr-3 font-semibold">{{ $farmer->name }}</td>
                                <td class="py-2 pr-3">{{ $farmer->crop_types ?? 'N/A' }}</td>
                                <td class="py-2 pr-3">{{ $farmer->crop_area_per_type ?? 'N/A' }}</td>
                                <td class="py-2 pr-3">{{ $farmer->cropping_season ?? 'N/A' }}</td>
                                <td class="py-2 pr-3">{{ $farmer->yield_per_harvest ?? 'N/A' }}</td>
                                <td class="py-2 pr-3">{{ $farmer->livestock_types ?? 'N/A' }}</td>
                                <td class="py-2 pr-3">{{ $farmer->livestock_count ?? 'N/A' }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </details>

            <details class="border border-emerald-100 rounded-lg p-4">
                <summary class="font-semibold text-emerald-800 cursor-pointer">6. Farming Resources and Equipment</summary>
                <div class="mt-3 overflow-x-auto">
                    <table class="min-w-full text-sm">
                        <thead><tr class="text-left text-gray-600 border-b"><th class="py-2 pr-3">Farmer</th><th class="py-2 pr-3">Equipment</th><th class="py-2 pr-3">Irrigation</th><th class="py-2 pr-3">Water Source</th><th class="py-2 pr-3">Fertilizer</th><th class="py-2 pr-3">Pesticide</th></tr></thead>
                        <tbody>
                        @foreach($farmerProfiles as $farmer)
                            <tr class="border-b border-gray-100">
                                <td class="py-2 pr-3 font-semibold">{{ $farmer->name }}</td>
                                <td class="py-2 pr-3">{{ $farmer->farm_equipment ?? 'N/A' }}</td>
                                <td class="py-2 pr-3">{{ $farmer->irrigation_type ?? 'N/A' }}</td>
                                <td class="py-2 pr-3">{{ $farmer->water_source ?? 'N/A' }}</td>
                                <td class="py-2 pr-3">{{ $farmer->fertilizer_usage ?? 'N/A' }}</td>
                                <td class="py-2 pr-3">{{ $farmer->pesticide_usage ?? 'N/A' }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </details>

            <details class="border border-emerald-100 rounded-lg p-4">
                <summary class="font-semibold text-emerald-800 cursor-pointer">7. Financial Information</summary>
                <div class="mt-3 overflow-x-auto">
                    <table class="min-w-full text-sm">
                        <thead><tr class="text-left text-gray-600 border-b"><th class="py-2 pr-3">Farmer</th><th class="py-2 pr-3">Monthly Income</th><th class="py-2 pr-3">Annual Income</th><th class="py-2 pr-3">Income Source</th><th class="py-2 pr-3">Credit Access</th><th class="py-2 pr-3">Insurance</th></tr></thead>
                        <tbody>
                        @foreach($farmerProfiles as $farmer)
                            <tr class="border-b border-gray-100">
                                <td class="py-2 pr-3 font-semibold">{{ $farmer->name }}</td>
                                <td class="py-2 pr-3">{{ $farmer->average_monthly_income ?? 'N/A' }}</td>
                                <td class="py-2 pr-3">{{ $farmer->average_annual_income ?? 'N/A' }}</td>
                                <td class="py-2 pr-3">{{ $farmer->income_source ?? 'N/A' }}</td>
                                <td class="py-2 pr-3">{{ $yn($farmer->has_credit_access) }}</td>
                                <td class="py-2 pr-3">{{ $farmer->insurance_coverage ?? 'N/A' }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </details>

            <details class="border border-emerald-100 rounded-lg p-4">
                <summary class="font-semibold text-emerald-800 cursor-pointer">8. Government Program Participation</summary>
                <div class="mt-3 overflow-x-auto">
                    <table class="min-w-full text-sm">
                        <thead><tr class="text-left text-gray-600 border-b"><th class="py-2 pr-3">Farmer</th><th class="py-2 pr-3">RSBSA Registered</th><th class="py-2 pr-3">Programs Availed</th><th class="py-2 pr-3">Registration Date</th></tr></thead>
                        <tbody>
                        @foreach($farmerProfiles as $farmer)
                            <tr class="border-b border-gray-100">
                                <td class="py-2 pr-3 font-semibold">{{ $farmer->name }}</td>
                                <td class="py-2 pr-3">{{ $yn($farmer->is_rsbsa_registered) }}</td>
                                <td class="py-2 pr-3">{{ $farmer->programs_availed ?? 'N/A' }}</td>
                                <td class="py-2 pr-3">{{ optional($farmer->program_registration_date)->format('Y-m-d') ?? 'N/A' }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </details>

            <details class="border border-emerald-100 rounded-lg p-4">
                <summary class="font-semibold text-emerald-800 cursor-pointer">9. Documents and Attachments</summary>
                <div class="mt-3 overflow-x-auto">
                    <table class="min-w-full text-sm">
                        <thead><tr class="text-left text-gray-600 border-b"><th class="py-2 pr-3">Farmer</th><th class="py-2 pr-3">Valid ID</th><th class="py-2 pr-3">Land Document</th><th class="py-2 pr-3">Farm Photo</th><th class="py-2 pr-3">Barangay Certification</th></tr></thead>
                        <tbody>
                        @foreach($farmerProfiles as $farmer)
                            <tr class="border-b border-gray-100">
                                <td class="py-2 pr-3 font-semibold">{{ $farmer->name }}</td>
                                <td class="py-2 pr-3">{{ $farmer->valid_id_path ? 'Uploaded' : 'N/A' }}</td>
                                <td class="py-2 pr-3">{{ $farmer->land_document_path ? 'Uploaded' : 'N/A' }}</td>
                                <td class="py-2 pr-3">{{ $farmer->farm_photos_path ? 'Uploaded' : 'N/A' }}</td>
                                <td class="py-2 pr-3">{{ $farmer->barangay_certification_path ? 'Uploaded' : 'N/A' }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </details>

            <details class="border border-emerald-100 rounded-lg p-4">
                <summary class="font-semibold text-emerald-800 cursor-pointer">10. System Information</summary>
                <div class="mt-3 overflow-x-auto">
                    <table class="min-w-full text-sm">
                        <thead><tr class="text-left text-gray-600 border-b"><th class="py-2 pr-3">Farmer</th><th class="py-2 pr-3">Profile Status</th><th class="py-2 pr-3">Registered By (User ID)</th><th class="py-2 pr-3">Created At</th></tr></thead>
                        <tbody>
                        @foreach($farmerProfiles as $farmer)
                            <tr class="border-b border-gray-100">
                                <td class="py-2 pr-3 font-semibold">{{ $farmer->name }}</td>
                                <td class="py-2 pr-3">{{ $farmer->profile_status ?? 'N/A' }}</td>
                                <td class="py-2 pr-3">{{ $farmer->registered_by ?? 'N/A' }}</td>
                                <td class="py-2 pr-3">{{ optional($farmer->created_at)->format('Y-m-d H:i') ?? 'N/A' }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </details>
        @else
            <p class="text-gray-600">No farmer profiles found to display.</p>
        @endif
    </div>
</div>

<script>
    (function initReportsActions() {
        const csvBtn = document.getElementById('export-reports-csv');
        const pdfBtn = document.getElementById('export-reports-pdf');
        const refreshBtn = document.getElementById('refresh-reports');

        if (csvBtn) {
            csvBtn.addEventListener('click', function () {
                window.location.href = '{{ route('admin.reports-analytics.export-csv') }}';
            });
        }

        if (pdfBtn) {
            pdfBtn.addEventListener('click', function () {
                window.location.href = '{{ route('admin.reports-analytics.export-pdf') }}';
            });
        }

        if (refreshBtn) {
            refreshBtn.addEventListener('click', function () {
                if (typeof loadAdminPage === 'function') {
                    loadAdminPage('reports-analytics', '{{ route('admin.reports-analytics') }}');
                } else {
                    window.location.reload();
                }
            });
        }
    })();
</script>
