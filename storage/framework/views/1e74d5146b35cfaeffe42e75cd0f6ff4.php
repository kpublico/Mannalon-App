

<?php $__env->startSection('title', 'Livestock Management'); ?>

<?php $__env->startSection('content'); ?>
<div class="card">
    <h2>🐄 My Livestock</h2>
    <p>Manage and monitor all your livestock</p>
</div>

<div class="card">
    <a href="<?php echo e(route('livestock.create')); ?>" style="display: inline-block; background-color: #2ecc71; color: white; padding: 0.75rem 1.5rem; border-radius: 4px; text-decoration: none; margin-bottom: 1rem;">+ Add Livestock</a>
    
    <?php if(session('success')): ?>
        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
    <?php endif; ?>

    <?php if($livestock->count() > 0): ?>
        <table>
            <thead>
                <tr>
                    <th>Type</th>
                    <th>Count</th>
                    <th>Health Status</th>
                    <th>Last Checkup</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $livestock; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $animal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($animal->type); ?></td>
                        <td><?php echo e($animal->count); ?></td>
                        <td><span style="background-color: #d4edda; color: #155724; padding: 0.5rem;"><?php echo e($animal->health_status); ?></span></td>
                        <td><?php echo e($animal->last_checkup ? $animal->last_checkup->format('M d, Y') : 'N/A'); ?></td>
                        <td>
                            <a href="<?php echo e(route('livestock.edit', $animal->id)); ?>" style="color: #3498db; text-decoration: none;">Edit</a> |
                            <form method="POST" action="<?php echo e(route('livestock.destroy', $animal->id)); ?>" style="display: inline;">
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
        <p style="text-align: center; padding: 2rem;">No livestock added yet. <a href="<?php echo e(route('livestock.create')); ?>" style="color: #2ecc71;">Add your first livestock</a></p>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Mannalon_App\resources\views\dashboard\livestock.blade.php ENDPATH**/ ?>