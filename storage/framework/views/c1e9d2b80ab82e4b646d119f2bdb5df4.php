<main>
<div class="space-y-6">
    <?php if(session('success')): ?>
        <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3 rounded-lg"><?php echo e(session('success')); ?></div>
    <?php endif; ?>

    <div class="bg-white rounded-lg shadow-md p-6">
        <h3 class="text-lg font-bold text-gray-900 mb-4">Create User (Admin Only Role Assignment)</h3>
        <form method="POST" action="<?php echo e(route('admin.users.create')); ?>" class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <?php echo csrf_field(); ?>
            <input type="text" name="first_name" placeholder="First name" class="px-4 py-2 border border-gray-300 rounded-lg" required>
            <input type="text" name="last_name" placeholder="Last name" class="px-4 py-2 border border-gray-300 rounded-lg" required>
            <input type="email" name="email" placeholder="Email" class="px-4 py-2 border border-gray-300 rounded-lg" required>
            <input type="password" name="password" placeholder="Password" class="px-4 py-2 border border-gray-300 rounded-lg" required>
            <input type="password" name="password_confirmation" placeholder="Confirm password" class="px-4 py-2 border border-gray-300 rounded-lg" required>
            <select name="role" class="px-4 py-2 border border-gray-300 rounded-lg" required>
                <option value="">Select role</option>
                <option value="admin">Admin</option>
                <option value="coordinator">Coordinator</option>
                <option value="farmer">Farmer</option>
            </select>
            <select name="sex" class="px-4 py-2 border border-gray-300 rounded-lg" required>
                <option value="">Sex</option>
                <option value="male">Male</option>
                <option value="female">Female</option>
            </select>
            <input type="text" name="phone" placeholder="Phone" class="px-4 py-2 border border-gray-300 rounded-lg">
            <input type="text" name="state" placeholder="State/Province" class="px-4 py-2 border border-gray-300 rounded-lg" required>
            <input type="text" name="city" placeholder="City/Municipality" class="px-4 py-2 border border-gray-300 rounded-lg" required>
            <textarea name="address" placeholder="Address" class="px-4 py-2 border border-gray-300 rounded-lg md:col-span-2"></textarea>
            <button type="submit" class="px-4 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 font-semibold">Create User</button>
        </form>
    </div>

    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="px-6 py-4 bg-gray-50 border-b border-gray-200 flex items-center justify-between gap-3">
            <h3 class="text-lg font-bold text-gray-900">User Management</h3>
            <form method="GET" action="<?php echo e(route('admin.users.index')); ?>" class="flex gap-2">
                <input type="text" name="search" value="<?php echo e($search ?? ''); ?>" placeholder="Search users" class="px-3 py-2 border border-gray-300 rounded-lg text-sm">
                <button class="px-3 py-2 bg-emerald-100 text-emerald-700 rounded-lg text-sm font-semibold">Search</button>
            </form>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 border-b-2 border-gray-200">
                    <tr>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Name</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Email</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Role</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Status</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Location</th>
                        <th class="px-4 py-3 text-center text-sm font-semibold text-gray-700">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <?php $__empty_1 = true; $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3 font-semibold text-gray-900"><?php echo e($user->name); ?></td>
                            <td class="px-4 py-3 text-gray-600"><?php echo e($user->email); ?></td>
                            <td class="px-4 py-3 text-gray-600"><?php echo e(ucfirst($user->role)); ?></td>
                            <td class="px-4 py-3 text-gray-600"><?php echo e(ucfirst($user->status)); ?></td>
                            <td class="px-4 py-3 text-gray-600"><?php echo e(($user->city ?? 'N/A') . ', ' . ($user->state ?? 'N/A')); ?></td>
                            <td class="px-4 py-3">
                                <div class="flex justify-center gap-2">
                                    <form method="POST" action="<?php echo e(route('admin.users.update', $user->id)); ?>" class="flex gap-1 items-center">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('PUT'); ?>
                                        <input type="hidden" name="name" value="<?php echo e($user->name); ?>">
                                        <input type="hidden" name="email" value="<?php echo e($user->email); ?>">
                                        <select name="role" class="text-xs border border-gray-300 rounded px-2 py-1">
                                            <option value="admin" <?php echo e($user->role === 'admin' ? 'selected' : ''); ?>>Admin</option>
                                            <option value="coordinator" <?php echo e($user->role === 'coordinator' ? 'selected' : ''); ?>>Coordinator</option>
                                            <option value="farmer" <?php echo e($user->role === 'farmer' ? 'selected' : ''); ?>>Farmer</option>
                                        </select>
                                        <select name="status" class="text-xs border border-gray-300 rounded px-2 py-1">
                                            <option value="active" <?php echo e($user->status === 'active' ? 'selected' : ''); ?>>Active</option>
                                            <option value="inactive" <?php echo e($user->status === 'inactive' ? 'selected' : ''); ?>>Inactive</option>
                                        </select>
                                        <button class="px-2 py-1 text-xs bg-blue-600 text-white rounded">Save</button>
                                    </form>
                                    <form method="POST" action="<?php echo e(route('admin.users.destroy', $user->id)); ?>" onsubmit="return confirm('Delete this user?')">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button class="px-2 py-1 text-xs bg-red-600 text-white rounded">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr><td colspan="6" class="px-4 py-8 text-center text-gray-500">No users found.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <div class="px-6 py-4"><?php echo e($users->links()); ?></div>
    </div>
</div>
</main>
<?php /**PATH C:\xampp\htdocs\Mannalon_App\resources\views/admin/users-content.blade.php ENDPATH**/ ?>