<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Market Prices - MannalonApp</title>
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
                <a href="<?php echo e(route('weather')); ?>" class="hover:text-emerald-100 transition">Weather</a>
                <a href="<?php echo e(route('market-prices')); ?>" class="hover:text-emerald-100 transition font-bold">Market Prices</a>
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
            <h1 class="text-4xl font-bold mb-2">💰 Market Prices</h1>
            <p class="text-emerald-50">Track crop prices and compare with previous periods</p>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-6 py-12">
        <!-- Price Comparison Toggle -->
        <div class="mb-8 flex gap-4">
            <button class="px-6 py-2 bg-emerald-600 text-white rounded-lg font-semibold hover:bg-emerald-700 transition">Today vs Previous</button>
            <button class="px-6 py-2 border-2 border-gray-300 text-gray-700 rounded-lg hover:border-emerald-600 transition">Weekly Trend</button>
            <button class="px-6 py-2 border-2 border-gray-300 text-gray-700 rounded-lg hover:border-emerald-600 transition">Monthly Trend</button>
        </div>

        <!-- Price Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Rice -->
            <div class="bg-white p-6 rounded-lg shadow-sm">
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <p class="text-3xl mb-1">🌾</p>
                        <h3 class="text-xl font-bold text-gray-800">Rice</h3>
                        <p class="text-sm text-gray-600">Per kilogram</p>
                    </div>
                    <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-semibold">↑ +2.5%</span>
                </div>
                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div class="bg-emerald-50 p-4 rounded-lg">
                        <p class="text-sm text-gray-600 mb-1">Today</p>
                        <p class="text-2xl font-bold text-emerald-600">₱45.50</p>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <p class="text-sm text-gray-600 mb-1">Yesterday</p>
                        <p class="text-2xl font-bold text-gray-600">₱44.38</p>
                    </div>
                </div>
                <p class="text-sm text-gray-600"><strong>Change:</strong> +₱1.12 | <strong>Trend:</strong> Upward</p>
            </div>

            <!-- Corn -->
            <div class="bg-white p-6 rounded-lg shadow-sm">
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <p class="text-3xl mb-1">🌽</p>
                        <h3 class="text-xl font-bold text-gray-800">Corn</h3>
                        <p class="text-sm text-gray-600">Per kilogram</p>
                    </div>
                    <span class="bg-gray-100 text-gray-800 px-3 py-1 rounded-full text-sm font-semibold">→ Stable</span>
                </div>
                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div class="bg-emerald-50 p-4 rounded-lg">
                        <p class="text-sm text-gray-600 mb-1">Today</p>
                        <p class="text-2xl font-bold text-emerald-600">₱38.00</p>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <p class="text-sm text-gray-600 mb-1">Yesterday</p>
                        <p class="text-2xl font-bold text-gray-600">₱38.00</p>
                    </div>
                </div>
                <p class="text-sm text-gray-600"><strong>Change:</strong> ₱0.00 | <strong>Trend:</strong> Stable</p>
            </div>

            <!-- Vegetables Mix -->
            <div class="bg-white p-6 rounded-lg shadow-sm">
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <p class="text-3xl mb-1">🥬</p>
                        <h3 class="text-xl font-bold text-gray-800">Vegetable Mix</h3>
                        <p class="text-sm text-gray-600">Per kilogram</p>
                    </div>
                    <span class="bg-red-100 text-red-800 px-3 py-1 rounded-full text-sm font-semibold">↓ -1.2%</span>
                </div>
                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div class="bg-emerald-50 p-4 rounded-lg">
                        <p class="text-sm text-gray-600 mb-1">Today</p>
                        <p class="text-2xl font-bold text-emerald-600">₱52.00</p>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <p class="text-sm text-gray-600 mb-1">Yesterday</p>
                        <p class="text-2xl font-bold text-gray-600">₱52.64</p>
                    </div>
                </div>
                <p class="text-sm text-gray-600"><strong>Change:</strong> -₱0.64 | <strong>Trend:</strong> Downward</p>
            </div>

            <!-- Sweet Potato -->
            <div class="bg-white p-6 rounded-lg shadow-sm">
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <p class="text-3xl mb-1">🍠</p>
                        <h3 class="text-xl font-bold text-gray-800">Sweet Potato</h3>
                        <p class="text-sm text-gray-600">Per kilogram</p>
                    </div>
                    <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-semibold">↑ +1.8%</span>
                </div>
                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div class="bg-emerald-50 p-4 rounded-lg">
                        <p class="text-sm text-gray-600 mb-1">Today</p>
                        <p class="text-2xl font-bold text-emerald-600">₱48.50</p>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <p class="text-sm text-gray-600 mb-1">Yesterday</p>
                        <p class="text-2xl font-bold text-gray-600">₱47.65</p>
                    </div>
                </div>
                <p class="text-sm text-gray-600"><strong>Change:</strong> +₱0.85 | <strong>Trend:</strong> Upward</p>
            </div>

            <!-- Onions -->
            <div class="bg-white p-6 rounded-lg shadow-sm">
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <p class="text-3xl mb-1">🧅</p>
                        <h3 class="text-xl font-bold text-gray-800">Onions</h3>
                        <p class="text-sm text-gray-600">Per kilogram</p>
                    </div>
                    <span class="bg-red-100 text-red-800 px-3 py-1 rounded-full text-sm font-semibold">↓ -3.1%</span>
                </div>
                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div class="bg-emerald-50 p-4 rounded-lg">
                        <p class="text-sm text-gray-600 mb-1">Today</p>
                        <p class="text-2xl font-bold text-emerald-600">₱35.20</p>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <p class="text-sm text-gray-600 mb-1">Yesterday</p>
                        <p class="text-2xl font-bold text-gray-600">₱36.34</p>
                    </div>
                </div>
                <p class="text-sm text-gray-600"><strong>Change:</strong> -₱1.14 | <strong>Trend:</strong> Downward</p>
            </div>

            <!-- Tomatoes -->
            <div class="bg-white p-6 rounded-lg shadow-sm">
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <p class="text-3xl mb-1">🍅</p>
                        <h3 class="text-xl font-bold text-gray-800">Tomatoes</h3>
                        <p class="text-sm text-gray-600">Per kilogram</p>
                    </div>
                    <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-semibold">↑ +5.2%</span>
                </div>
                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div class="bg-emerald-50 p-4 rounded-lg">
                        <p class="text-sm text-gray-600 mb-1">Today</p>
                        <p class="text-2xl font-bold text-emerald-600">₱58.75</p>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <p class="text-sm text-gray-600 mb-1">Yesterday</p>
                        <p class="text-2xl font-bold text-gray-600">₱55.88</p>
                    </div>
                </div>
                <p class="text-sm text-gray-600"><strong>Change:</strong> +₱2.87 | <strong>Trend:</strong> Upward</p>
            </div>
        </div>

        <!-- Disclaimer -->
        <div class="bg-blue-50 border-l-4 border-blue-400 p-4 rounded-lg mt-8">
            <p class="text-blue-800 text-sm"><strong>Note:</strong> Prices shown are average market prices for Cagayan Province. Actual prices may vary by municipality and market. Data updated daily.</p>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-8 mt-12">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <p>&copy; 2026 MannalonApp. Market price data for informational purposes.</p>
        </div>
    </footer>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\Mannalon_App\resources\views\market-prices-info.blade.php ENDPATH**/ ?>