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
                            <th class="px-4 py-2 text-left text-xs font-semibold text-gray-700">Actions</th>
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
                                <td class="px-4 py-3 text-sm space-x-2 flex gap-2">
                                    <button onclick="loadAdminPage('farmer-detail', '{{ route('admin.farmers.show', $farmer->id) }}')" class="px-3 py-1 bg-blue-100 text-blue-700 rounded-md hover:bg-blue-200 transition font-semibold text-xs" title="View Details"><i class="fas fa-eye mr-1"></i>View</button>
                                    <button onclick="verifyFarmer({{ $farmer->id }})" class="px-3 py-1 bg-emerald-100 text-emerald-700 rounded-md hover:bg-emerald-200 transition font-semibold text-xs" title="Verify Farmer"><i class="fas fa-check mr-1"></i>Verify</button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-4 py-8 text-center text-gray-500"><i class="fas fa-inbox mr-2"></i>No farmer registrations yet.</td>
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
</div>
