

<?php $__env->startSection('title', 'Market Prices'); ?>
<?php $__env->startSection('page-title', 'Market Prices'); ?>
<?php $__env->startSection('page-subtitle', 'Current market prices for agricultural products'); ?>

<?php $__env->startSection('content'); ?>
<div class="space-y-6">
    <form method="GET" action="<?php echo e(route('farmer.market-prices')); ?>" class="bg-white rounded-xl shadow-md p-6">
        <div class="flex flex-wrap gap-4 items-center">
            <input
                type="text"
                name="search"
                value="<?php echo e($search); ?>"
                placeholder="Search commodity..."
                class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500"
            >
            <button type="submit" class="px-6 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 transition">
                <i class="fas fa-search mr-2"></i>Search
            </button>
        </div>
    </form>

    <div class="bg-white rounded-xl shadow-md p-6">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-4 text-left text-sm font-bold text-gray-700">Commodity</th>
                        <th class="px-6 py-4 text-left text-sm font-bold text-gray-700">Price / Kilo</th>
                        <th class="px-6 py-4 text-left text-sm font-bold text-gray-700">Source Market</th>
                        <th class="px-6 py-4 text-left text-sm font-bold text-gray-700">Updated Date</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <?php $__empty_1 = true; $__currentLoopData = $prices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $price): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4 font-semibold text-gray-800"><?php echo e($price->commodity); ?></td>
                            <td class="px-6 py-4 text-gray-800">PHP <?php echo e(number_format((float) $price->price_per_kilo, 2)); ?></td>
                            <td class="px-6 py-4 text-gray-600"><?php echo e($price->source_market ?: 'N/A'); ?></td>
                            <td class="px-6 py-4 text-gray-600"><?php echo e(optional($price->date_updated)->format('F d, Y')); ?></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="4" class="px-6 py-6 text-center text-gray-600">No market prices found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-md p-4">
        <?php echo e($prices->links()); ?>

    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.farmer-dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\jayso\Desktop\dev\web\Mannalon-App\resources\views/farmer/market-prices.blade.php ENDPATH**/ ?>