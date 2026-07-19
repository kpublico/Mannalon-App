<main>
<div class="space-y-6">
    <div class="bg-yellow-100 border-2 border-yellow-500 p-4 rounded font-bold text-yellow-900">
        🔍 ANNOUNCEMENT PORTAL LOADED - Total Items: <?php echo e($announcements->total()); ?>

    </div>
    
    <?php if(session('success')): ?>
        <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3 rounded-lg"><?php echo e(session('success')); ?></div>
    <?php endif; ?>

    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-xl font-bold text-gray-900 mb-4">🚀 Quick Post Announcement</h2>
        <p class="text-sm text-gray-600 mb-4">For detailed options, use the <a href="<?php echo e(route('admin.announcements.create')); ?>" class="text-emerald-600 hover:underline">full form</a></p>
        <form method="POST" action="<?php echo e(route('admin.announcements.store')); ?>" class="space-y-4">
            <?php echo csrf_field(); ?>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Title</label>
                <input type="text" name="title" class="w-full px-4 py-2 border border-gray-300 rounded-lg" required placeholder="Announcement title">
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Category</label>
                    <select name="category" class="w-full px-4 py-2 border border-gray-300 rounded-lg" required>
                        <option value="">Select category</option>
                        <option value="General">General</option>
                        <option value="Alert">Alert</option>
                        <option value="Weather">Weather</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Audience</label>
                    <select name="audience_scope" class="w-full px-4 py-2 border border-gray-300 rounded-lg" required id="quick_audience">
                        <option value="all">All Farmers</option>
                        <option value="specific_group">Specific Group</option>
                    </select>
                </div>
            </div>
            
            <div id="quick_group_container" style="display: none;">
                <label class="block text-sm font-semibold text-gray-700 mb-1">Select Farmer Group</label>
                <select name="target_group_id" class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                    <option value="">Select a group</option>
                    <?php if(isset($groups) && $groups->count() > 0): ?>
                        <?php $__currentLoopData = $groups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($group->id); ?>"><?php echo e($group->group_name); ?> (<?php echo e($group->region ?? 'N/A'); ?>)</option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                        <option value="">No groups available</option>
                    <?php endif; ?>
                </select>
            </div>
            
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Content</label>
                <textarea name="content" rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-lg" required placeholder="Announcement content"></textarea>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Expiry Date</label>
                    <input type="date" name="expiry_date" class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                </div>
                <div class="flex items-end gap-2">
                    <label class="flex items-center">
                        <input type="checkbox" name="is_published" value="1" class="w-4 h-4" checked>
                        <span class="ml-2 text-sm font-medium text-gray-700">Publish immediately</span>
                    </label>
                </div>
            </div>
            
            <div class="flex gap-2 pt-2">
                <button type="submit" class="flex-1 px-6 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 font-semibold">
                    <i class="fas fa-paper-plane mr-2"></i>Post Announcement
                </button>
                <a href="<?php echo e(route('admin.announcements.create')); ?>" class="px-4 py-2 bg-blue-100 text-blue-700 rounded-lg hover:bg-blue-200 font-semibold">
                    Advanced Form
                </a>
            </div>
        </form>
    </div>

    <script>
    document.getElementById('quick_audience').addEventListener('change', function() {
        const container = document.getElementById('quick_group_container');
        if (this.value === 'specific_group') {
            container.style.display = 'block';
        } else {
            container.style.display = 'none';
        }
    });
    </script>

    <div class="bg-white rounded-lg shadow-md p-6">
        <form method="GET" action="<?php echo e(route('admin.announcements.index')); ?>" class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
            <input type="text" name="search" value="<?php echo e($search ?? ''); ?>" placeholder="Search title/content" class="px-4 py-2 border border-gray-300 rounded-lg">
            <select name="category" class="px-4 py-2 border border-gray-300 rounded-lg">
                <option value="">All Categories</option>
                <option value="General" <?php echo e(($category ?? '') === 'General' ? 'selected' : ''); ?>>General</option>
                <option value="Alert" <?php echo e(($category ?? '') === 'Alert' ? 'selected' : ''); ?>>Alert</option>
                <option value="Weather" <?php echo e(($category ?? '') === 'Weather' ? 'selected' : ''); ?>>Weather</option>
            </select>
            <button class="px-4 py-2 bg-emerald-100 text-emerald-700 rounded-lg hover:bg-emerald-200 font-semibold">Filter</button>
        </form>

        <div class="overflow-x-auto">
            <!-- Debug Info -->
            <div class="mb-4 p-4 bg-blue-50 border border-blue-200 rounded text-xs text-gray-700">
                <strong>Debug Info:</strong> Total announcements: <?php echo e($announcements->total()); ?> | Current page: <?php echo e($announcements->currentPage()); ?> | Per page: <?php echo e($announcements->perPage()); ?>

            </div>
            
            <table class="w-full">
                <thead class="bg-gray-50 border-b-2 border-gray-200">
                    <tr>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Title</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Category</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Date</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Expiry</th>
                        <th class="px-4 py-3 text-center text-sm font-semibold text-gray-700">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <?php $__empty_1 = true; $__currentLoopData = $announcements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $announcement): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3 text-gray-900 font-semibold"><?php echo e($announcement->title); ?></td>
                            <td class="px-4 py-3"><span class="px-2 py-1 text-xs rounded-full bg-emerald-100 text-emerald-800"><?php echo e($announcement->category); ?></span></td>
                            <td class="px-4 py-3 text-gray-600"><?php echo e($announcement->created_at->format('M d, Y')); ?></td>
                            <td class="px-4 py-3 text-gray-600"><?php echo e($announcement->expiry_date ? \Illuminate\Support\Carbon::parse($announcement->expiry_date)->format('M d, Y') : 'N/A'); ?></td>
                            <td class="px-4 py-3">
                                <div class="flex justify-center gap-2">
                                    <a href="<?php echo e(route('admin.announcements.edit', $announcement->id)); ?>" class="px-3 py-1 text-xs bg-blue-600 text-white rounded hover:bg-blue-700">Edit</a>
                                    <form method="POST" action="<?php echo e(route('admin.announcements.destroy', $announcement->id)); ?>" onsubmit="return confirm('Delete this announcement?')" style="display: inline;">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button class="px-3 py-1 text-xs bg-red-600 text-white rounded hover:bg-red-700">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr><td colspan="5" class="px-4 py-8 text-center text-gray-500">No announcements yet.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

    </div>
</div>
</main>
<?php /**PATH C:\xampp\htdocs\Mannalon_App\resources\views\admin\announcements-content.blade.php ENDPATH**/ ?>