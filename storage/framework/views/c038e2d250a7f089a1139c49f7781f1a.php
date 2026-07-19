

<?php $__env->startSection('title', 'Crops Management'); ?>

<?php $__env->startSection('content'); ?>
<div class="card">
    <h2>🌾 My Crops</h2>
    <p>Manage and monitor all your crops</p>
</div>

<div class="card">
    <a href="<?php echo e(route('crops.create')); ?>" style="display: inline-block; background-color: #2ecc71; color: white; padding: 0.75rem 1.5rem; border-radius: 4px; text-decoration: none; margin-bottom: 1rem;">+ Add New Crop</a>
    
    <?php if(session('success')): ?>
        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
    <?php endif; ?>

    <?php if($crops->count() > 0): ?>
        <table>
            <thead>
                <tr>
                    <th>Crop Name</th>
                    <th>Area</th>
                    <th>Status</th>
                    <th>Planting Date</th>
                    <th>Expected Harvest</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $crops; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $crop): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($crop->name); ?></td>
                        <td><?php echo e($crop->area); ?></td>
                        <td><?php echo e($crop->status); ?></td>
                        <td><?php echo e($crop->planting_date->format('M d, Y')); ?></td>
                        <td><?php echo e($crop->expected_harvest_date->format('M d, Y')); ?></td>
                        <td>
                            <a href="<?php echo e(route('crops.edit', $crop->id)); ?>" style="color: #3498db; text-decoration: none;">Edit</a> |
                            <form method="POST" action="<?php echo e(route('crops.destroy', $crop->id)); ?>" style="display: inline;">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" onclick="return confirm('Are you sure?')" style="background: transparent; color: #e74c3c; border: none; cursor: pointer; text-decoration: underline;">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    <?php else: ?>
        <p style="text-align: center; padding: 2rem;">No crops added yet. <a href="<?php echo e(route('crops.create')); ?>" style="color: #2ecc71;">Add your first crop</a></p>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Mannalon_App\resources\views\dashboard\crops.blade.php ENDPATH**/ ?>