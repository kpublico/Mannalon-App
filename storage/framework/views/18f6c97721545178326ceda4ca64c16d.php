

<?php $__env->startSection('title', 'Announcements'); ?>
<?php $__env->startSection('page-title', 'Announcements'); ?>
<?php $__env->startSection('page-subtitle', 'Stay updated with the latest news and updates'); ?>

<?php $__env->startSection('content'); ?>
<div class="space-y-6">
    <form method="GET" action="<?php echo e(route('farmer.announcements')); ?>" class="bg-white rounded-xl shadow-md p-6">
        <div class="flex flex-wrap gap-4">
            <select name="category" class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                <option value="">All Categories</option>
                <option value="Alert" <?php echo e($category === 'Alert' ? 'selected' : ''); ?>>Alert</option>
                <option value="General" <?php echo e($category === 'General' ? 'selected' : ''); ?>>General</option>
                <option value="Weather" <?php echo e($category === 'Weather' ? 'selected' : ''); ?>>Weather</option>
            </select>
            <input
                type="text"
                name="search"
                value="<?php echo e($search); ?>"
                placeholder="Search announcements..."
                class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500"
            >
            <button type="submit" class="px-6 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 transition">
                <i class="fas fa-search mr-2"></i>Search
            </button>
        </div>
    </form>

    <div class="space-y-4">
        <?php $__empty_1 = true; $__currentLoopData = $announcements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $announcement): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <?php
                $borderClass = 'border-emerald-600';
                $badgeClass = 'bg-emerald-100 text-emerald-700';
                $iconClass = 'text-emerald-600';
                if ($announcement->category === 'Alert') {
                    $borderClass = 'border-red-600';
                    $badgeClass = 'bg-red-100 text-red-700';
                    $iconClass = 'text-red-600';
                } elseif ($announcement->category === 'Weather') {
                    $borderClass = 'border-blue-600';
                    $badgeClass = 'bg-blue-100 text-blue-700';
                    $iconClass = 'text-blue-600';
                }
            ?>
            <div class="bg-white rounded-xl shadow-md p-6 border-l-4 <?php echo e($borderClass); ?> hover:shadow-lg transition">
                <div class="flex items-start justify-between gap-3">
                    <div class="flex-1">
                        <div class="flex items-center gap-3 mb-2">
                            <span class="px-3 py-1 <?php echo e($badgeClass); ?> text-xs font-semibold rounded-full">
                                <?php echo e($announcement->category); ?>

                            </span>
                            <span class="text-sm text-gray-500"><?php echo e($announcement->created_at->format('F d, Y')); ?></span>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 mb-2"><?php echo e($announcement->title); ?></h3>
                        <p class="text-gray-600 whitespace-pre-line"><?php echo e($announcement->content); ?></p>
                    </div>
                    <i class="fas fa-bullhorn text-3xl <?php echo e($iconClass); ?>"></i>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="bg-white rounded-xl shadow-md p-6 text-center text-gray-600">
                No announcements found.
            </div>
        <?php endif; ?>
    </div>

    <div class="bg-white rounded-xl shadow-md p-4">
        <?php echo e($announcements->links()); ?>

    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.farmer-dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Mannalon_App\resources\views\farmer\announcements.blade.php ENDPATH**/ ?>