

<?php $__env->startSection('title', 'Monitor Crops'); ?>

<?php $__env->startSection('content'); ?>
<div class="card">
    <h2>🌾 Crops Monitoring</h2>
    <p>Monitor all crops from all farmers</p>
</div>

<div class="card">
    <?php if($crops->count() > 0): ?>
        <table>
            <thead>
                <tr>
                    <th>Crop Name</th>
                    <th>Farmer</th>
                    <th>Area</th>
                    <th>Status</th>
                    <th>Planting Date</th>
                    <th>Expected Harvest</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $crops; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $crop): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($crop->name); ?></td>
                        <td><?php echo e($crop->user->name); ?></td>
                        <td><?php echo e($crop->area); ?></td>
                        <td><?php echo e($crop->status); ?></td>
                        <td><?php echo e($crop->planting_date->format('M d, Y')); ?></td>
                        <td><?php echo e($crop->expected_harvest_date->format('M d, Y')); ?></td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>

        <div style="margin-top: 1rem;">
            <?php echo e($crops->links()); ?>

        </div>
    <?php else: ?>
        <p style="text-align: center; padding: 2rem;">No crops found</p>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Mannalon_App\resources\views\admin\crops\index.blade.php ENDPATH**/ ?>