

<?php $__env->startSection('title', 'Profile'); ?>
<?php $__env->startSection('page-title', 'My Profile'); ?>
<?php $__env->startSection('page-subtitle', 'View your personal information and change password'); ?>

<?php $__env->startSection('content'); ?>
<div class="space-y-6">
    <!-- Profile Header -->
    <div class="bg-gradient-to-r from-emerald-600 to-emerald-800 rounded-xl p-8 text-white">
        <div class="flex items-center gap-6">
            <div class="w-24 h-24 bg-white rounded-full flex items-center justify-center text-4xl font-bold text-emerald-600 shadow-lg">
                <?php echo e(strtoupper(substr(auth()->user()->name ?? 'F', 0, 1))); ?>

            </div>
            <div>
                <h2 class="text-3xl font-bold mb-2"><?php echo e(auth()->user()->name ?? 'Farmer'); ?></h2>
                <p class="text-emerald-100 mb-1">📧 <?php echo e(auth()->user()->email); ?></p>
                <p class="text-emerald-100">👤 <?php echo e(ucfirst(auth()->user()->role ?? 'farmer')); ?> - Viewer Access</p>
            </div>
        </div>
    </div>

    <!-- Personal Information (Read-Only) -->
    <div class="bg-white rounded-xl shadow-md p-8">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-2xl font-bold text-gray-800">Personal Information</h3>
            <span class="px-4 py-2 bg-gray-100 text-gray-600 rounded-lg text-sm font-semibold">
                <i class="fas fa-eye mr-2"></i>Viewer Only
            </span>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Full Name -->
            <div class="md:col-span-2">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Full Name</label>
                <div class="px-4 py-3 bg-gray-50 border border-gray-200 rounded-lg text-gray-800">
                    <?php echo e(auth()->user()->name ?? 'Not provided'); ?>

                </div>
            </div>

            <!-- Email -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Email Address</label>
                <div class="px-4 py-3 bg-gray-50 border border-gray-200 rounded-lg text-gray-800">
                    <?php echo e(auth()->user()->email); ?>

                </div>
            </div>

            <!-- Phone -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Phone Number</label>
                <div class="px-4 py-3 bg-gray-50 border border-gray-200 rounded-lg text-gray-800">
                    <?php echo e(auth()->user()->phone ?? 'Not provided'); ?>

                </div>
            </div>

            <!-- Province (State) -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Province</label>
                <div class="px-4 py-3 bg-gray-50 border border-gray-200 rounded-lg text-gray-800">
                    <?php echo e(auth()->user()->state ?? 'Not provided'); ?>

                </div>
            </div>

            <!-- Municipality (City) -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Municipality</label>
                <div class="px-4 py-3 bg-gray-50 border border-gray-200 rounded-lg text-gray-800">
                    <?php echo e(auth()->user()->city ?? 'Not provided'); ?>

                </div>
            </div>

            <!-- Barangay -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Barangay</label>
                <div class="px-4 py-3 bg-gray-50 border border-gray-200 rounded-lg text-gray-800">
                    <?php echo e(auth()->user()->barangay ?? 'Not provided'); ?>

                </div>
            </div>

            <!-- Zone/Purok -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Zone/Purok</label>
                <div class="px-4 py-3 bg-gray-50 border border-gray-200 rounded-lg text-gray-800">
                    <?php echo e(auth()->user()->zone_purok ?? 'Not provided'); ?>

                </div>
            </div>

            <!-- House Number -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">House Number</label>
                <div class="px-4 py-3 bg-gray-50 border border-gray-200 rounded-lg text-gray-800">
                    <?php echo e(auth()->user()->house_number ?? 'Not provided'); ?>

                </div>
            </div>

            <!-- Sex/Gender -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Gender</label>
                <div class="px-4 py-3 bg-gray-50 border border-gray-200 rounded-lg text-gray-800">
                    <?php echo e(auth()->user()->sex ?? 'Not provided'); ?>

                </div>
            </div>

            <!-- Address -->
            <div class="md:col-span-2">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Complete Address</label>
                <div class="px-4 py-3 bg-gray-50 border border-gray-200 rounded-lg text-gray-800">
                    <?php echo e(auth()->user()->address ?? 'Not provided'); ?>

                </div>
            </div>

            <!-- Account Status -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Account Status</label>
                <div class="px-4 py-3 bg-gray-50 border border-gray-200 rounded-lg">
                    <?php if(auth()->user()->status === 'active'): ?>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-green-100 text-green-800">
                            <i class="fas fa-check-circle mr-2"></i>Active
                        </span>
                    <?php else: ?>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-gray-100 text-gray-800">
                            <?php echo e(ucfirst(auth()->user()->status ?? 'pending')); ?>

                        </span>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Role -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Account Type</label>
                <div class="px-4 py-3 bg-gray-50 border border-gray-200 rounded-lg text-gray-800">
                    <?php echo e(ucfirst(auth()->user()->role ?? 'farmer')); ?>

                </div>
            </div>
        </div>

        <div class="mt-6 bg-blue-50 border border-blue-200 rounded-lg p-4">
            <p class="text-sm text-blue-800">
                <i class="fas fa-info-circle mr-2"></i>
                <strong>Note:</strong> To update your personal information, please contact the Municipal Agriculture Office or system administrator.
            </p>
        </div>
    </div>

    <!-- Change Password (Functional Form) -->
    <div class="bg-white rounded-xl shadow-md p-8">
        <div class="flex items-center gap-3 mb-6">
            <i class="fas fa-lock text-2xl text-emerald-600"></i>
            <h3 class="text-2xl font-bold text-gray-800">Change Password</h3>
        </div>

        <?php if(session('success')): ?>
        <div class="mb-6 bg-green-50 border border-green-200 rounded-lg p-4">
            <p class="text-sm text-green-800">
                <i class="fas fa-check-circle mr-2"></i><?php echo e(session('success')); ?>

            </p>
        </div>
        <?php endif; ?>

        <?php if($errors->any()): ?>
        <div class="mb-6 bg-red-50 border border-red-200 rounded-lg p-4">
            <p class="text-sm text-red-800">
                <i class="fas fa-exclamation-circle mr-2"></i>
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php echo e($error); ?><br>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </p>
        </div>
        <?php endif; ?>

        <form action="<?php echo e(route('farmer.profile.password')); ?>" method="POST" class="space-y-6">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>

            <!-- Current Password -->
            <div>
                <label for="current_password" class="block text-sm font-semibold text-gray-700 mb-2">
                    Current Password <span class="text-red-500">*</span>
                </label>
                <input 
                    type="password" 
                    id="current_password" 
                    name="current_password" 
                    required
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500"
                    placeholder="Enter your current password">
            </div>

            <!-- New Password -->
            <div>
                <label for="new_password" class="block text-sm font-semibold text-gray-700 mb-2">
                    New Password <span class="text-red-500">*</span>
                </label>
                <input 
                    type="password" 
                    id="new_password" 
                    name="new_password" 
                    required
                    minlength="8"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500"
                    placeholder="Enter new password (min. 8 characters)">
                <p class="text-xs text-gray-500 mt-1">Password must be at least 8 characters long</p>
            </div>

            <!-- Confirm New Password -->
            <div>
                <label for="new_password_confirmation" class="block text-sm font-semibold text-gray-700 mb-2">
                    Confirm New Password <span class="text-red-500">*</span>
                </label>
                <input 
                    type="password" 
                    id="new_password_confirmation" 
                    name="new_password_confirmation" 
                    required
                    minlength="8"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500"
                    placeholder="Confirm your new password">
            </div>

            <!-- Submit Button -->
            <div class="flex gap-4">
                <button 
                    type="submit" 
                    class="px-8 py-3 bg-emerald-600 text-white font-semibold rounded-lg hover:bg-emerald-700 transition">
                    <i class="fas fa-save mr-2"></i>Update Password
                </button>
                <button 
                    type="reset" 
                    class="px-8 py-3 bg-gray-200 text-gray-700 font-semibold rounded-lg hover:bg-gray-300 transition">
                    <i class="fas fa-times mr-2"></i>Cancel
                </button>
            </div>
        </form>
    </div>

    <!-- Account Info -->
    <div class="bg-gray-50 rounded-xl border border-gray-200 p-6">
        <h4 class="font-semibold text-gray-800 mb-3">Account Information</h4>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
            <div>
                <p class="text-gray-600">Account Created</p>
                <p class="font-semibold text-gray-800"><?php echo e(Auth::user()->created_at->format('F d, Y')); ?></p>
            </div>
            <div>
                <p class="text-gray-600">Last Updated</p>
                <p class="font-semibold text-gray-800"><?php echo e(Auth::user()->updated_at->format('F d, Y')); ?></p>
            </div>
            <div>
                <p class="text-gray-600">Account Status</p>
                <p class="font-semibold text-green-600">✓ Active</p>
            </div>
            <div>
                <p class="text-gray-600">Access Level</p>
                <p class="font-semibold text-gray-800">Viewer Only</p>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.farmer-dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Mannalon_App\resources\views\farmer\profile.blade.php ENDPATH**/ ?>