<main>
<div class="space-y-6">
    <?php if(session('success')): ?>
        <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3 rounded-lg">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div class="bg-white border border-emerald-200 rounded-xl p-5 shadow-sm">
            <p class="text-sm text-gray-500">Registered Farmers</p>
            <p class="text-3xl font-extrabold text-emerald-700 mt-1"><?php echo e($totalFarmers); ?></p>
        </div>
        <div class="bg-white border border-emerald-200 rounded-xl p-5 shadow-sm">
            <p class="text-sm text-gray-500">Total Land Size</p>
            <p class="text-3xl font-extrabold text-emerald-700 mt-1"><?php echo e(number_format((float) $totalLandArea, 2)); ?> ha</p>
        </div>
        <div class="bg-white border border-emerald-200 rounded-xl p-5 shadow-sm">
            <p class="text-sm text-gray-500">Pending Ayuda</p>
            <p class="text-3xl font-extrabold text-emerald-700 mt-1"><?php echo e($pendingAyuda); ?></p>
        </div>
    </div>

    <section class="grid grid-cols-1 xl:grid-cols-2 gap-6">
        <div class="bg-white border border-emerald-200 rounded-xl p-5 shadow-sm">
            <h3 class="text-xl font-bold text-emerald-800">Input Farmer Information</h3>
            <p class="text-sm text-gray-500 mt-1">No information yet by default. Admin enters the records.</p>
            <form method="POST" action="<?php echo e(route('admin.land.farmers.store')); ?>" class="mt-4 space-y-3">
                <?php echo csrf_field(); ?>
                <div>
                    <label class="text-sm font-semibold text-gray-700">Farmer Name</label>
                    <input type="text" name="name" class="mt-1 w-full px-3 py-2 border border-gray-300 rounded-lg" required>
                </div>
                <div>
                    <label class="text-sm font-semibold text-gray-700">Farm Location</label>
                    <input type="text" name="farm_location" class="mt-1 w-full px-3 py-2 border border-gray-300 rounded-lg" placeholder="Barangay, Municipality">
                </div>
                <div>
                    <label class="text-sm font-semibold text-gray-700">Phone</label>
                    <input type="text" name="phone" class="mt-1 w-full px-3 py-2 border border-gray-300 rounded-lg" placeholder="Optional">
                </div>
                <button type="submit" class="px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white rounded-lg font-semibold">Add Farmer</button>
            </form>
        </div>

        <div class="bg-white border border-emerald-200 rounded-xl p-5 shadow-sm">
            <h3 class="text-xl font-bold text-emerald-800">Input Land Detail</h3>
            <p class="text-sm text-gray-500 mt-1">Admin enters latitude, longitude, and farm size for mapping.</p>
            <form method="POST" action="<?php echo e(route('admin.land.farm-details.store')); ?>" class="mt-4 space-y-3">
                <?php echo csrf_field(); ?>
                <div>
                    <label class="text-sm font-semibold text-gray-700">Farmer</label>
                    <select name="farmer_id" class="mt-1 w-full px-3 py-2 border border-gray-300 rounded-lg" required>
                        <option value="">Select Farmer</option>
                        <?php $__currentLoopData = $farmers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $farmer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($farmer->id); ?>"><?php echo e($farmer->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                    <div>
                        <label class="text-sm font-semibold text-gray-700">Latitude</label>
                        <input type="number" step="0.0000001" name="latitude" class="mt-1 w-full px-3 py-2 border border-gray-300 rounded-lg" placeholder="17.6132000">
                    </div>
                    <div>
                        <label class="text-sm font-semibold text-gray-700">Longitude</label>
                        <input type="number" step="0.0000001" name="longitude" class="mt-1 w-full px-3 py-2 border border-gray-300 rounded-lg" placeholder="121.7269000">
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                    <div>
                        <label class="text-sm font-semibold text-gray-700">Farm Size (ha)</label>
                        <input type="number" step="0.01" min="0" name="farm_size" class="mt-1 w-full px-3 py-2 border border-gray-300 rounded-lg" required>
                    </div>
                    <div>
                        <label class="text-sm font-semibold text-gray-700">Land Type</label>
                        <input type="text" name="land_type" class="mt-1 w-full px-3 py-2 border border-gray-300 rounded-lg" placeholder="Rice field, Corn field, etc.">
                    </div>
                </div>
                <div>
                    <label class="text-sm font-semibold text-gray-700">Notes</label>
                    <textarea name="notes" rows="2" class="mt-1 w-full px-3 py-2 border border-gray-300 rounded-lg"></textarea>
                </div>
                <button type="submit" class="px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white rounded-lg font-semibold">Save Land Detail</button>
            </form>
        </div>
    </section>

    <section class="bg-white border border-emerald-200 rounded-xl p-5 shadow-sm">
        <h3 class="text-xl font-bold text-emerald-800">Admin Profile</h3>
        <p class="text-sm text-gray-500 mt-1">Update administrator credentials.</p>
        <form method="POST" action="<?php echo e(route('admin.land.profile.update')); ?>" class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-4">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>
            <div>
                <label class="text-sm font-semibold text-gray-700">Full Name</label>
                <input type="text" name="name" value="<?php echo e(old('name', $admin?->name)); ?>" class="mt-1 w-full px-3 py-2 border border-gray-300 rounded-lg" required>
            </div>
            <div>
                <label class="text-sm font-semibold text-gray-700">Email</label>
                <input type="email" name="email" value="<?php echo e(old('email', $admin?->email)); ?>" class="mt-1 w-full px-3 py-2 border border-gray-300 rounded-lg" required>
            </div>
            <div>
                <label class="text-sm font-semibold text-gray-700">Current Password</label>
                <input type="password" name="current_password" class="mt-1 w-full px-3 py-2 border border-gray-300 rounded-lg" placeholder="Required only if changing password">
            </div>
            <div>
                <label class="text-sm font-semibold text-gray-700">New Password</label>
                <input type="password" name="new_password" class="mt-1 w-full px-3 py-2 border border-gray-300 rounded-lg" placeholder="Optional">
            </div>
            <div class="md:col-span-2">
                <label class="text-sm font-semibold text-gray-700">Confirm New Password</label>
                <input type="password" name="new_password_confirmation" class="mt-1 w-full px-3 py-2 border border-gray-300 rounded-lg" placeholder="Optional">
            </div>
            <div class="md:col-span-2">
                <button type="submit" class="px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white rounded-lg font-semibold">Save Profile</button>
            </div>
        </form>
    </section>

    <section class="bg-white border border-emerald-200 rounded-xl p-5 shadow-sm">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3 mb-4">
            <div>
                <h3 class="text-xl font-bold text-emerald-800">Farmer/Farm Directory</h3>
                <p class="text-sm text-gray-500">Searchable list from the farmers table with linked land size.</p>
            </div>
            <form method="GET" action="<?php echo e(route('admin.land.index')); ?>" class="flex gap-2">
                <input type="text" name="search" value="<?php echo e($search); ?>" placeholder="Search farmer or location" class="px-3 py-2 border border-gray-300 rounded-lg w-64">
                <button type="submit" class="px-4 py-2 bg-emerald-600 text-white rounded-lg">Search</button>
            </form>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-emerald-50">
                    <tr>
                        <th class="text-left px-4 py-3 font-semibold text-emerald-800">Name</th>
                        <th class="text-left px-4 py-3 font-semibold text-emerald-800">Farm Location</th>
                        <th class="text-left px-4 py-3 font-semibold text-emerald-800">Land Size (ha)</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <?php $__empty_1 = true; $__currentLoopData = $farmers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $farmer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td class="px-4 py-3"><?php echo e($farmer->name); ?></td>
                            <td class="px-4 py-3"><?php echo e($farmer->farm_location ?? 'N/A'); ?></td>
                            <td class="px-4 py-3"><?php echo e(number_format((float) optional($farmer->farmDetail)->farm_size, 2)); ?></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="3" class="px-4 py-6 text-center text-gray-500">No information yet. Admin will enter the information.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </section>

    <section class="bg-white border border-emerald-200 rounded-xl p-5 shadow-sm">
        <h3 class="text-xl font-bold text-emerald-800">Interactive Land Map</h3>
        <p class="text-sm text-gray-500 mt-1">Geopoints from farm_details (latitude/longitude) with farm size details.</p>
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" crossorigin="" />
        <div id="landMap" class="mt-4 w-full h-96 rounded-lg border border-gray-200"></div>
        <p class="text-xs text-gray-500 mt-2">If there is no information yet, map markers will be empty until admin enters land details.</p>
    </section>

    <section class="bg-white border border-emerald-200 rounded-xl p-5 shadow-sm">
        <h3 class="text-xl font-bold text-emerald-800">Service Access Panel</h3>
        <p class="text-sm text-gray-500 mt-1">Monitoring which farmers accessed agricultural services.</p>
        <div class="overflow-x-auto mt-4">
            <table class="w-full text-sm">
                <thead class="bg-emerald-50">
                    <tr>
                        <th class="text-left px-4 py-3 font-semibold text-emerald-800">Farmer</th>
                        <th class="text-left px-4 py-3 font-semibold text-emerald-800">Service</th>
                        <th class="text-left px-4 py-3 font-semibold text-emerald-800">Access Count</th>
                        <th class="text-left px-4 py-3 font-semibold text-emerald-800">Last Access</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <?php $__empty_1 = true; $__currentLoopData = $serviceAccessLogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $log): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td class="px-4 py-3"><?php echo e(optional($log->farmer)->name ?? 'Unknown'); ?></td>
                            <td class="px-4 py-3"><?php echo e($log->service_name); ?></td>
                            <td class="px-4 py-3"><?php echo e($log->access_count); ?></td>
                            <td class="px-4 py-3"><?php echo e($log->last_accessed_at?->format('M d, Y h:i A') ?? 'N/A'); ?></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="4" class="px-4 py-6 text-center text-gray-500">No service access logs yet.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </section>

    <section class="grid grid-cols-1 xl:grid-cols-2 gap-6">
        <div class="bg-white border border-emerald-200 rounded-xl p-5 shadow-sm">
            <h3 class="text-xl font-bold text-emerald-800">Beneficiary Entry System</h3>
            <p class="text-sm text-gray-500 mt-1">Input beneficiaries to the beneficiaries table.</p>
            <form method="POST" action="<?php echo e(route('admin.land.beneficiaries.store')); ?>" class="mt-4 space-y-3">
                <?php echo csrf_field(); ?>
                <div>
                    <label class="text-sm font-semibold text-gray-700">Farmer</label>
                    <select name="farmer_id" class="mt-1 w-full px-3 py-2 border border-gray-300 rounded-lg" required>
                        <option value="">Select Farmer</option>
                        <?php $__currentLoopData = $farmers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $farmer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($farmer->id); ?>"><?php echo e($farmer->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                    <div>
                        <label class="text-sm font-semibold text-gray-700">Service Type</label>
                        <input type="text" name="service_type" placeholder="e.g. Ayuda" class="mt-1 w-full px-3 py-2 border border-gray-300 rounded-lg" required>
                    </div>
                    <div>
                        <label class="text-sm font-semibold text-gray-700">Program Name</label>
                        <input type="text" name="program_name" placeholder="Program title" class="mt-1 w-full px-3 py-2 border border-gray-300 rounded-lg">
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                    <div>
                        <label class="text-sm font-semibold text-gray-700">Aid Amount</label>
                        <input type="number" step="0.01" min="0" name="aid_amount" class="mt-1 w-full px-3 py-2 border border-gray-300 rounded-lg">
                    </div>
                    <div>
                        <label class="text-sm font-semibold text-gray-700">Status</label>
                        <select name="ayuda_status" class="mt-1 w-full px-3 py-2 border border-gray-300 rounded-lg" required>
                            <option value="pending">Pending</option>
                            <option value="claimed">Claimed</option>
                        </select>
                    </div>
                </div>
                <div>
                    <label class="text-sm font-semibold text-gray-700">Distributed Date</label>
                    <input type="date" name="distributed_at" class="mt-1 w-full px-3 py-2 border border-gray-300 rounded-lg">
                </div>
                <div>
                    <label class="text-sm font-semibold text-gray-700">Notes</label>
                    <textarea name="notes" rows="3" class="mt-1 w-full px-3 py-2 border border-gray-300 rounded-lg"></textarea>
                </div>
                <button type="submit" class="px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white rounded-lg font-semibold">Add Beneficiary</button>
            </form>
        </div>

        <div class="bg-white border border-emerald-200 rounded-xl p-5 shadow-sm">
            <h3 class="text-xl font-bold text-emerald-800">Recent Beneficiaries</h3>
            <p class="text-sm text-gray-500 mt-1">Quick update/delete controls.</p>
            <div class="mt-4 space-y-3 max-h-[560px] overflow-y-auto pr-1">
                <?php $__empty_1 = true; $__currentLoopData = $beneficiaries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $beneficiary): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div class="border border-gray-200 rounded-lg p-3">
                        <div class="flex items-start justify-between gap-3">
                            <div>
                                <p class="font-semibold text-gray-800"><?php echo e(optional($beneficiary->farmer)->name ?? 'Unknown Farmer'); ?></p>
                                <p class="text-xs text-gray-500"><?php echo e($beneficiary->service_type); ?> | <?php echo e($beneficiary->program_name ?? 'No program'); ?></p>
                                <p class="text-xs text-gray-500">Amount: <?php echo e($beneficiary->aid_amount !== null ? 'PHP ' . number_format((float) $beneficiary->aid_amount, 2) : 'N/A'); ?></p>
                            </div>
                            <span class="text-xs font-semibold px-2 py-1 rounded-full <?php echo e($beneficiary->ayuda_status === 'claimed' ? 'bg-emerald-100 text-emerald-800' : 'bg-amber-100 text-amber-800'); ?>"><?php echo e(ucfirst($beneficiary->ayuda_status)); ?></span>
                        </div>
                        <div class="mt-3 flex gap-2">
                            <form method="POST" action="<?php echo e(route('admin.land.beneficiaries.update', $beneficiary)); ?>" class="flex-1">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('PUT'); ?>
                                <input type="hidden" name="farmer_id" value="<?php echo e($beneficiary->farmer_id); ?>">
                                <input type="hidden" name="service_type" value="<?php echo e($beneficiary->service_type); ?>">
                                <input type="hidden" name="program_name" value="<?php echo e($beneficiary->program_name); ?>">
                                <input type="hidden" name="aid_amount" value="<?php echo e($beneficiary->aid_amount); ?>">
                                <input type="hidden" name="distributed_at" value="<?php echo e(optional($beneficiary->distributed_at)->format('Y-m-d')); ?>">
                                <input type="hidden" name="notes" value="<?php echo e($beneficiary->notes); ?>">
                                <input type="hidden" name="ayuda_status" value="<?php echo e($beneficiary->ayuda_status === 'claimed' ? 'pending' : 'claimed'); ?>">
                                <button type="submit" class="w-full px-3 py-2 bg-blue-600 hover:bg-blue-700 text-white text-xs font-semibold rounded">Toggle Status</button>
                            </form>
                            <form method="POST" action="<?php echo e(route('admin.land.beneficiaries.destroy', $beneficiary)); ?>" onsubmit="return confirm('Delete this beneficiary entry?')">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="px-3 py-2 bg-red-600 hover:bg-red-700 text-white text-xs font-semibold rounded">Delete</button>
                            </form>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <p class="text-sm text-gray-500">No beneficiaries yet.</p>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <section class="bg-white border border-emerald-200 rounded-xl p-5 shadow-sm">
        <h3 class="text-xl font-bold text-emerald-800">Ayuda Distribution List</h3>
        <p class="text-sm text-gray-500 mt-1">Filtered list for Ayuda with status toggle.</p>
        <div class="overflow-x-auto mt-4">
            <table class="w-full text-sm">
                <thead class="bg-emerald-50">
                    <tr>
                        <th class="text-left px-4 py-3 font-semibold text-emerald-800">Farmer</th>
                        <th class="text-left px-4 py-3 font-semibold text-emerald-800">Program</th>
                        <th class="text-left px-4 py-3 font-semibold text-emerald-800">Amount</th>
                        <th class="text-left px-4 py-3 font-semibold text-emerald-800">Status</th>
                        <th class="text-left px-4 py-3 font-semibold text-emerald-800">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <?php $__empty_1 = true; $__currentLoopData = $ayudaBeneficiaries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $entry): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td class="px-4 py-3"><?php echo e(optional($entry->farmer)->name ?? 'Unknown'); ?></td>
                            <td class="px-4 py-3"><?php echo e($entry->program_name ?? 'Ayuda Program'); ?></td>
                            <td class="px-4 py-3"><?php echo e($entry->aid_amount !== null ? 'PHP ' . number_format((float) $entry->aid_amount, 2) : 'N/A'); ?></td>
                            <td class="px-4 py-3">
                                <span class="text-xs font-semibold px-2 py-1 rounded-full <?php echo e($entry->ayuda_status === 'claimed' ? 'bg-emerald-100 text-emerald-800' : 'bg-amber-100 text-amber-800'); ?>"><?php echo e(ucfirst($entry->ayuda_status)); ?></span>
                            </td>
                            <td class="px-4 py-3">
                                <form method="POST" action="<?php echo e(route('admin.land.ayuda.toggle', $entry)); ?>">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('PATCH'); ?>
                                    <button type="submit" class="px-3 py-2 text-xs font-semibold rounded <?php echo e($entry->ayuda_status === 'claimed' ? 'bg-gray-200 text-gray-700' : 'bg-emerald-600 text-white hover:bg-emerald-700'); ?>">
                                        <?php echo e($entry->ayuda_status === 'claimed' ? 'Mark Pending' : 'Mark Claimed'); ?>

                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="5" class="px-4 py-6 text-center text-gray-500">No Ayuda records found. Add a beneficiary with service type "Ayuda".</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </section>
</div>

<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" crossorigin=""></script>
<script>
    <?php
        $mapPoints = $farmDetails->map(function ($item) {
            return [
                'name' => optional($item->farmer)->name ?? 'Unknown Farmer',
                'latitude' => (float) $item->latitude,
                'longitude' => (float) $item->longitude,
                'farm_size' => (float) $item->farm_size,
                'land_type' => $item->land_type,
            ];
        })->values();
    ?>

    (function () {
        const points = <?php echo json_encode($mapPoints, 15, 512) ?>;

        const mapEl = document.getElementById('landMap');
        if (!mapEl) {
            return;
        }

        if (window.__mannalonLandMap) {
            window.__mannalonLandMap.remove();
            window.__mannalonLandMap = null;
        }

        const hasPoints = Array.isArray(points) && points.length > 0;
        const defaultLat = hasPoints ? points[0].latitude : 17.6132;
        const defaultLng = hasPoints ? points[0].longitude : 121.7269;
        const map = L.map(mapEl).setView([defaultLat, defaultLng], hasPoints ? 10 : 8);
        window.__mannalonLandMap = map;

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        if (hasPoints) {
            const bounds = [];
            points.forEach((point) => {
                const marker = L.marker([point.latitude, point.longitude]).addTo(map);
                marker.bindPopup(`
                    <div style="min-width:180px;">
                        <strong>${point.name}</strong><br>
                        Farm Size: ${point.farm_size.toFixed(2)} ha<br>
                        Land Type: ${point.land_type ? point.land_type : 'N/A'}
                    </div>
                `);
                bounds.push([point.latitude, point.longitude]);
            });
            map.fitBounds(bounds, { padding: [30, 30] });
        }
    })();
</script>
</main>
<?php /**PATH C:\xampp\htdocs\Mannalon_App\resources\views\admin\land-management-content.blade.php ENDPATH**/ ?>