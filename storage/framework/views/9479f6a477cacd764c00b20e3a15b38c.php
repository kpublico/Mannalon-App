

<?php $__env->startSection('title', 'Weather Information'); ?>

<?php $__env->startSection('content'); ?>
<div class="card">
    <h2>🌤️ Weather Information</h2>
    <p>Current weather conditions and forecast for your farming area.</p>
</div>

<div class="stats-grid">
    <div class="stat-box">
        <h3><?php echo e($temperature); ?>°C</h3>
        <p>Temperature</p>
    </div>
    <div class="stat-box">
        <h3><?php echo e($humidity); ?>%</h3>
        <p>Humidity</p>
    </div>
    <div class="stat-box">
        <h3><?php echo e($rainfall); ?>mm</h3>
        <p>Rainfall</p>
    </div>
    <div class="stat-box">
        <h3><?php echo e($windSpeed); ?>km/h</h3>
        <p>Wind Speed</p>
    </div>
</div>

<div class="card">
    <h2>Forecast</h2>
    <p><strong><?php echo e($forecast); ?></strong></p>
    <p>This is a sample forecast. Integrate with a weather API for real-time data.</p>
</div>

<div class="card">
    <h2>Weather Alerts</h2>
    <p>No active weather alerts for your area.</p>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Mannalon_App\resources\views\dashboard\weather.blade.php ENDPATH**/ ?>