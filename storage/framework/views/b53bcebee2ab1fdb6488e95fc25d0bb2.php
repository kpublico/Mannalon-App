

<?php $__env->startSection('title', 'Create Announcement'); ?>
<?php $__env->startSection('page-title', 'Create New Announcement'); ?>
<?php $__env->startSection('page-subtitle', 'Add a new announcement for farmers'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-lg shadow-md p-8">
        <form method="POST" action="<?php echo e(route('admin.announcements.store')); ?>">
            <?php echo csrf_field(); ?>
            
            <div class="space-y-6">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Announcement Title</label>
                    <input type="text" name="title" class="w-full border-2 border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:border-emerald-600" placeholder="Enter announcement title" value="<?php echo e(old('title')); ?>" required>
                    <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-red-600 text-sm"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Content</label>
                    <textarea name="content" rows="5" class="w-full border-2 border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:border-emerald-600" placeholder="Enter announcement content" required><?php echo e(old('content')); ?></textarea>
                    <?php $__errorArgs = ['content'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-red-600 text-sm"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Category</label>
                    <select name="category" class="w-full border-2 border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:border-emerald-600" required>
                        <option value="">Select a category</option>
                        <option value="General" <?php echo e(old('category') == 'General' ? 'selected' : ''); ?>>General</option>
                        <option value="Alert" <?php echo e(old('category') == 'Alert' ? 'selected' : ''); ?>>Alert</option>
                        <option value="Weather" <?php echo e(old('category') == 'Weather' ? 'selected' : ''); ?>>Weather</option>
                    </select>
                    <?php $__errorArgs = ['category'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-red-600 text-sm"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div class="border-t pt-6">
                    <h3 class="text-lg font-semibold text-gray-700 mb-4">Target Audience</h3>
                    
                    <div class="mb-4">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Audience Scope</label>
                        <select name="audience_scope" class="w-full border-2 border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:border-emerald-600" id="audience_scope" required>
                            <option value="">Select audience scope</option>
                            <option value="all" <?php echo e(old('audience_scope') == 'all' ? 'selected' : ''); ?>>All Farmers</option>
                            <option value="specific_group" <?php echo e(old('audience_scope') == 'specific_group' ? 'selected' : ''); ?>>Specific Farmer Group</option>
                        </select>
                        <?php $__errorArgs = ['audience_scope'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-red-600 text-sm"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div id="target_group_container" class="mb-4" style="display: <?php echo e(old('audience_scope') == 'specific_group' ? 'block' : 'none'); ?>">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Target Group</label>
                        <select name="target_group_id" class="w-full border-2 border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:border-emerald-600">
                            <option value="">Select a farmer group</option>
                            <?php $__empty_1 = true; $__currentLoopData = $groups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <option value="<?php echo e($group->id); ?>" <?php echo e(old('target_group_id') == $group->id ? 'selected' : ''); ?>><?php echo e($group->group_name); ?> (<?php echo e($group->region); ?>)</option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <option value="">No farmer groups available</option>
                            <?php endif; ?>
                        </select>
                        <?php $__errorArgs = ['target_group_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-red-600 text-sm"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>

                <div class="border-t pt-6">
                    <h3 class="text-lg font-semibold text-gray-700 mb-4">Publishing Options</h3>
                    
                    <div class="mb-4">
                        <label class="flex items-center">
                            <input type="checkbox" name="is_published" value="1" class="w-4 h-4" checked>
                            <span class="ml-2 text-sm font-medium text-gray-700">Publish Immediately</span>
                        </label>
                        <?php $__errorArgs = ['is_published'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-red-600 text-sm"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Start Date & Time</label>
                            <input type="datetime-local" name="starts_at" class="w-full border-2 border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:border-emerald-600" value="<?php echo e(old('starts_at')); ?>">
                            <?php $__errorArgs = ['starts_at'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-red-600 text-sm"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">End Date & Time</label>
                            <input type="datetime-local" name="ends_at" class="w-full border-2 border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:border-emerald-600" value="<?php echo e(old('ends_at')); ?>">
                            <?php $__errorArgs = ['ends_at'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-red-600 text-sm"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Expiry Date</label>
                        <input type="date" name="expiry_date" class="w-full border-2 border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:border-emerald-600" value="<?php echo e(old('expiry_date')); ?>">
                        <?php $__errorArgs = ['expiry_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-red-600 text-sm"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>

                <div class="flex gap-3 pt-6">
                    <a href="<?php echo e(route('admin.announcements.index')); ?>" class="flex-1 bg-gray-300 hover:bg-gray-400 text-gray-800 py-3 px-4 rounded-lg text-center font-semibold transition">
                        Cancel
                    </a>
                    <button type="submit" class="flex-1 bg-emerald-600 hover:bg-emerald-700 text-white py-3 px-4 rounded-lg font-semibold transition">
                        Create Announcement
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
document.getElementById('audience_scope').addEventListener('change', function() {
    const targetGroupContainer = document.getElementById('target_group_container');
    if (this.value === 'specific_group') {
        targetGroupContainer.style.display = 'block';
    } else {
        targetGroupContainer.style.display = 'none';
    }
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin-dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\jayso\Desktop\dev\web\Mannalon-App\resources\views/admin/announcements/create.blade.php ENDPATH**/ ?>