

<?php $__env->startSection('title', 'Edit Livestock'); ?>

<?php $__env->startSection('content'); ?>
<div class="card">
    <a href="<?php echo e(route('livestock.index')); ?>" style="color: #2ecc71; text-decoration: none;">← Back to Livestock</a>
    <h2 style="margin-top: 1rem;">Edit Livestock</h2>
</div>

<div style="max-width: 600px; margin: 0 auto;">
    <div class="card">
        <form method="POST" action="<?php echo e(route('livestock.update', $livestock->id)); ?>">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>

            <div class="form-group">
                <label for="type">Livestock Type *</label>
                <select id="type" name="type" required style="width: 100%; padding: 0.75rem; border: 1px solid #ddd; border-radius: 4px;">
                    <option value="Cattle" <?php echo e(old('type', $livestock->type) === 'Cattle' ? 'selected' : ''); ?>>Cattle</option>
                    <option value="Goats" <?php echo e(old('type', $livestock->type) === 'Goats' ? 'selected' : ''); ?>>Goats</option>
                    <option value="Sheep" <?php echo e(old('type', $livestock->type) === 'Sheep' ? 'selected' : ''); ?>>Sheep</option>
                    <option value="Poultry" <?php echo e(old('type', $livestock->type) === 'Poultry' ? 'selected' : ''); ?>>Poultry</option>
                    <option value="Pigs" <?php echo e(old('type', $livestock->type) === 'Pigs' ? 'selected' : ''); ?>>Pigs</option>
                    <option value="Horses" <?php echo e(old('type', $livestock->type) === 'Horses' ? 'selected' : ''); ?>>Horses</option>
                </select>
                <?php $__errorArgs = ['type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span style="color: #e74c3c;"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div class="form-group">
                <label for="count">Count *</label>
                <input type="number" id="count" name="count" min="1" required value="<?php echo e(old('count', $livestock->count)); ?>">
                <?php $__errorArgs = ['count'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span style="color: #e74c3c;"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div class="form-group">
                <label for="health_status">Health Status *</label>
                <select id="health_status" name="health_status" required style="width: 100%; padding: 0.75rem; border: 1px solid #ddd; border-radius: 4px;">
                    <option value="Excellent" <?php echo e(old('health_status', $livestock->health_status) === 'Excellent' ? 'selected' : ''); ?>>Excellent</option>
                    <option value="Good" <?php echo e(old('health_status', $livestock->health_status) === 'Good' ? 'selected' : ''); ?>>Good</option>
                    <option value="Fair" <?php echo e(old('health_status', $livestock->health_status) === 'Fair' ? 'selected' : ''); ?>>Fair</option>
                    <option value="Poor" <?php echo e(old('health_status', $livestock->health_status) === 'Poor' ? 'selected' : ''); ?>>Poor</option>
                </select>
                <?php $__errorArgs = ['health_status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span style="color: #e74c3c;"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div class="form-group">
                <label for="notes">Notes</label>
                <textarea id="notes" name="notes" rows="4"><?php echo e(old('notes', $livestock->notes)); ?></textarea>
            </div>

            <button type="submit" style="width: 100%;">Update Livestock</button>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Mannalon_App\resources\views\dashboard\livestock-edit.blade.php ENDPATH**/ ?>