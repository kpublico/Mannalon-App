

<?php $__env->startSection('title', 'Monitor Livestock'); ?>

<?php $__env->startSection('content'); ?>
<div class="card">
    <h2>🐄 Livestock Monitoring</h2>
    <p>Monitor all livestock from all farmers</p>
</div>

<div class="card">
    <?php if($livestock->count() > 0): ?>
        <table>
            <thead>
                <tr>
                    <th>Type</th>
                    <th>Farmer</th>
                    <th>Count</th>
                    <th>Health Status</th>
                    <th>Last Checkup</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $livestock; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $animal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($animal->type); ?></td>
                        <td><?php echo e($animal->user->name); ?></td>
                        <td><?php echo e($animal->count); ?></td>
                        <td><?php echo e($animal->health_status); ?></td>
                        <td><?php echo e($animal->last_checkup ? $animal->last_checkup->format('M d, Y') : 'N/A'); ?></td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>

        <div style="margin-top: 1rem;">
            <?php echo e($livestock->links()); ?>

        </div>
    <?php else: ?>
        <p style="text-align: center; padding: 2rem;">No livestock found</p>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Mannalon_App\resources\views\admin\livestock\index.blade.php ENDPATH**/ ?>