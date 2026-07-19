

<?php $__env->startSection('title', 'Add Crop'); ?>

<?php $__env->startSection('content'); ?>
<div class="card">
    <a href="<?php echo e(route('crops.index')); ?>" style="color: #2ecc71; text-decoration: none;">← Back to Crops</a>
    <h2 style="margin-top: 1rem;">Add New Crop</h2>
</div>

<div style="max-width: 600px; margin: 0 auto;">
    <div class="card">
        <form method="POST" action="<?php echo e(route('crops.store')); ?>">
            <?php echo csrf_field(); ?>

            <div class="form-group">
                <label for="name">Crop Name *</label>
                <input type="text" id="name" name="name" required value="<?php echo e(old('name')); ?>">
                <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span style="color: #e74c3c;"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div class="form-group">
                <label for="area">Area (hectares) *</label>
                <input type="number" id="area" name="area" step="0.01" required value="<?php echo e(old('area')); ?>">
                <?php $__errorArgs = ['area'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span style="color: #e74c3c;"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div class="form-group">
                <label for="planting_date">Planting Date *</label>
                <input type="date" id="planting_date" name="planting_date" required value="<?php echo e(old('planting_date')); ?>">
                <?php $__errorArgs = ['planting_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span style="color: #e74c3c;"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div class="form-group">
                <label for="expected_harvest_date">Expected Harvest Date *</label>
                <input type="date" id="expected_harvest_date" name="expected_harvest_date" required value="<?php echo e(old('expected_harvest_date')); ?>">
                <?php $__errorArgs = ['expected_harvest_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span style="color: #e74c3c;"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div class="form-group">
                <label for="status">Status *</label>
                <select id="status" name="status" required style="width: 100%; padding: 0.75rem; border: 1px solid #ddd; border-radius: 4px;">
                    <option value="">-- Select Status --</option>
                    <option value="Planting" <?php echo e(old('status') === 'Planting' ? 'selected' : ''); ?>>Planting</option>
                    <option value="Growing" <?php echo e(old('status') === 'Growing' ? 'selected' : ''); ?>>Growing</option>
                    <option value="Flowering" <?php echo e(old('status') === 'Flowering' ? 'selected' : ''); ?>>Flowering</option>
                    <option value="Ready for Harvest" <?php echo e(old('status') === 'Ready for Harvest' ? 'selected' : ''); ?>>Ready for Harvest</option>
                    <option value="Harvested" <?php echo e(old('status') === 'Harvested' ? 'selected' : ''); ?>>Harvested</option>
                </select>
                <?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span style="color: #e74c3c;"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea id="description" name="description" rows="4"><?php echo e(old('description')); ?></textarea>
            </div>

            <button type="submit" style="width: 100%;">Add Crop</button>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Mannalon_App\resources\views\dashboard\crops-create.blade.php ENDPATH**/ ?>