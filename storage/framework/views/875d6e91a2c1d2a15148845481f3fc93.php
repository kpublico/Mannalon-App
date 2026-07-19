<main>
<div class="space-y-6">
    <?php if(session('success')): ?>
        <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3 rounded-lg">
            <i class="fas fa-check-circle mr-2"></i><?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-xl font-bold text-gray-900 mb-4"><i class="fas fa-book mr-2 text-emerald-600"></i>Quick Add Farming Guide</h2>
        <form method="POST" action="<?php echo e(route('admin.guides.store')); ?>" class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <?php echo csrf_field(); ?>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Guide Title *</label>
                <input type="text" name="title" value="<?php echo e(old('title')); ?>" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500" required>
                <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-red-600 text-xs"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Crop Type</label>
                <input type="text" name="crop_type" value="<?php echo e(old('crop_type')); ?>" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500" placeholder="Palay, Corn, Vegetables">
                <?php $__errorArgs = ['crop_type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-red-600 text-xs"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Season</label>
                <select name="season" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                    <option value="">Select Season (Optional)</option>
                    <option value="Wet Season" <?php echo e(old('season') == 'Wet Season' ? 'selected' : ''); ?>>Wet Season</option>
                    <option value="Dry Season" <?php echo e(old('season') == 'Dry Season' ? 'selected' : ''); ?>>Dry Season</option>
                    <option value="Year-Round" <?php echo e(old('season') == 'Year-Round' ? 'selected' : ''); ?>>Year-Round</option>
                </select>
                <?php $__errorArgs = ['season'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-red-600 text-xs"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">
                    <i class="fab fa-youtube text-red-600 mr-1"></i> Video/Resource URL
                </label>
                <input type="url" name="resource_url" value="<?php echo e(old('resource_url')); ?>" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500" placeholder="https://youtube.com/watch?v=..." maxlength="500">
                <?php $__errorArgs = ['resource_url'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-red-600 text-xs"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div class="md:col-span-2">
                <label class="block text-sm font-semibold text-gray-700 mb-1">Step-by-step Guide *</label>
                <textarea name="steps" rows="4" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 font-mono text-sm" placeholder="1. Prepare the soil&#10;2. Plant seeds&#10;3. Water regularly&#10;4. Harvest when ready" required><?php echo e(old('steps')); ?></textarea>
                <?php $__errorArgs = ['steps'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-red-600 text-xs"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div class="md:col-span-2">
                <button class="px-6 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 font-semibold transition">
                    <i class="fas fa-plus mr-2"></i> Save Guide
                </button>
            </div>
        </form>
    </div>

    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-xl font-bold text-gray-900 mb-4"><i class="fas fa-list mr-2 text-emerald-600"></i>All Farming Guides</h2>
        <form method="GET" action="<?php echo e(route('admin.guides.index')); ?>" class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
            <input type="text" name="search" value="<?php echo e($search ?? ''); ?>" placeholder="Search title or steps" class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500">
            <input type="text" name="crop_type" value="<?php echo e($cropType ?? ''); ?>" placeholder="Filter crop type" class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500">
            <button class="px-4 py-2 bg-emerald-100 text-emerald-700 rounded-lg hover:bg-emerald-200 font-semibold transition">
                <i class="fas fa-search mr-2"></i> Filter
            </button>
        </form>

        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 border-b-2 border-gray-200">
                    <tr>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Title</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Crop Type</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Season</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Video?</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Updated</th>
                        <th class="px-4 py-3 text-center text-sm font-semibold text-gray-700">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <?php $__empty_1 = true; $__currentLoopData = $guides; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $guide): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3 font-semibold text-gray-900"><?php echo e($guide->title); ?></td>
                            <td class="px-4 py-3 text-gray-600"><?php echo e($guide->crop_type ?? '-'); ?></td>
                            <td class="px-4 py-3 text-gray-600"><?php echo e($guide->season ?? '-'); ?></td>
                            <td class="px-4 py-3">
                                <?php if($guide->resource_url): ?>
                                    <span class="inline-flex items-center gap-1 px-2 py-1 bg-red-100 text-red-700 text-xs rounded-full">
                                        <i class="fab fa-youtube"></i> Yes
                                    </span>
                                <?php else: ?>
                                    <span class="text-gray-500 text-sm">-</span>
                                <?php endif; ?>
                            </td>
                            <td class="px-4 py-3 text-gray-600 text-sm"><?php echo e($guide->updated_at?->format('M d, Y')); ?></td>
                            <td class="px-4 py-3">
                                <div class="flex justify-center gap-2">
                                    <a href="<?php echo e(route('admin.guides.edit', $guide->id)); ?>" class="px-3 py-1 text-xs bg-blue-600 text-white rounded hover:bg-blue-700 transition">
                                        <i class="fas fa-edit mr-1"></i> Edit
                                    </a>
                                    <form method="POST" action="<?php echo e(route('admin.guides.destroy', $guide->id)); ?>" onsubmit="return confirm('Delete this guide?')" class="inline">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="submit" class="px-3 py-1 text-xs bg-red-600 text-white rounded hover:bg-red-700 transition">
                                            <i class="fas fa-trash mr-1"></i> Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr><td colspan="6" class="px-4 py-8 text-center text-gray-500"><i class="fas fa-inbox mr-2"></i>No guides yet.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <div class="mt-6">
            <?php echo e($guides->links()); ?>

        </div>
    </div>
</div>
</main>
<?php /**PATH C:\xampp\htdocs\Mannalon_App\resources\views\admin\guides-content.blade.php ENDPATH**/ ?>