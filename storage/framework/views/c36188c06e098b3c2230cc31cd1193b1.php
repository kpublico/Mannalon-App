<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weather Information - MannalonApp</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            background: #f3f4f6;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .emerald-gradient {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="emerald-gradient text-white px-6 py-4 shadow-md sticky top-0 z-50">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <h1 class="text-2xl font-bold">🌾 MannalonApp</h1>
            <div class="flex items-center gap-6">
                <a href="<?php echo e(route('home')); ?>" class="hover:text-emerald-100 transition">Home</a>
                <a href="<?php echo e(route('announcements')); ?>" class="hover:text-emerald-100 transition">Announcements</a>
                <a href="<?php echo e(route('guides')); ?>" class="hover:text-emerald-100 transition">Guides</a>
                <a href="<?php echo e(route('weather')); ?>" class="hover:text-emerald-100 transition font-bold">Weather</a>
                <a href="<?php echo e(route('market-prices')); ?>" class="hover:text-emerald-100 transition">Market Prices</a>
                <a href="<?php echo e(route('about')); ?>" class="hover:text-emerald-100 transition">About</a>
                <?php if(auth()->guard()->check()): ?>
                    <a href="<?php echo e(route('profile')); ?>" class="hover:text-emerald-100 transition">👤 Profile</a>
                    <form action="<?php echo e(route('logout')); ?>" method="POST" class="inline">
                        <?php echo csrf_field(); ?>
                        <button type="submit" class="hover:text-emerald-100 transition">Logout</button>
                    </form>
                <?php else: ?>
                    <a href="<?php echo e(route('login')); ?>" class="hover:text-emerald-100 transition">Login</a>
                <?php endif; ?>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="emerald-gradient text-white py-12">
        <div class="max-w-7xl mx-auto px-6">
            <h1 class="text-4xl font-bold mb-2">🌦️ Weather Information</h1>
            <p class="text-emerald-50">Current weather conditions and forecasts for Cagayan Province</p>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-6 py-12">
        <!-- Current Weather -->
        <div class="bg-white rounded-lg shadow-sm p-8 mb-8">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Current Weather Conditions</h2>
            <div class="grid grid-cols-1 md:grid-cols-5 gap-6">
                <div class="bg-white border-2 border-emerald-200 p-6 rounded-lg text-center shadow-sm">
                    <p class="text-5xl mb-2">☀️</p>
                    <p class="text-sm text-gray-600 mb-2">Temperature</p>
                    <p class="text-3xl font-bold text-emerald-600">28°C</p>
                    <p class="text-xs text-gray-500 mt-2">Feels like 31°C</p>
                </div>

                <div class="bg-white border-2 border-emerald-200 p-6 rounded-lg text-center shadow-sm">
                    <p class="text-5xl mb-2">💧</p>
                    <p class="text-sm text-gray-600 mb-2">Humidity</p>
                    <p class="text-3xl font-bold text-emerald-600">65%</p>
                    <p class="text-xs text-gray-500 mt-2">Moderate</p>
                </div>

                <div class="bg-white border-2 border-emerald-200 p-6 rounded-lg text-center shadow-sm">
                    <p class="text-5xl mb-2">💨</p>
                    <p class="text-sm text-gray-600 mb-2">Wind Speed</p>
                    <p class="text-3xl font-bold text-emerald-600">12 km/h</p>
                    <p class="text-xs text-gray-500 mt-2">NE Direction</p>
                </div>

                <div class="bg-white border-2 border-emerald-200 p-6 rounded-lg text-center shadow-sm">
                    <p class="text-5xl mb-2">🌧️</p>
                    <p class="text-sm text-gray-600 mb-2">Rainfall</p>
                    <p class="text-3xl font-bold text-emerald-600">5 mm</p>
                    <p class="text-xs text-gray-500 mt-2">Light rain</p>
                </div>

                <div class="bg-white border-2 border-emerald-200 p-6 rounded-lg text-center shadow-sm">
                    <p class="text-5xl mb-2">🌊</p>
                    <p class="text-sm text-gray-600 mb-2">Pressure</p>
                    <p class="text-3xl font-bold text-emerald-600">1013 mb</p>
                    <p class="text-xs text-gray-500 mt-2">Normal</p>
                </div>
            </div>
        </div>

        <!-- Advisories -->
        <div class="bg-emerald-50 border-l-4 border-emerald-600 p-6 rounded-lg mb-8">
            <p class="font-bold text-emerald-900 text-lg mb-3">⚠️ Weather Advisory</p>
            <p class="text-emerald-800 mb-2"><strong>Strong winds expected:</strong> January 28-29, with wind speeds of 40-60 km/h and gusts up to 80 km/h.</p>
            <p class="text-emerald-800"><strong>Recommendation:</strong> Secure your crops and farm equipment. Harvest ready crops if possible.</p>
        </div>

        <!-- 5-Day Forecast -->
        <div class="bg-white rounded-lg shadow-sm p-8">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">5-Day Forecast</h2>
            <div class="grid grid-cols-1 md:grid-cols-5 gap-4">
                <!-- Day 1 -->
                <div class="bg-white p-4 rounded-lg border-t-4 border-emerald-600 shadow-sm">
                    <p class="font-semibold text-gray-900">Today</p>
                    <p class="text-sm text-gray-600">Jan 27</p>
                    <p class="text-3xl my-3">🌧️</p>
                    <p class="text-sm text-gray-900"><strong>High:</strong> 30°C</p>
                    <p class="text-sm text-gray-900"><strong>Low:</strong> 24°C</p>
                    <p class="text-sm text-gray-700 mt-2">Light rain, 60% chance</p>
                </div>

                <!-- Day 2 -->
                <div class="bg-white p-4 rounded-lg border-t-4 border-emerald-600 shadow-sm">
                    <p class="font-semibold text-gray-900">Tomorrow</p>
                    <p class="text-sm text-gray-600">Jan 28</p>
                    <p class="text-3xl my-3">💨</p>
                    <p class="text-sm text-gray-900"><strong>High:</strong> 28°C</p>
                    <p class="text-sm text-gray-900"><strong>Low:</strong> 22°C</p>
                    <p class="text-sm text-gray-700 mt-2">Strong winds, gusty</p>
                </div>

                <!-- Day 3 -->
                <div class="bg-white p-4 rounded-lg border-t-4 border-emerald-600 shadow-sm">
                    <p class="font-semibold text-gray-900">Day 3</p>
                    <p class="text-sm text-gray-600">Jan 29</p>
                    <p class="text-3xl my-3">⛈️</p>
                    <p class="text-sm text-gray-900"><strong>High:</strong> 26°C</p>
                    <p class="text-sm text-gray-900"><strong>Low:</strong> 20°C</p>
                    <p class="text-sm text-gray-700 mt-2">Thunderstorms likely</p>
                </div>

                <!-- Day 4 -->
                <div class="bg-white p-4 rounded-lg border-t-4 border-emerald-600 shadow-sm">
                    <p class="font-semibold text-gray-900">Day 4</p>
                    <p class="text-sm text-gray-600">Jan 30</p>
                    <p class="text-3xl my-3">⛅</p>
                    <p class="text-sm text-gray-900"><strong>High:</strong> 29°C</p>
                    <p class="text-sm text-gray-900"><strong>Low:</strong> 23°C</p>
                    <p class="text-sm text-gray-700 mt-2">Partly cloudy, clearing</p>
                </div>

                <!-- Day 5 -->
                <div class="bg-white p-4 rounded-lg border-t-4 border-emerald-600 shadow-sm">
                    <p class="font-semibold text-gray-900">Day 5</p>
                    <p class="text-sm text-gray-600">Jan 31</p>
                    <p class="text-3xl my-3">☀️</p>
                    <p class="text-sm text-gray-900"><strong>High:</strong> 31°C</p>
                    <p class="text-sm text-gray-900"><strong>Low:</strong> 25°C</p>
                    <p class="text-sm text-gray-700 mt-2">Sunny, good conditions</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-8 mt-12">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <p>&copy; 2026 MannalonApp. Weather data provided by PAGASA.</p>
        </div>
    </footer>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\Mannalon_App\resources\views\weather-info.blade.php ENDPATH**/ ?>