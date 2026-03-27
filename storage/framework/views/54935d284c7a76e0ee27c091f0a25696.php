

<?php $__env->startSection('title', 'Weather Information'); ?>
<?php $__env->startSection('page-title', 'Weather Information'); ?>
<?php $__env->startSection('page-subtitle', '7-day forecast and farming advisories'); ?>

<?php $__env->startSection('content'); ?>
<div class="space-y-6">
    <!-- Current Weather -->
    <div class="bg-gradient-to-r from-white to-gray-50 rounded-xl shadow-lg p-8 text-gray-800 border-l-4 border-emerald-600">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
            <div>
                <p class="text-gray-600 mb-2">📍 Tuguegarao City, Cagayan</p>
                <h2 class="text-5xl font-bold mb-4 text-gray-900">28°C</h2>
                <p class="text-2xl text-gray-700 mb-4">⛅ Partly Cloudy</p>
                <div class="grid grid-cols-2 gap-4 text-sm">
                    <div>
                        <p class="text-gray-600">Humidity</p>
                        <p class="font-semibold text-lg text-gray-900">65%</p>
                    </div>
                    <div>
                        <p class="text-gray-600">Wind Speed</p>
                        <p class="font-semibold text-lg text-gray-900">12 km/h</p>
                    </div>
                    <div>
                        <p class="text-gray-600">Chance of Rain</p>
                        <p class="font-semibold text-lg text-gray-900">30%</p>
                    </div>
                    <div>
                        <p class="text-gray-600">UV Index</p>
                        <p class="font-semibold text-lg text-gray-900">High (7)</p>
                    </div>
                </div>
            </div>
            <div class="text-center">
                <div class="text-9xl mb-4">⛅</div>
                <p class="text-gray-600">Last updated: <?php echo e(date('F d, Y h:i A')); ?></p>
            </div>
        </div>
    </div>

    <!-- Weather Advisories -->
    <div class="bg-white rounded-xl shadow-md p-6">
        <h3 class="text-xl font-bold text-gray-800 mb-4">⚠️ Farming Advisories</h3>
        <div class="space-y-3">
            <?php $__empty_1 = true; $__currentLoopData = $weatherAnnouncements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $announcement): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <?php
                    $boxClass = 'bg-blue-50 border-blue-500';
                    $iconClass = 'fas fa-info-circle text-blue-600';
                    $titleClass = 'text-blue-800';
                    $textClass = 'text-blue-700';

                    if ($announcement->category === 'Alert') {
                        $boxClass = 'bg-amber-50 border-amber-500';
                        $iconClass = 'fas fa-exclamation-triangle text-amber-600';
                        $titleClass = 'text-amber-800';
                        $textClass = 'text-amber-700';
                    }
                ?>
                <div class="<?php echo e($boxClass); ?> border-l-4 p-4 rounded-r-lg">
                    <div class="flex items-start gap-3">
                        <i class="<?php echo e($iconClass); ?> text-xl mt-1"></i>
                        <div>
                            <h4 class="font-semibold <?php echo e($titleClass); ?>"><?php echo e($announcement->title); ?></h4>
                            <p class="text-sm <?php echo e($textClass); ?> whitespace-pre-line"><?php echo e($announcement->content); ?></p>
                            <p class="text-xs mt-2 <?php echo e($textClass); ?>">Posted <?php echo e($announcement->created_at->format('F d, Y')); ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="bg-gray-50 border-l-4 border-gray-300 p-4 rounded-r-lg text-gray-600">
                    No weather advisories posted by admin yet.
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- 7-Day Forecast -->
    <div class="bg-white rounded-xl shadow-md p-6">
        <h3 class="text-xl font-bold text-gray-800 mb-6">📅 7-Day Detailed Forecast</h3>
        <div class="grid grid-cols-1 md:grid-cols-7 gap-4">
            <?php
                $forecast = [
                    ['day' => 'Monday', 'date' => 'Jan 28', 'icon' => '☀️', 'high' => 30, 'low' => 24, 'rain' => 10, 'desc' => 'Sunny'],
                    ['day' => 'Tuesday', 'date' => 'Jan 29', 'icon' => '⛅', 'high' => 29, 'low' => 23, 'rain' => 20, 'desc' => 'Partly Cloudy'],
                    ['day' => 'Wednesday', 'date' => 'Jan 30', 'icon' => '🌧️', 'high' => 27, 'low' => 22, 'rain' => 80, 'desc' => 'Rainy'],
                    ['day' => 'Thursday', 'date' => 'Jan 31', 'icon' => '⛈️', 'high' => 26, 'low' => 21, 'rain' => 90, 'desc' => 'Thunderstorms'],
                    ['day' => 'Friday', 'date' => 'Feb 01', 'icon' => '☀️', 'high' => 28, 'low' => 23, 'rain' => 15, 'desc' => 'Sunny'],
                    ['day' => 'Saturday', 'date' => 'Feb 02', 'icon' => '☀️', 'high' => 30, 'low' => 24, 'rain' => 5, 'desc' => 'Clear Sky'],
                    ['day' => 'Sunday', 'date' => 'Feb 03', 'icon' => '⛅', 'high' => 29, 'low' => 23, 'rain' => 25, 'desc' => 'Partly Cloudy'],
                ];
            ?>

            <?php $__currentLoopData = $forecast; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $day): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="bg-gray-50 rounded-lg p-4 text-center hover:bg-gray-100 transition border border-gray-200">
                <p class="font-semibold text-gray-800 mb-1"><?php echo e($day['day']); ?></p>
                <p class="text-xs text-gray-500 mb-3"><?php echo e($day['date']); ?></p>
                <div class="text-5xl mb-3"><?php echo e($day['icon']); ?></div>
                <p class="text-sm font-semibold text-gray-700 mb-2"><?php echo e($day['desc']); ?></p>
                <div class="flex justify-center gap-2 text-sm mb-2">
                    <span class="text-red-600 font-bold"><?php echo e($day['high']); ?>°</span>
                    <span class="text-gray-400">/</span>
                    <span class="text-blue-600 font-bold"><?php echo e($day['low']); ?>°</span>
                </div>
                <p class="text-xs text-blue-600">💧 <?php echo e($day['rain']); ?>% rain</p>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>

    <!-- Weather Tips -->
    <div class="bg-gradient-to-r from-emerald-600 to-emerald-800 rounded-xl p-6 text-white">
        <h3 class="text-xl font-bold mb-4">💡 Weather-Based Farming Tips</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="flex gap-3">
                <i class="fas fa-sun text-2xl text-yellow-300"></i>
                <div>
                    <h4 class="font-semibold mb-1">Sunny Days</h4>
                    <p class="text-sm text-emerald-100">Perfect for harvesting, drying crops, and applying pesticides.</p>
                </div>
            </div>
            <div class="flex gap-3">
                <i class="fas fa-cloud-rain text-2xl text-blue-300"></i>
                <div>
                    <h4 class="font-semibold mb-1">Rainy Days</h4>
                    <p class="text-sm text-emerald-100">Check drainage systems, avoid heavy machinery in fields.</p>
                </div>
            </div>
            <div class="flex gap-3">
                <i class="fas fa-wind text-2xl text-gray-300"></i>
                <div>
                    <h4 class="font-semibold mb-1">Windy Days</h4>
                    <p class="text-sm text-emerald-100">Avoid spraying pesticides, secure greenhouse structures.</p>
                </div>
            </div>
            <div class="flex gap-3">
                <i class="fas fa-temperature-high text-2xl text-red-300"></i>
                <div>
                    <h4 class="font-semibold mb-1">Hot Days</h4>
                    <p class="text-sm text-emerald-100">Increase irrigation frequency, provide shade for young plants.</p>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.farmer-dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Mannalon_App\resources\views/farmer/weather.blade.php ENDPATH**/ ?>