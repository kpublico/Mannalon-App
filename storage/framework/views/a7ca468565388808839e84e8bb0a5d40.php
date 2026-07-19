<div class="space-y-6">
    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4">
        <button onclick="loadAdminPage('users', '<?php echo e(route('admin.users.index')); ?>')" class="bg-white border border-blue-200 rounded-xl p-5 text-left hover:shadow-md transition">
            <p class="text-sm text-gray-500">All User Accounts</p>
            <p class="text-3xl font-extrabold text-blue-700 mt-1"><?php echo e($totalUsers ?? 0); ?></p>
            <p class="text-xs text-gray-500 mt-1"><i class="fas fa-users-cog mr-1"></i>System-wide users</p>
        </button>
        <div class="bg-white border border-indigo-200 rounded-xl p-5 text-left">
            <p class="text-sm text-gray-500">Super Admins</p>
            <p class="text-3xl font-extrabold text-indigo-700 mt-1"><?php echo e($totalSuperAdmins ?? 0); ?></p>
            <p class="text-xs text-gray-500 mt-1"><i class="fas fa-crown mr-1"></i>Top-level accounts</p>
        </div>
        <div class="bg-white border border-emerald-200 rounded-xl p-5 text-left">
            <p class="text-sm text-gray-500">Admin/LGU Staff</p>
            <p class="text-3xl font-extrabold text-emerald-700 mt-1"><?php echo e($totalAdmins ?? 0); ?></p>
            <p class="text-xs text-gray-500 mt-1"><i class="fas fa-user-shield mr-1"></i>Operational admins</p>
        </div>
        <div class="bg-white border border-amber-200 rounded-xl p-5 text-left">
            <p class="text-sm text-gray-500">Registered Farmers</p>
            <p class="text-3xl font-extrabold text-amber-700 mt-1"><?php echo e($totalFarmers ?? 0); ?></p>
            <p class="text-xs text-gray-500 mt-1"><i class="fas fa-tractor mr-1"></i>Farmer accounts/profiles</p>
        </div>
    </div>

    <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">
        <section class="xl:col-span-2 bg-white border border-blue-200 rounded-xl shadow-sm p-5">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-bold text-gray-900">Latest Admin Accounts</h3>
                <a href="javascript:void(0)" onclick="loadAdminPage('users', '<?php echo e(route('admin.users.index')); ?>')" class="text-sm text-blue-700 font-semibold hover:underline">Open user management</a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="px-4 py-2 text-left text-xs font-semibold text-gray-700">Name</th>
                            <th class="px-4 py-2 text-left text-xs font-semibold text-gray-700">Email</th>
                            <th class="px-4 py-2 text-left text-xs font-semibold text-gray-700">Role</th>
                            <th class="px-4 py-2 text-left text-xs font-semibold text-gray-700">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        <?php $__empty_1 = true; $__currentLoopData = ($recentAdmins ?? collect()); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $account): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td class="px-4 py-3 text-sm font-semibold text-gray-900"><?php echo e($account->name); ?></td>
                                <td class="px-4 py-3 text-sm text-gray-600"><?php echo e($account->email); ?></td>
                                <td class="px-4 py-3 text-sm text-gray-600"><?php echo e(strtoupper(str_replace('_', ' ', $account->role))); ?></td>
                                <td class="px-4 py-3 text-sm">
                                    <span class="px-2 py-1 rounded-full text-xs font-semibold <?php echo e($account->status === 'active' ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-600'); ?>">
                                        <?php echo e(ucfirst($account->status)); ?>

                                    </span>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="4" class="px-4 py-8 text-center text-gray-500">No admin accounts yet.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </section>

        <section class="bg-white border border-blue-200 rounded-xl shadow-sm p-5">
            <h3 class="text-lg font-bold text-gray-900 mb-4">Governance Overview</h3>
            <div class="space-y-3">
                <div class="flex items-center justify-between text-sm"><span class="text-gray-600">Active Users</span><span class="font-bold text-gray-900"><?php echo e($activeUsers ?? 0); ?></span></div>
                <div class="flex items-center justify-between text-sm"><span class="text-gray-600">Announcements</span><span class="font-bold text-gray-900"><?php echo e($totalAnnouncements ?? 0); ?></span></div>
                <div class="flex items-center justify-between text-sm"><span class="text-gray-600">Guides</span><span class="font-bold text-gray-900"><?php echo e($totalGuides ?? 0); ?></span></div>
                <div class="flex items-center justify-between text-sm"><span class="text-gray-600">Price Updates</span><span class="font-bold text-gray-900"><?php echo e($totalCommodityRows ?? 0); ?></span></div>
            </div>
        </section>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\Mannalon_App\resources\views\admin\super-dashboard-content.blade.php ENDPATH**/ ?>