

<?php $__env->startSection('title', 'Market Prices'); ?>

<?php $__env->startSection('content'); ?>
<div class="card">
    <h2>📈 Market Prices</h2>
    <p>Track current market prices for agricultural products.</p>
</div>

<div class="card">
    <table>
        <thead>
            <tr>
                <th>Crop</th>
                <th>Current Price</th>
                <th>Trend</th>
            </tr>
        </thead>
        <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $prices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td><?php echo e($item['crop']); ?></td>
                    <td><?php echo e($item['price']); ?></td>
                    <td>
                        <?php if($item['trend'] === 'up'): ?>
                            <span style="color: green;">📈 Up</span>
                        <?php elseif($item['trend'] === 'down'): ?>
                            <span style="color: red;">📉 Down</span>
                        <?php else: ?>
                            <span style="color: #3498db;">➡️ Stable</span>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="3" style="text-align: center; padding: 2rem;">No price data available.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<div class="card">
    <h2>Price Insights</h2>
    <p>Monitor price trends to make informed decisions about when to sell your crops.</p>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Mannalon_App\resources\views\dashboard\market-prices.blade.php ENDPATH**/ ?>