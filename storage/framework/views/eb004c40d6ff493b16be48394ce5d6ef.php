

<?php $__env->startSection('title', 'Farming Guides & Video Tutorials'); ?>
<?php $__env->startSection('page-title', 'Farming Guides & Video Tutorials'); ?>
<?php $__env->startSection('page-subtitle', 'Master modern farming techniques through video tutorials and expert guides'); ?>

<?php $__env->startSection('content'); ?>
<div class="space-y-6">
    <form method="GET" action="<?php echo e(route('farmer.guides')); ?>" class="bg-white rounded-xl shadow-md p-6">
        <div class="flex flex-wrap gap-3">
            <input
                type="text"
                name="search"
                value="<?php echo e($search); ?>"
                placeholder="Search guide title or steps..."
                class="flex-1 min-w-[200px] px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500"
            >
            <input
                type="text"
                name="crop_type"
                value="<?php echo e($cropType); ?>"
                placeholder="Filter by crop type (e.g. Palay, Corn)"
                class="min-w-[200px] px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500"
            >
            <button type="submit" class="px-6 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 transition font-semibold">
                <i class="fas fa-search mr-2"></i>Search
            </button>
        </div>
    </form>

    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
        <?php $__empty_1 = true; $__currentLoopData = $guides; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $guide): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <article class="bg-white rounded-xl shadow-md border-t-4 border-emerald-500 overflow-hidden hover:shadow-lg transition flex flex-col">
                <div class="p-5 border-b border-gray-100">
                    <h3 class="text-lg font-bold text-gray-800"><?php echo e($guide->title); ?></h3>
                    <div class="mt-3 flex flex-wrap gap-2 text-xs">
                        <span class="px-3 py-1 rounded-full bg-emerald-100 text-emerald-700 font-semibold">
                            <i class="fas fa-leaf mr-1"></i><?php echo e($guide->crop_type ?: 'General'); ?>

                        </span>
                        <?php if($guide->season): ?>
                            <span class="px-3 py-1 rounded-full bg-blue-100 text-blue-700 font-semibold">
                                <i class="fas fa-calendar mr-1"></i><?php echo e($guide->season); ?>

                            </span>
                        <?php endif; ?>
                        <span class="px-3 py-1 rounded-full bg-gray-100 text-gray-700 font-semibold">
                            <i class="fas fa-clock mr-1"></i><?php echo e($guide->created_at->format('M d, Y')); ?>

                        </span>
                    </div>
                </div>

                <div class="p-5 flex-1">
                    <p class="text-sm text-gray-700 whitespace-pre-line line-clamp-4 mb-4"><?php echo e($guide->steps); ?></p>
                </div>

                <div class="px-5 pb-5 border-t border-gray-100 flex gap-3 flex-wrap">
                    <?php if($guide->resource_url): ?>
                        <a href="<?php echo e($guide->resource_url); ?>" target="_blank" rel="noopener noreferrer" class="flex-1 min-w-[120px] px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg font-semibold text-sm transition flex items-center justify-center gap-2">
                            <i class="fab fa-youtube"></i> Watch Video
                        </a>
                    <?php else: ?>
                        <div class="flex-1 min-w-[120px] px-4 py-2 bg-gray-300 text-gray-600 rounded-lg font-semibold text-sm flex items-center justify-center gap-2 cursor-not-allowed">
                            <i class="fas fa-ban"></i> No Video
                        </div>
                    <?php endif; ?>

                    <?php if($guide->pdf_file): ?>
                        <a href="<?php echo e(asset('storage/' . $guide->pdf_file)); ?>" target="_blank" rel="noopener noreferrer" download class="flex-1 min-w-[120px] px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-semibold text-sm transition flex items-center justify-center gap-2">
                            <i class="fas fa-file-pdf"></i> Download PDF
                        </a>
                    <?php else: ?>
                        <div class="flex-1 min-w-[120px] px-4 py-2 bg-gray-300 text-gray-600 rounded-lg font-semibold text-sm flex items-center justify-center gap-2 cursor-not-allowed">
                            <i class="fas fa-ban"></i> No PDF
                        </div>
                    <?php endif; ?>
                </div>
            </article>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="md:col-span-2 xl:col-span-3 bg-white rounded-xl shadow-md p-8 text-center">
                <i class="fas fa-inbox text-gray-400 text-4xl mb-4"></i>
                <p class="text-gray-600 font-semibold">No farming guides found.</p>
                <p class="text-gray-500 text-sm mt-2">Try adjusting your search or crop type filter.</p>
            </div>
        <?php endif; ?>
    </div>

    <div class="bg-white rounded-xl shadow-md p-4">
        <?php echo e($guides->links()); ?>

    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.farmer-dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Mannalon_App\resources\views/farmer/guides.blade.php ENDPATH**/ ?>