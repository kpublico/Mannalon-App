<div class="space-y-6">
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

    <!-- Farmer Selector Card -->
    <div class="bg-white rounded-xl shadow-md border border-gray-100 p-6">
        <div class="space-y-4">
            <label class="block text-lg font-semibold text-gray-700">
                <i class="fas fa-users mr-2 text-emerald-600"></i>Select a Farmer to View Details
            </label>

            <div class="flex gap-3 items-end flex-wrap">
                <div class="flex-1 min-w-xs">
                    <select id="farmer_id_reports" onchange="loadFarmerDetails();" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-600 focus:border-transparent font-medium">
                        <option value="">-- Choose a Farmer --</option>
                        @if(isset($farmerProfiles))
                            @foreach($farmerProfiles as $f)
                                <option value="{{ $f->id }}" @selected(isset($selectedFarmerId) && $selectedFarmerId == $f->id)>
                                    #{{ $f->id }} - {{ $f->first_name }} {{ $f->last_name }} ({{ $f->municipality_city ?? 'N/A' }})
                                </option>
                            @endforeach
                        @endif
                    </select>
                </div>

                @if(isset($selectedFarmerId) && $selectedFarmerId)
                    <button type="button" onclick="clearFarmerSelection();" class="px-4 py-2.5 bg-red-600 text-white rounded-lg hover:bg-red-700 transition font-medium whitespace-nowrap">
                        <i class="fas fa-times mr-1"></i>Clear Selection
                    </button>
                @endif
            </div>
        </div>
    </div>

    <!-- Farmer Details Section -->
    @if(isset($selectedFarmer) && $selectedFarmer)
        <div class="bg-white rounded-xl shadow-md border border-gray-100 p-6">
            <!-- Header with Actions -->
            <div class="flex justify-between items-start pb-6 border-b-2 border-gray-200 mb-6">
                <div>
                    <h3 class="text-3xl font-bold text-gray-900">
                        <i class="fas fa-user-circle mr-2 text-emerald-600"></i><span id="displayName">{{ $selectedFarmer->first_name }} {{ $selectedFarmer->middle_name ? $selectedFarmer->middle_name . ' ' : '' }}{{ $selectedFarmer->last_name }}</span>
                    </h3>
                    <p class="text-gray-500 mt-2">
                        <span class="inline-block mr-4"><strong>Farmer ID:</strong> #{{ $selectedFarmer->id }}</span>
                        <span class="inline-block"><strong>Status:</strong>
                            @if($selectedFarmer->profile_status === 'active')
                                <span class="px-3 py-1 bg-emerald-100 text-emerald-700 rounded-full text-sm font-medium"><i class="fas fa-check-circle"></i> Active</span>
                            @elseif($selectedFarmer->profile_status === 'inactive')
                                <span class="px-3 py-1 bg-red-100 text-red-700 rounded-full text-sm font-medium"><i class="fas fa-times-circle"></i> Inactive</span>
                            @else
                                <span class="px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-sm font-medium"><i class="fas fa-check-double"></i> Verified</span>
                            @endif
                        </span>
                    </p>
                </div>
                <div class="flex gap-3" id="actionButtons">
                    <button type="button" onclick="openEditModal()" class="px-4 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 transition font-medium whitespace-nowrap">
                        <i class="fas fa-edit mr-2"></i>Edit Information
                    </button>
                    <button type="button" onclick="confirmDelete({{ $selectedFarmer->id }}, '{{ $selectedFarmer->first_name }} {{ $selectedFarmer->last_name }}')" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition font-medium whitespace-nowrap">
                        <i class="fas fa-trash mr-2"></i>Delete
                    </button>
                </div>
            </div>

            <!-- Complete Farmer Information in Organized Sections -->
            <div class="space-y-6" id="viewMode">

                <!-- 1. PERSONAL INFORMATION -->
                <div class="border border-gray-200 rounded-lg overflow-hidden">
                    <div class="bg-gradient-to-r from-emerald-500 to-emerald-600 text-white px-4 py-3 font-bold text-lg">
                        <i class="fas fa-user mr-2"></i>1. PERSONAL INFORMATION
                    </div>
                    <div class="p-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            <div class="bg-gray-50 p-3 rounded">
                                <div class="text-xs font-semibold text-gray-500 uppercase mb-1">First Name</div>
                                <div class="text-gray-900 font-medium">{{ $selectedFarmer->first_name ?? 'Not provided' }}</div>
                            </div>
                            <div class="bg-gray-50 p-3 rounded">
                                <div class="text-xs font-semibold text-gray-500 uppercase mb-1">Middle Name</div>
                                <div class="text-gray-900 font-medium">{{ $selectedFarmer->middle_name ?? 'Not provided' }}</div>
                            </div>
                            <div class="bg-gray-50 p-3 rounded">
                                <div class="text-xs font-semibold text-gray-500 uppercase mb-1">Last Name</div>
                                <div class="text-gray-900 font-medium">{{ $selectedFarmer->last_name ?? 'Not provided' }}</div>
                            </div>
                            <div class="bg-gray-50 p-3 rounded">
                                <div class="text-xs font-semibold text-gray-500 uppercase mb-1">Gender</div>
                                <div class="text-gray-900 font-medium">{{ $selectedFarmer->gender ? ucfirst($selectedFarmer->gender) : 'Not provided' }}</div>
                            </div>
                            <div class="bg-gray-50 p-3 rounded">
                                <div class="text-xs font-semibold text-gray-500 uppercase mb-1">Date of Birth</div>
                                <div class="text-gray-900 font-medium">{{ $selectedFarmer->date_of_birth ? \Carbon\Carbon::parse($selectedFarmer->date_of_birth)->format('M d, Y') : 'Not provided' }}</div>
                            </div>
                            <div class="bg-gray-50 p-3 rounded">
                                <div class="text-xs font-semibold text-gray-500 uppercase mb-1">Age</div>
                                <div class="text-gray-900 font-medium">{{ $selectedFarmer->age ?? 'Not provided' }}</div>
                            </div>
                            <div class="bg-gray-50 p-3 rounded">
                                <div class="text-xs font-semibold text-gray-500 uppercase mb-1">Civil Status</div>
                                <div class="text-gray-900 font-medium">{{ $selectedFarmer->civil_status ? ucfirst($selectedFarmer->civil_status) : 'Not provided' }}</div>
                            </div>
                            <div class="bg-gray-50 p-3 rounded">
                                <div class="text-xs font-semibold text-gray-500 uppercase mb-1">Phone Number</div>
                                <div class="text-gray-900 font-medium">{{ $selectedFarmer->phone ?? 'Not provided' }}</div>
                            </div>
                            <div class="bg-gray-50 p-3 rounded">
                                <div class="text-xs font-semibold text-gray-500 uppercase mb-1">Email Address</div>
                                <div class="text-gray-900 font-medium">{{ $selectedFarmer->email ?? 'Not provided' }}</div>
                            </div>
                            <div class="bg-gray-50 p-3 rounded">
                                <div class="text-xs font-semibold text-gray-500 uppercase mb-1">Government ID Type</div>
                                <div class="text-gray-900 font-medium">{{ $selectedFarmer->government_id_type ?? 'Not provided' }}</div>
                            </div>
                            <div class="bg-gray-50 p-3 rounded">
                                <div class="text-xs font-semibold text-gray-500 uppercase mb-1">Government ID Number</div>
                                <div class="text-gray-900 font-medium">{{ $selectedFarmer->government_id_number ?? 'Not provided' }}</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 2. ADDRESS INFORMATION -->
                <div class="border border-gray-200 rounded-lg overflow-hidden">
                    <div class="bg-gradient-to-r from-emerald-500 to-emerald-600 text-white px-4 py-3 font-bold text-lg">
                        <i class="fas fa-map-marker-alt mr-2"></i>2. ADDRESS INFORMATION
                    </div>
                    <div class="p-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            <div class="bg-gray-50 p-3 rounded">
                                <div class="text-xs font-semibold text-gray-500 uppercase mb-1">Region</div>
                                <div class="text-gray-900 font-medium">{{ $selectedFarmer->region ?? 'Not provided' }}</div>
                            </div>
                            <div class="bg-gray-50 p-3 rounded">
                                <div class="text-xs font-semibold text-gray-500 uppercase mb-1">Province</div>
                                <div class="text-gray-900 font-medium">{{ $selectedFarmer->province ?? 'Not provided' }}</div>
                            </div>
                            <div class="bg-gray-50 p-3 rounded">
                                <div class="text-xs font-semibold text-gray-500 uppercase mb-1">Municipality/City</div>
                                <div class="text-gray-900 font-medium">{{ $selectedFarmer->municipality_city ?? 'Not provided' }}</div>
                            </div>
                            <div class="bg-gray-50 p-3 rounded">
                                <div class="text-xs font-semibold text-gray-500 uppercase mb-1">Barangay</div>
                                <div class="text-gray-900 font-medium">{{ $selectedFarmer->barangay ?? 'Not provided' }}</div>
                            </div>
                            <div class="bg-gray-50 p-3 rounded">
                                <div class="text-xs font-semibold text-gray-500 uppercase mb-1">Sitio/Purok</div>
                                <div class="text-gray-900 font-medium">{{ $selectedFarmer->sitio_purok ?? 'Not provided' }}</div>
                            </div>
                            <div class="bg-gray-50 p-3 rounded">
                                <div class="text-xs font-semibold text-gray-500 uppercase mb-1">GPS Latitude</div>
                                <div class="text-gray-900 font-medium">{{ $selectedFarmer->gps_latitude ?? 'Not provided' }}</div>
                            </div>
                            <div class="bg-gray-50 p-3 rounded">
                                <div class="text-xs font-semibold text-gray-500 uppercase mb-1">GPS Longitude</div>
                                <div class="text-gray-900 font-medium">{{ $selectedFarmer->gps_longitude ?? 'Not provided' }}</div>
                            </div>
                            @php $boundaryPoints = is_array($selectedFarmer->land_boundary_points ?? null) ? count($selectedFarmer->land_boundary_points) : 0; @endphp
                            <div class="bg-gray-50 p-3 rounded">
                                <div class="text-xs font-semibold text-gray-500 uppercase mb-1">Land Boundary Points</div>
                                <div class="text-gray-900 font-medium">{{ $boundaryPoints > 0 ? $boundaryPoints . ' point(s)' : 'Not provided' }}</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 3. FARM INFORMATION -->
                <div class="border border-gray-200 rounded-lg overflow-hidden">
                    <div class="bg-gradient-to-r from-emerald-500 to-emerald-600 text-white px-4 py-3 font-bold text-lg">
                        <i class="fas fa-tractor mr-2"></i>3. FARM INFORMATION
                    </div>
                    <div class="p-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            <div class="bg-gray-50 p-3 rounded">
                                <div class="text-xs font-semibold text-gray-500 uppercase mb-1">Farmer Type</div>
                                <div class="text-gray-900 font-medium">{{ $selectedFarmer->farmer_type ? ucfirst(str_replace('_', ' ', $selectedFarmer->farmer_type)) : 'Not provided' }}</div>
                            </div>
                            <div class="bg-gray-50 p-3 rounded">
                                <div class="text-xs font-semibold text-gray-500 uppercase mb-1">Years in Farming</div>
                                <div class="text-gray-900 font-medium">{{ $selectedFarmer->years_in_farming !== null ? $selectedFarmer->years_in_farming . ' year(s)' : 'Not provided' }}</div>
                            </div>
                            <div class="bg-gray-50 p-3 rounded">
                                <div class="text-xs font-semibold text-gray-500 uppercase mb-1">Primary Occupation</div>
                                <div class="text-gray-900 font-medium">{{ $selectedFarmer->primary_occupation ?? 'Not provided' }}</div>
                            </div>
                            <div class="bg-gray-50 p-3 rounded">
                                <div class="text-xs font-semibold text-gray-500 uppercase mb-1">Secondary Occupation</div>
                                <div class="text-gray-900 font-medium">{{ $selectedFarmer->secondary_occupation ?? 'Not provided' }}</div>
                            </div>
                            <div class="bg-gray-50 p-3 rounded">
                                <div class="text-xs font-semibold text-gray-500 uppercase mb-1">Farm Location</div>
                                <div class="text-gray-900 font-medium">{{ $selectedFarmer->farm_location ?? 'Not provided' }}</div>
                            </div>
                            <div class="bg-gray-50 p-3 rounded">
                                <div class="text-xs font-semibold text-gray-500 uppercase mb-1">Farm Size (hectares)</div>
                                <div class="text-gray-900 font-medium">{{ $selectedFarmer->farm_size_hectares ?? 'Not provided' }}</div>
                            </div>
                            <div class="bg-gray-50 p-3 rounded">
                                <div class="text-xs font-semibold text-gray-500 uppercase mb-1">Land Ownership Type</div>
                                <div class="text-gray-900 font-medium">{{ $selectedFarmer->land_ownership_type ? ucfirst($selectedFarmer->land_ownership_type) : 'Not provided' }}</div>
                            </div>
                            <div class="bg-gray-50 p-3 rounded">
                                <div class="text-xs font-semibold text-gray-500 uppercase mb-1">Number of Parcels</div>
                                <div class="text-gray-900 font-medium">{{ $selectedFarmer->number_of_parcels ?? 'Not provided' }}</div>
                            </div>
                            <div class="bg-gray-50 p-3 rounded">
                                <div class="text-xs font-semibold text-gray-500 uppercase mb-1">Association Member</div>
                                <div class="text-gray-900 font-medium">{{ $selectedFarmer->is_association_member ? 'Yes' : 'No' }}</div>
                            </div>
                            <div class="bg-gray-50 p-3 rounded">
                                <div class="text-xs font-semibold text-gray-500 uppercase mb-1">Association Name</div>
                                <div class="text-gray-900 font-medium">{{ $selectedFarmer->association_name ?? 'Not provided' }}</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 4. PRODUCTION INFORMATION -->
                <div class="border border-gray-200 rounded-lg overflow-hidden">
                    <div class="bg-gradient-to-r from-emerald-500 to-emerald-600 text-white px-4 py-3 font-bold text-lg">
                        <i class="fas fa-leaf mr-2"></i>4. PRODUCTION INFORMATION
                    </div>
                    <div class="p-4">
                        <div class="grid grid-cols-1 gap-4">
                            <div class="bg-gray-50 p-3 rounded">
                                <div class="text-xs font-semibold text-gray-500 uppercase mb-1">Crop Types</div>
                                <div class="text-gray-900 font-medium whitespace-pre-wrap">{{ $selectedFarmer->crop_types ?? 'Not provided' }}</div>
                            </div>
                            <div class="bg-gray-50 p-3 rounded">
                                <div class="text-xs font-semibold text-gray-500 uppercase mb-1">Crop Area per Type</div>
                                <div class="text-gray-900 font-medium whitespace-pre-wrap">{{ $selectedFarmer->crop_area_per_type ?? 'Not provided' }}</div>
                            </div>
                            <div class="bg-gray-50 p-3 rounded">
                                <div class="text-xs font-semibold text-gray-500 uppercase mb-1">Cropping Season</div>
                                <div class="text-gray-900 font-medium">{{ $selectedFarmer->cropping_season ? ucfirst(str_replace('_', '/', $selectedFarmer->cropping_season)) : 'Not provided' }}</div>
                            </div>
                            <div class="bg-gray-50 p-3 rounded">
                                <div class="text-xs font-semibold text-gray-500 uppercase mb-1">Yield per Harvest</div>
                                <div class="text-gray-900 font-medium">{{ $selectedFarmer->yield_per_harvest ?? 'Not provided' }}</div>
                            </div>
                            <div class="bg-gray-50 p-3 rounded">
                                <div class="text-xs font-semibold text-gray-500 uppercase mb-1">Livestock Types</div>
                                <div class="text-gray-900 font-medium whitespace-pre-wrap">{{ $selectedFarmer->livestock_types ?? 'Not provided' }}</div>
                            </div>
                            <div class="bg-gray-50 p-3 rounded">
                                <div class="text-xs font-semibold text-gray-500 uppercase mb-1">Livestock Count</div>
                                <div class="text-gray-900 font-medium">{{ $selectedFarmer->livestock_count ?? 'Not provided' }}</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 5. RESOURCES & EQUIPMENT -->
                <div class="border border-gray-200 rounded-lg overflow-hidden">
                    <div class="bg-gradient-to-r from-emerald-500 to-emerald-600 text-white px-4 py-3 font-bold text-lg">
                        <i class="fas fa-tools mr-2"></i>5. RESOURCES & EQUIPMENT
                    </div>
                    <div class="p-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="bg-gray-50 p-3 rounded">
                                <div class="text-xs font-semibold text-gray-500 uppercase mb-1">Farm Equipment</div>
                                <div class="text-gray-900 font-medium whitespace-pre-wrap">{{ $selectedFarmer->farm_equipment ?? 'Not provided' }}</div>
                            </div>
                            <div class="bg-gray-50 p-3 rounded">
                                <div class="text-xs font-semibold text-gray-500 uppercase mb-1">Irrigation Type</div>
                                <div class="text-gray-900 font-medium">{{ $selectedFarmer->irrigation_type ? ucfirst($selectedFarmer->irrigation_type) : 'Not provided' }}</div>
                            </div>
                            <div class="bg-gray-50 p-3 rounded">
                                <div class="text-xs font-semibold text-gray-500 uppercase mb-1">Water Source</div>
                                <div class="text-gray-900 font-medium">{{ $selectedFarmer->water_source ?? 'Not provided' }}</div>
                            </div>
                            <div class="bg-gray-50 p-3 rounded">
                                <div class="text-xs font-semibold text-gray-500 uppercase mb-1">Fertilizer Usage</div>
                                <div class="text-gray-900 font-medium">{{ $selectedFarmer->fertilizer_usage ? ucfirst($selectedFarmer->fertilizer_usage) : 'Not provided' }}</div>
                            </div>
                            <div class="bg-gray-50 p-3 rounded col-span-1 md:col-span-2">
                                <div class="text-xs font-semibold text-gray-500 uppercase mb-1">Pesticide Usage</div>
                                <div class="text-gray-900 font-medium">{{ $selectedFarmer->pesticide_usage ?? 'Not provided' }}</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 6. FINANCIAL INFORMATION -->
                <div class="border border-gray-200 rounded-lg overflow-hidden">
                    <div class="bg-gradient-to-r from-emerald-500 to-emerald-600 text-white px-4 py-3 font-bold text-lg">
                        <i class="fas fa-money-bill-wave mr-2"></i>6. FINANCIAL INFORMATION
                    </div>
                    <div class="p-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            <div class="bg-gray-50 p-3 rounded">
                                <div class="text-xs font-semibold text-gray-500 uppercase mb-1">Average Monthly Income</div>
                                <div class="text-gray-900 font-medium">{{ $selectedFarmer->average_monthly_income !== null ? '₱' . number_format((float) $selectedFarmer->average_monthly_income, 2) : 'Not provided' }}</div>
                            </div>
                            <div class="bg-gray-50 p-3 rounded">
                                <div class="text-xs font-semibold text-gray-500 uppercase mb-1">Average Annual Income</div>
                                <div class="text-gray-900 font-medium">{{ $selectedFarmer->average_annual_income !== null ? '₱' . number_format((float) $selectedFarmer->average_annual_income, 2) : 'Not provided' }}</div>
                            </div>
                            <div class="bg-gray-50 p-3 rounded">
                                <div class="text-xs font-semibold text-gray-500 uppercase mb-1">Income Source</div>
                                <div class="text-gray-900 font-medium">{{ $selectedFarmer->income_source ? ucfirst(str_replace('_', '-', $selectedFarmer->income_source)) : 'Not provided' }}</div>
                            </div>
                            <div class="bg-gray-50 p-3 rounded">
                                <div class="text-xs font-semibold text-gray-500 uppercase mb-1">Access to Credit/Loans</div>
                                <div class="text-gray-900 font-medium">{{ $selectedFarmer->has_credit_access ? 'Yes' : 'No' }}</div>
                            </div>
                            <div class="bg-gray-50 p-3 rounded">
                                <div class="text-xs font-semibold text-gray-500 uppercase mb-1">Insurance Coverage</div>
                                <div class="text-gray-900 font-medium">{{ $selectedFarmer->insurance_coverage ?? 'Not provided' }}</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 7. GOVERNMENT PROGRAMS -->
                <div class="border border-gray-200 rounded-lg overflow-hidden">
                    <div class="bg-gradient-to-r from-emerald-500 to-emerald-600 text-white px-4 py-3 font-bold text-lg">
                        <i class="fas fa-graduation-cap mr-2"></i>7. GOVERNMENT PROGRAM PARTICIPATION
                    </div>
                    <div class="p-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="bg-gray-50 p-3 rounded">
                                <div class="text-xs font-semibold text-gray-500 uppercase mb-1">RSBSA Registered</div>
                                <div class="text-gray-900 font-medium">{{ $selectedFarmer->is_rsbsa_registered ? 'Yes' : 'No' }}</div>
                            </div>
                            <div class="bg-gray-50 p-3 rounded">
                                <div class="text-xs font-semibold text-gray-500 uppercase mb-1">Program Registration Date</div>
                                <div class="text-gray-900 font-medium">{{ $selectedFarmer->program_registration_date ? \Carbon\Carbon::parse($selectedFarmer->program_registration_date)->format('M d, Y') : 'Not provided' }}</div>
                            </div>
                            <div class="bg-gray-50 p-3 rounded col-span-1 md:col-span-2">
                                <div class="text-xs font-semibold text-gray-500 uppercase mb-1">Programs Availed</div>
                                <div class="text-gray-900 font-medium whitespace-pre-wrap">{{ $selectedFarmer->programs_availed ?? 'Not provided' }}</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 8. DOCUMENTS & ATTACHMENTS -->
                <div class="border border-gray-200 rounded-lg overflow-hidden">
                    <div class="bg-gradient-to-r from-emerald-500 to-emerald-600 text-white px-4 py-3 font-bold text-lg">
                        <i class="fas fa-file-upload mr-2"></i>8. DOCUMENTS & ATTACHMENTS
                    </div>
                    <div class="p-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="bg-gray-50 p-3 rounded">
                                <div class="text-xs font-semibold text-gray-500 uppercase mb-1">Valid ID</div>
                                <div class="text-gray-900 font-medium">
                                    @if($selectedFarmer->valid_id_path)
                                        <span class="text-green-600"><i class="fas fa-check-circle"></i> Uploaded</span>
                                    @else
                                        <span class="text-red-600"><i class="fas fa-times-circle"></i> Not Uploaded</span>
                                    @endif
                                </div>
                            </div>
                            <div class="bg-gray-50 p-3 rounded">
                                <div class="text-xs font-semibold text-gray-500 uppercase mb-1">Land Document</div>
                                <div class="text-gray-900 font-medium">
                                    @if($selectedFarmer->land_document_path)
                                        <span class="text-green-600"><i class="fas fa-check-circle"></i> Uploaded</span>
                                    @else
                                        <span class="text-red-600"><i class="fas fa-times-circle"></i> Not Uploaded</span>
                                    @endif
                                </div>
                            </div>
                            <div class="bg-gray-50 p-3 rounded">
                                <div class="text-xs font-semibold text-gray-500 uppercase mb-1">Farm Photo</div>
                                <div class="text-gray-900 font-medium">
                                    @if($selectedFarmer->farm_photos_path)
                                        <span class="text-green-600"><i class="fas fa-check-circle"></i> Uploaded</span>
                                    @else
                                        <span class="text-red-600"><i class="fas fa-times-circle"></i> Not Uploaded</span>
                                    @endif
                                </div>
                            </div>
                            <div class="bg-gray-50 p-3 rounded">
                                <div class="text-xs font-semibold text-gray-500 uppercase mb-1">Barangay Certification</div>
                                <div class="text-gray-900 font-medium">
                                    @if($selectedFarmer->barangay_certification_path)
                                        <span class="text-green-600"><i class="fas fa-check-circle"></i> Uploaded</span>
                                    @else
                                        <span class="text-red-600"><i class="fas fa-times-circle"></i> Not Uploaded</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 9. SYSTEM INFORMATION -->
                <div class="border border-gray-200 rounded-lg overflow-hidden">
                    <div class="bg-gradient-to-r from-emerald-500 to-emerald-600 text-white px-4 py-3 font-bold text-lg">
                        <i class="fas fa-cog mr-2"></i>9. SYSTEM INFORMATION
                    </div>
                    <div class="p-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="bg-gray-50 p-3 rounded">
                                <div class="text-xs font-semibold text-gray-500 uppercase mb-1">Profile Status</div>
                                <div class="text-gray-900 font-medium">{{ ucfirst($selectedFarmer->profile_status ?? 'active') }}</div>
                            </div>
                            <div class="bg-gray-50 p-3 rounded">
                                <div class="text-xs font-semibold text-gray-500 uppercase mb-1">Registered By (Admin ID)</div>
                                <div class="text-gray-900 font-medium">{{ $selectedFarmer->registered_by ?? 'Not recorded' }}</div>
                            </div>
                            <div class="bg-gray-50 p-3 rounded">
                                <div class="text-xs font-semibold text-gray-500 uppercase mb-1">Registration Date</div>
                                <div class="text-gray-900 font-medium">{{ $selectedFarmer->created_at?->format('M d, Y h:i A') ?? 'Not available' }}</div>
                            </div>
                            <div class="bg-gray-50 p-3 rounded">
                                <div class="text-xs font-semibold text-gray-500 uppercase mb-1">Last Updated</div>
                                <div class="text-gray-900 font-medium">{{ $selectedFarmer->updated_at?->format('M d, Y h:i A') ?? 'Not available' }}</div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Edit Modal -->
            <div id="editModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4" style="display: none;">
                <div class="bg-white rounded-lg shadow-xl max-w-4xl w-full max-h-[90vh] overflow-y-auto">
                    <div class="sticky top-0 bg-white border-b-2 border-gray-200 px-6 py-4 flex justify-between items-center">
                        <h3 class="text-2xl font-bold text-gray-900">Edit Farmer Information</h3>
                        <button type="button" onclick="closeEditModal()" class="text-gray-500 hover:text-gray-700 text-2xl">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>

                    <form id="editFarmerForm" method="POST" action="{{ route('admin.farmers.update', $selectedFarmer->id) }}" class="p-6">
                        @csrf
                        @method('PUT')

                        <!-- 1. PERSONAL INFORMATION -->
                        <h4 class="text-lg font-bold text-emerald-600 mb-4 mt-4">1. Personal Information</h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-6">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">First Name *</label>
                                <input type="text" name="first_name" value="{{ $selectedFarmer->first_name }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-600" required>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Middle Name</label>
                                <input type="text" name="middle_name" value="{{ $selectedFarmer->middle_name }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-600">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Last Name *</label>
                                <input type="text" name="last_name" value="{{ $selectedFarmer->last_name }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-600" required>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Gender</label>
                                <select name="gender" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-600">
                                    <option value="">Select</option>
                                    <option value="male" @selected($selectedFarmer->gender === 'male')>Male</option>
                                    <option value="female" @selected($selectedFarmer->gender === 'female')>Female</option>
                                    <option value="other" @selected($selectedFarmer->gender === 'other')>Other</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Date of Birth</label>
                                <input type="date" name="date_of_birth" value="{{ optional($selectedFarmer->date_of_birth)->format('Y-m-d') }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-600">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Age</label>
                                <input type="number" name="age" min="1" max="120" value="{{ $selectedFarmer->age }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-600">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Civil Status</label>
                                <select name="civil_status" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-600">
                                    <option value="">Select</option>
                                    <option value="single" @selected($selectedFarmer->civil_status === 'single')>Single</option>
                                    <option value="married" @selected($selectedFarmer->civil_status === 'married')>Married</option>
                                    <option value="divorced" @selected($selectedFarmer->civil_status === 'divorced')>Divorced</option>
                                    <option value="widowed" @selected($selectedFarmer->civil_status === 'widowed')>Widowed</option>
                                    <option value="separated" @selected($selectedFarmer->civil_status === 'separated')>Separated</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Phone Number</label>
                                <input type="text" name="phone" value="{{ $selectedFarmer->phone }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-600">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Email Address</label>
                                <input type="email" name="email" value="{{ $selectedFarmer->email }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-600">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Government ID Type</label>
                                <input type="text" name="government_id_type" value="{{ $selectedFarmer->government_id_type }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-600">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Government ID Number</label>
                                <input type="text" name="government_id_number" value="{{ $selectedFarmer->government_id_number }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-600">
                            </div>
                        </div>

                        <!-- 2. ADDRESS INFORMATION -->
                        <h4 class="text-lg font-bold text-emerald-600 mb-4 mt-6">2. Address Information</h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-6">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Region</label>
                                <input type="text" name="region" value="{{ $selectedFarmer->region }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-600">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Province</label>
                                <input type="text" name="province" value="{{ $selectedFarmer->province }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-600">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Municipality/City</label>
                                <input type="text" name="municipality_city" value="{{ $selectedFarmer->municipality_city }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-600">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Barangay</label>
                                <input type="text" name="barangay" value="{{ $selectedFarmer->barangay }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-600">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Sitio/Purok</label>
                                <input type="text" name="sitio_purok" value="{{ $selectedFarmer->sitio_purok }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-600">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">GPS Latitude</label>
                                <input type="number" step="0.00000001" name="gps_latitude" value="{{ $selectedFarmer->gps_latitude }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-600">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">GPS Longitude</label>
                                <input type="number" step="0.00000001" name="gps_longitude" value="{{ $selectedFarmer->gps_longitude }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-600">
                            </div>
                        </div>

                        <!-- 3. FARM INFORMATION -->
                        <h4 class="text-lg font-bold text-emerald-600 mb-4 mt-6">3. Farm Information</h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-6">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Farmer Type</label>
                                <select name="farmer_type" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-600">
                                    <option value="">Select</option>
                                    <option value="owner" @selected($selectedFarmer->farmer_type === 'owner')>Owner</option>
                                    <option value="tenant" @selected($selectedFarmer->farmer_type === 'tenant')>Tenant</option>
                                    <option value="farm_worker" @selected($selectedFarmer->farmer_type === 'farm_worker')>Farm Worker</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Years in Farming</label>
                                <input type="number" name="years_in_farming" min="0" max="80" value="{{ $selectedFarmer->years_in_farming }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-600">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Primary Occupation</label>
                                <input type="text" name="primary_occupation" value="{{ $selectedFarmer->primary_occupation }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-600">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Secondary Occupation</label>
                                <input type="text" name="secondary_occupation" value="{{ $selectedFarmer->secondary_occupation }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-600">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Farm Location</label>
                                <input type="text" name="farm_location" value="{{ $selectedFarmer->farm_location }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-600">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Farm Size (hectares)</label>
                                <input type="number" step="0.01" name="farm_size_hectares" value="{{ $selectedFarmer->farm_size_hectares }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-600">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Land Ownership Type</label>
                                <select name="land_ownership_type" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-600">
                                    <option value="">Select</option>
                                    <option value="owned" @selected($selectedFarmer->land_ownership_type === 'owned')>Owned</option>
                                    <option value="leased" @selected($selectedFarmer->land_ownership_type === 'leased')>Leased</option>
                                    <option value="shared" @selected($selectedFarmer->land_ownership_type === 'shared')>Shared</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Number of Parcels</label>
                                <input type="number" name="number_of_parcels" min="0" value="{{ $selectedFarmer->number_of_parcels }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-600">
                            </div>
                            <div class="col-span-1 md:col-span-2 lg:col-span-3">
                                <label class="inline-flex items-center">
                                    <input type="checkbox" name="is_association_member" value="1" @checked($selectedFarmer->is_association_member) class="rounded border-gray-300 focus:ring-emerald-600">
                                    <span class="ml-2 text-sm font-semibold text-gray-700">Association Member</span>
                                </label>
                            </div>
                            <div class="col-span-1 md:col-span-2 lg:col-span-3">
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Association Name</label>
                                <input type="text" name="association_name" value="{{ $selectedFarmer->association_name }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-600">
                            </div>
                        </div>

                        <!-- 4. PRODUCTION INFORMATION -->
                        <h4 class="text-lg font-bold text-emerald-600 mb-4 mt-6">4. Production Information</h4>
                        <div class="grid grid-cols-1 gap-4 mb-6">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Crop Types</label>
                                <textarea name="crop_types" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-600">{{ $selectedFarmer->crop_types }}</textarea>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Crop Area per Type</label>
                                <textarea name="crop_area_per_type" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-600">{{ $selectedFarmer->crop_area_per_type }}</textarea>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Cropping Season</label>
                                <select name="cropping_season" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-600">
                                    <option value="">Select</option>
                                    <option value="wet" @selected($selectedFarmer->cropping_season === 'wet')>Wet</option>
                                    <option value="dry" @selected($selectedFarmer->cropping_season === 'dry')>Dry</option>
                                    <option value="wet_dry" @selected($selectedFarmer->cropping_season === 'wet_dry')>Wet/Dry</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Yield per Harvest</label>
                                <input type="text" name="yield_per_harvest" value="{{ $selectedFarmer->yield_per_harvest }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-600">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Livestock Types</label>
                                <textarea name="livestock_types" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-600">{{ $selectedFarmer->livestock_types }}</textarea>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Livestock Count</label>
                                <input type="number" name="livestock_count" min="0" value="{{ $selectedFarmer->livestock_count }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-600">
                            </div>
                        </div>

                        <!-- 5. FINANCIAL INFORMATION -->
                        <h4 class="text-lg font-bold text-emerald-600 mb-4 mt-6">5. Financial Information</h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Average Monthly Income</label>
                                <input type="number" step="0.01" name="average_monthly_income" value="{{ $selectedFarmer->average_monthly_income }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-600">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Average Annual Income</label>
                                <input type="number" step="0.01" name="average_annual_income" value="{{ $selectedFarmer->average_annual_income }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-600">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Income Source</label>
                                <select name="income_source" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-600">
                                    <option value="">Select</option>
                                    <option value="farm" @selected($selectedFarmer->income_source === 'farm')>Farm</option>
                                    <option value="non_farm" @selected($selectedFarmer->income_source === 'non_farm')>Non-Farm</option>
                                    <option value="both" @selected($selectedFarmer->income_source === 'both')>Both</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Insurance Coverage</label>
                                <input type="text" name="insurance_coverage" value="{{ $selectedFarmer->insurance_coverage }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-600">
                            </div>
                            <div class="col-span-1 md:col-span-2">
                                <label class="inline-flex items-center">
                                    <input type="checkbox" name="has_credit_access" value="1" @checked($selectedFarmer->has_credit_access) class="rounded border-gray-300 focus:ring-emerald-600">
                                    <span class="ml-2 text-sm font-semibold text-gray-700">Access to Credit/Loans</span>
                                </label>
                            </div>
                        </div>

                        <!-- 6. GOVERNMENT PROGRAMS -->
                        <h4 class="text-lg font-bold text-emerald-600 mb-4 mt-6">6. Government Programs</h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                            <div>
                                <label class="inline-flex items-center">
                                    <input type="checkbox" name="is_rsbsa_registered" value="1" @checked($selectedFarmer->is_rsbsa_registered) class="rounded border-gray-300 focus:ring-emerald-600">
                                    <span class="ml-2 text-sm font-semibold text-gray-700">RSBSA Registered</span>
                                </label>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Program Registration Date</label>
                                <input type="date" name="program_registration_date" value="{{ optional($selectedFarmer->program_registration_date)->format('Y-m-d') }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-600">
                            </div>
                            <div class="col-span-1 md:col-span-2">
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Programs Availed</label>
                                <textarea name="programs_availed" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-600">{{ $selectedFarmer->programs_availed }}</textarea>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex gap-3 justify-end mt-8 pt-6 border-t border-gray-200">
                            <button type="button" onclick="closeEditModal()" class="px-6 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition font-medium">
                                <i class="fas fa-times mr-2"></i>Cancel
                            </button>
                            <button type="submit" class="px-6 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 transition font-medium">
                                <i class="fas fa-save mr-2"></i>Save Changes
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    @elseif(isset($selectedFarmerId) && $selectedFarmerId)
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
            <i class="fas fa-exclamation-circle mr-2"></i> Farmer not found.
        </div>
    @else
        <div class="bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded text-center py-8">
            <i class="fas fa-hand-point-up mr-2 text-2xl"></i>
            <p class="mt-2 font-medium">Select a farmer from the dropdown above to view their detailed information.</p>
        </div>
    @endif
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
    // Chart data from Laravel
    const farmersByType = @json($farmersByType ?? []);
    const farmersByStatus = @json($farmersByStatus ?? []);
    const farmSizeRanges = @json($farmSizeRanges ?? []);
    const incomeRanges = @json($incomeRanges ?? []);
    const farmersByLocation = @json($farmersByLocation ?? []);
    const cropsCount = {{ $totalCrops ?? 0 }};
    const livestockCount = {{ $totalLivestock ?? 0 }};

    // Color palette
    const colors = {
        primary: '#2ecc71',
        secondary: '#27ae60',
        accent1: '#3498db',
        accent2: '#e74c3c',
        accent3: '#f39c12',
        accent4: '#9b59b6',
        accent5: '#1abc9c',
    };

    // Farmers by Type (Pie Chart)
    if (document.getElementById('farmerTypeChart')) {
        const typeLabels = farmersByType.map(t => t.farmer_type ? t.farmer_type.toUpperCase() : 'Unknown');
        const typeCounts = farmersByType.map(t => t.count);

        new Chart(document.getElementById('farmerTypeChart'), {
            type: 'pie',
            data: {
                labels: typeLabels,
                datasets: [{
                    data: typeCounts,
                    backgroundColor: [colors.primary, colors.accent1, colors.accent3],
                    borderColor: '#fff',
                    borderWidth: 2,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: {
                    legend: { position: 'bottom' }
                }
            }
        });
    }

    // Farmers by Status (Doughnut Chart)
    if (document.getElementById('farmerStatusChart')) {
        const statusLabels = farmersByStatus.map(s => s.profile_status ? s.profile_status.toUpperCase() : 'Unknown');
        const statusCounts = farmersByStatus.map(s => s.count);

        new Chart(document.getElementById('farmerStatusChart'), {
            type: 'doughnut',
            data: {
                labels: statusLabels,
                datasets: [{
                    data: statusCounts,
                    backgroundColor: [colors.primary, colors.accent2, colors.accent4],
                    borderColor: '#fff',
                    borderWidth: 2,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: {
                    legend: { position: 'bottom' }
                }
            }
        });
    }

    // Farm Size Distribution (Bar Chart)
    if (document.getElementById('farmSizeChart')) {
        const sizeLabels = Object.keys(farmSizeRanges);
        const sizeCounts = Object.values(farmSizeRanges);

        new Chart(document.getElementById('farmSizeChart'), {
            type: 'bar',
            data: {
                labels: sizeLabels,
                datasets: [{
                    label: 'Number of Farmers',
                    data: sizeCounts,
                    backgroundColor: colors.primary,
                    borderColor: colors.secondary,
                    borderWidth: 2,
                }]
            },
            options: {
                indexAxis: 'y',
                responsive: true,
                maintainAspectRatio: true,
                plugins: { legend: { display: false } },
                scales: {
                    x: { beginAtZero: true }
                }
            }
        });
    }

    // Income Distribution (Bar Chart)
    if (document.getElementById('incomeChart')) {
        const incomeLabels = Object.keys(incomeRanges);
        const incomeCounts = Object.values(incomeRanges);

        new Chart(document.getElementById('incomeChart'), {
            type: 'bar',
            data: {
                labels: incomeLabels,
                datasets: [{
                    label: 'Number of Farmers',
                    data: incomeCounts,
                    backgroundColor: colors.accent3,
                    borderColor: colors.accent2,
                    borderWidth: 2,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: { legend: { display: false } },
                scales: {
                    y: { beginAtZero: true }
                }
            }
        });
    }

    // Top Locations (Horizontal Bar)
    if (document.getElementById('locationChart')) {
        const locLabels = farmersByLocation.map(l => l.municipality_city || 'Unknown');
        const locCounts = farmersByLocation.map(l => l.count);

        new Chart(document.getElementById('locationChart'), {
            type: 'bar',
            data: {
                labels: locLabels,
                datasets: [{
                    label: 'Farmers',
                    data: locCounts,
                    backgroundColor: colors.accent1,
                    borderColor: colors.accent4,
                    borderWidth: 2,
                }]
            },
            options: {
                indexAxis: 'y',
                responsive: true,
                maintainAspectRatio: true,
                plugins: { legend: { display: false } },
                scales: {
                    x: { beginAtZero: true }
                }
            }
        });
    }

    // Crops & Livestock Summary (Bar Chart)
    if (document.getElementById('cropsLivestockChart')) {
        new Chart(document.getElementById('cropsLivestockChart'), {
            type: 'bar',
            data: {
                labels: ['Crops', 'Livestock'],
                datasets: [{
                    label: 'Total Count',
                    data: [cropsCount, livestockCount],
                    backgroundColor: [colors.accent5, colors.accent3],
                    borderColor: [colors.secondary, colors.accent2],
                    borderWidth: 2,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: { legend: { display: false } },
                scales: {
                    y: { beginAtZero: true }
                }
            }
        });
    }

    // Export and button handlers
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

    // Delete confirmation
    function confirmDelete(farmerId, farmerName) {
        if (confirm(`Are you sure you want to delete "${farmerName}"? This action cannot be undone.`)) {
            deleteFarmer(farmerId);
        }
    }

    function deleteFarmer(farmerId) {
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = '{{ route('admin.farmers.destroy', '') }}/' + farmerId;
        form.innerHTML = `
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="_method" value="DELETE">
        `;
        document.body.appendChild(form);
        form.submit();
    }

    // Load farmer details via AJAX
    function loadFarmerDetails() {
        const farmerId = document.getElementById('farmer_id_reports').value;
        if (!farmerId) {
            clearFarmerSelection();
            return;
        }

        if (typeof loadAdminPage === 'function') {
            loadAdminPage('reports-analytics', '{{ route('admin.reports-analytics') }}?farmer_id=' + farmerId);
        } else {
            window.location.href = '{{ route('admin.reports-analytics') }}?farmer_id=' + farmerId;
        }
    }

    // Clear farmer selection
    function clearFarmerSelection() {
        document.getElementById('farmer_id_reports').value = '';
        if (typeof loadAdminPage === 'function') {
            loadAdminPage('reports-analytics', '{{ route('admin.reports-analytics') }}');
        } else {
            window.location.href = '{{ route('admin.reports-analytics') }}';
        }
    }

    // Edit Modal Functions
    function openEditModal() {
        document.getElementById('editModal').style.display = 'flex';
    }

    function closeEditModal() {
        document.getElementById('editModal').style.display = 'none';
    }

    // Close modal when clicking outside
    document.getElementById('editModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeEditModal();
        }
    });

    // Handle form submission
    document.getElementById('editFarmerForm').addEventListener('submit', function(e) {
        e.preventDefault();
        const form = this;

        // Submit the form
        fetch(form.action, {
            method: form.method,
            body: new FormData(form),
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => {
            if (response.ok) {
                // Reload the current page to refresh the data
                if (typeof loadAdminPage === 'function') {
                    const urlParams = new URLSearchParams(window.location.search);
                    const farmerId = urlParams.get('farmer_id');
                    loadAdminPage('reports-analytics', '{{ route('admin.reports-analytics') }}?farmer_id=' + farmerId);
                } else {
                    location.reload();
                }
                closeEditModal();
            } else {
                alert('Error saving changes. Please try again.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while saving changes.');
        });
    });
</script>

