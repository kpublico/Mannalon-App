<div class="space-y-6">
    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4">
        <button onclick="loadAdminPage('farmers', '{{ route('admin.farmers.index') }}')" class="bg-gradient-to-br from-emerald-50 to-emerald-100 border-2 border-emerald-600 rounded-xl p-5 text-left hover:shadow-lg transition transform hover:scale-105">
            <p class="text-sm text-emerald-700 font-semibold uppercase tracking-wide">Farmer Information</p>
            <p class="text-4xl font-extrabold text-emerald-700 mt-2">{{ $totalFarmers ?? 0 }}</p>
            <div class="flex gap-3 mt-3 text-xs">
                <span class="px-2 py-1 bg-green-200 text-green-800 rounded-full font-semibold"><i class="fas fa-check-circle mr-1"></i>{{ $activeFarmers ?? 0 }} Active</span>
                @if(($inactiveFarmers ?? 0) > 0)
                    <span class="px-2 py-1 bg-red-200 text-red-800 rounded-full font-semibold"><i class="fas fa-pause-circle mr-1"></i>{{ $inactiveFarmers ?? 0 }} Inactive</span>
                @endif
            </div>
        </button>
        <button onclick="loadAdminPage('announcements', '{{ route('admin.announcements.index') }}')" class="bg-white border border-emerald-200 rounded-xl p-5 text-left hover:shadow-md transition">
            <p class="text-sm text-gray-500">Announcement Portal</p>
            <p class="text-3xl font-extrabold text-emerald-700 mt-1">{{ $totalAnnouncements ?? 0 }}</p>
            <p class="text-xs text-gray-500 mt-1"><i class="fas fa-bullhorn mr-1"></i>Published posts</p>
        </button>
        <button onclick="loadAdminPage('guides', '{{ route('admin.guides.index') }}')" class="bg-white border border-emerald-200 rounded-xl p-5 text-left hover:shadow-md transition">
            <p class="text-sm text-gray-500">Farming Guides</p>
            <p class="text-3xl font-extrabold text-emerald-700 mt-1">{{ $totalGuides ?? 0 }}</p>
            <p class="text-xs text-gray-500 mt-1"><i class="fas fa-book mr-1"></i>Guide entries</p>
        </button>
        <button onclick="loadAdminPage('market-prices', '{{ route('admin.market-prices.index') }}')" class="bg-white border border-emerald-200 rounded-xl p-5 text-left hover:shadow-md transition">
            <p class="text-sm text-gray-500">Commodity Tracker</p>
            <p class="text-3xl font-extrabold text-emerald-700 mt-1">{{ $totalCommodityRows ?? 0 }}</p>
            <p class="text-xs text-gray-500 mt-1"><i class="fas fa-tags mr-1"></i>Price records</p>
        </button>
    </div>

    <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">
        <section class="xl:col-span-2 bg-white border border-emerald-200 rounded-xl shadow-sm p-5">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-bold text-gray-900">Recent Farmer Registrations</h3>
                <a href="javascript:void(0)" onclick="loadAdminPage('farmers', '{{ route('admin.farmers.index') }}')" class="text-sm text-emerald-700 font-semibold hover:underline">View All</a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="px-4 py-2 text-left text-xs font-semibold text-gray-700">Name</th>
                            <th class="px-4 py-2 text-left text-xs font-semibold text-gray-700">Email</th>
                            <th class="px-4 py-2 text-left text-xs font-semibold text-gray-700">Contact</th>
                            <th class="px-4 py-2 text-left text-xs font-semibold text-gray-700">Status</th>
                            <th class="px-4 py-2 text-left text-xs font-semibold text-gray-700">Joined</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse(($recentFarmers ?? collect()) as $farmer)
                            <tr class="hover:bg-emerald-50">
                                <td class="px-4 py-3 text-sm font-semibold text-gray-900">{{ $farmer->name }}</td>
                                <td class="px-4 py-3 text-sm text-gray-600">{{ $farmer->email }}</td>
                                <td class="px-4 py-3 text-sm text-gray-600">{{ $farmer->phone ?? 'N/A' }}</td>
                                <td class="px-4 py-3 text-sm">
                                    @if($farmer->status === 'active')
                                        <span class="px-2 py-1 bg-green-100 text-green-800 text-xs font-semibold rounded-full"><i class="fas fa-check-circle mr-1"></i>Active</span>
                                    @else
                                        <span class="px-2 py-1 bg-red-100 text-red-800 text-xs font-semibold rounded-full"><i class="fas fa-ban mr-1"></i>Inactive</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-sm text-gray-500">{{ $farmer->created_at?->format('M d, Y') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-4 py-8 text-center text-gray-500"><i class="fas fa-inbox mr-2"></i>No farmer registrations yet.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>

        <section class="bg-white border border-emerald-200 rounded-xl shadow-sm p-5">
            <h3 class="text-lg font-bold text-gray-900 mb-4">System Overview</h3>
            <div class="space-y-3 text-sm">
                <div class="flex items-center justify-between"><span class="text-gray-600">Total Users</span><span class="font-bold text-gray-900">{{ $totalUsers ?? 0 }}</span></div>
                <div class="flex items-center justify-between"><span class="text-gray-600">Admin Users</span><span class="font-bold text-gray-900">{{ $totalAdmins ?? 0 }}</span></div>
                <hr class="my-2">
                <div class="flex items-center justify-between"><span class="text-gray-600">Farmers (Active)</span><span class="font-bold text-green-700">{{ $activeFarmers ?? 0 }}</span></div>
                @if(($inactiveFarmers ?? 0) > 0)
                    <div class="flex items-center justify-between"><span class="text-gray-600">Farmers (Inactive)</span><span class="font-bold text-red-700">{{ $inactiveFarmers ?? 0 }}</span></div>
                @endif
                <hr class="my-2">
                <div class="flex items-center justify-between"><span class="text-gray-600">Crop Records</span><span class="font-bold text-gray-900">{{ $totalCrops ?? 0 }}</span></div>
                <div class="flex items-center justify-between"><span class="text-gray-600">Livestock Records</span><span class="font-bold text-gray-900">{{ $totalLivestock ?? 0 }}</span></div>
                <div class="flex items-center justify-between"><span class="text-gray-600">Active Users</span><span class="font-bold text-gray-900">{{ $activeUsers ?? 0 }}</span></div>
            </div>
        </section>
    </div>

    <div class="grid grid-cols-1 xl:grid-cols-2 gap-6">
        <section class="bg-white border border-emerald-200 rounded-xl shadow-sm p-5">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-bold text-gray-900">Recent Announcements</h3>
                <a href="javascript:void(0)" onclick="loadAdminPage('announcements', '{{ route('admin.announcements.index') }}')" class="text-sm text-emerald-700 font-semibold hover:underline">Open module</a>
            </div>
            <ul class="space-y-3">
                @forelse(($recentAnnouncements ?? collect()) as $item)
                    <li class="border border-gray-200 rounded-lg p-3">
                        <p class="font-semibold text-gray-900">{{ $item->title }}</p>
                        <p class="text-xs text-gray-500 mt-1">{{ $item->category }} | {{ $item->created_at?->format('M d, Y h:i A') }}</p>
                    </li>
                @empty
                    <li class="text-sm text-gray-500">No announcements yet.</li>
                @endforelse
            </ul>
        </section>

        <section class="bg-white border border-emerald-200 rounded-xl shadow-sm p-5">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-bold text-gray-900">Recent Commodity Updates</h3>
                <a href="javascript:void(0)" onclick="loadAdminPage('market-prices', '{{ route('admin.market-prices.index') }}')" class="text-sm text-emerald-700 font-semibold hover:underline">Open module</a>
            </div>
            <ul class="space-y-3">
                @forelse(($recentCommodityPrices ?? collect()) as $row)
                    <li class="border border-gray-200 rounded-lg p-3 flex items-center justify-between">
                        <div>
                            <p class="font-semibold text-gray-900">{{ $row->commodity }}</p>
                            <p class="text-xs text-gray-500">{{ $row->date_updated?->format('M d, Y') }}</p>
                        </div>
                        <span class="font-bold text-emerald-700">PHP {{ number_format((float) $row->price_per_kilo, 2) }}</span>
                    </li>
                @empty
                    <li class="text-sm text-gray-500">No commodity price records yet.</li>
                @endforelse
            </ul>
        </section>
    </div>

    <!-- Farmer Selector & Details Section -->
    <div class="bg-white rounded-xl shadow-md border border-emerald-200 p-6">
        <div class="space-y-4">
            <label class="block text-lg font-semibold text-gray-700">
                <i class="fas fa-users mr-2 text-emerald-600"></i>View Specific Farmer Details
            </label>

            <div class="flex gap-3 items-end flex-wrap">
                <div class="flex-1 min-w-xs">
                    <select id="dashboard_farmer_id" onchange="loadDashboardFarmer();" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-600 focus:border-transparent font-medium">
                        <option value="">-- Choose a Farmer --</option>
                        @if(isset($allFarmers))
                            @foreach($allFarmers as $f)
                                <option value="{{ $f->id }}">
                                    #{{ $f->id }} - {{ $f->first_name }} {{ $f->last_name }} ({{ $f->municipality_city ?? 'N/A' }})
                                </option>
                            @endforeach
                        @endif
                    </select>
                </div>
            </div>

            @if(isset($selectedDashboardFarmer) && $selectedDashboardFarmer)
                <!-- Selected Farmer Details -->
                <div class="mt-6 p-4 bg-emerald-50 border border-emerald-200 rounded-lg">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 text-sm">
                        <div>
                            <p class="text-gray-600 font-semibold">Full Name</p>
                            <p class="text-gray-900 font-medium mt-1">{{ $selectedDashboardFarmer->first_name }} {{ $selectedDashboardFarmer->last_name }}</p>
                        </div>
                        <div>
                            <p class="text-gray-600 font-semibold">Email</p>
                            <p class="text-gray-900 font-medium mt-1">{{ $selectedDashboardFarmer->email ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <p class="text-gray-600 font-semibold">Phone</p>
                            <p class="text-gray-900 font-medium mt-1">{{ $selectedDashboardFarmer->phone ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <p class="text-gray-600 font-semibold">Location</p>
                            <p class="text-gray-900 font-medium mt-1">{{ $selectedDashboardFarmer->municipality_city ?? 'N/A' }}, {{ $selectedDashboardFarmer->province ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <p class="text-gray-600 font-semibold">Farmer Type</p>
                            <p class="text-gray-900 font-medium mt-1">{{ ucfirst(str_replace('_', ' ', $selectedDashboardFarmer->farmer_type ?? 'N/A')) }}</p>
                        </div>
                        <div>
                            <p class="text-gray-600 font-semibold">Farm Size</p>
                            <p class="text-gray-900 font-medium mt-1">{{ $selectedDashboardFarmer->farm_size_hectares ?? 'N/A' }} ha</p>
                        </div>
                        <div>
                            <p class="text-gray-600 font-semibold">Years Farming</p>
                            <p class="text-gray-900 font-medium mt-1">{{ $selectedDashboardFarmer->years_in_farming ?? 'N/A' }} years</p>
                        </div>
                        <div>
                            <p class="text-gray-600 font-semibold">Status</p>
                            <p class="mt-1">
                                @if($selectedDashboardFarmer->profile_status === 'active')
                                    <span class="px-3 py-1 bg-emerald-100 text-emerald-700 rounded-full text-xs font-medium"><i class="fas fa-check-circle"></i> Active</span>
                                @else
                                    <span class="px-3 py-1 bg-red-100 text-red-700 rounded-full text-xs font-medium"><i class="fas fa-times-circle"></i> Inactive</span>
                                @endif
                            </p>
                        </div>
                    </div>

                    <!-- Quick Actions -->
                    <div class="flex gap-3 mt-4 pt-4 border-t border-emerald-200">
                        <button type="button" onclick="openDashboardEditModal({{ $selectedDashboardFarmer->id }})" class="px-4 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 transition font-medium text-sm">
                            <i class="fas fa-edit mr-2"></i>Edit
                        </button>
                        <button type="button" onclick="confirmDelete({{ $selectedDashboardFarmer->id }}, '{{ $selectedDashboardFarmer->first_name }} {{ $selectedDashboardFarmer->last_name }}')" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition font-medium text-sm">
                            <i class="fas fa-trash mr-2"></i>Delete
                        </button>
                        <button type="button" onclick="loadAdminPage('farmer-info-dashboard', '{{ route('admin.farmer-info-dashboard') }}?farmer_id={{ $selectedDashboardFarmer->id }}')" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition font-medium text-sm">
                            <i class="fas fa-eye mr-2"></i>View Full Details
                        </button>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

<script>
    function loadDashboardFarmer() {
        const farmerId = document.getElementById('dashboard_farmer_id').value;
        if (farmerId) {
            if (typeof loadAdminPage === 'function') {
                loadAdminPage('dashboard', '{{ route('admin.dashboard') }}?selected_farmer=' + farmerId);
            } else {
                window.location.href = '{{ route('admin.dashboard') }}?selected_farmer=' + farmerId;
            }
        }
    }

    function openDashboardEditModal(farmerId) {
        // Redirect to edit page
        window.location.href = '/admin/farmers/' + farmerId + '/edit';
    }
</script>
