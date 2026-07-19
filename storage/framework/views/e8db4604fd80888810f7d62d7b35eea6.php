<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Announcements - MannalonApp</title>
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
                <a href="<?php echo e(route('announcements')); ?>" class="hover:text-emerald-100 transition font-bold">Announcements</a>
                <a href="<?php echo e(route('guides')); ?>" class="hover:text-emerald-100 transition">Guides</a>
                <a href="<?php echo e(route('weather')); ?>" class="hover:text-emerald-100 transition">Weather</a>
                <a href="<?php echo e(route('market-prices')); ?>" class="hover:text-emerald-100 transition">Market Prices</a>
                <a href="<?php echo e(route('about')); ?>" class="hover:text-emerald-100 transition">About</a>
                <?php if(auth()->guard()->check()): ?>
                    <div class="flex items-center gap-3">
                        <span class="text-emerald-50">Farmer Account</span>
                        <a href="<?php echo e(route('profile')); ?>" class="hover:text-emerald-100 transition bg-white/20 px-3 py-1 rounded-full flex items-center gap-2">
                            <span class="bg-white text-emerald-600 rounded-full w-8 h-8 flex items-center justify-center font-bold">
                                <?php echo e(strtoupper(substr(auth()->user()->name ?? 'F', 0, 1))); ?>

                            </span>
                            <?php echo e(auth()->user()->name ?? 'Farmer'); ?>

                        </a>
                    </div>
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
            <h1 class="text-4xl font-bold mb-2">📢 Announcements</h1>
            <p class="text-emerald-50">Stay updated with the latest news from the Municipal Agriculture Office</p>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-4xl mx-auto px-6 py-12">
        <!-- Filters -->
        <div class="mb-8 flex gap-4 flex-wrap">
            <input type="text" placeholder="Search announcements..." class="flex-1 px-4 py-2 border-2 border-gray-300 rounded-lg focus:outline-none focus:border-emerald-500">
            <select class="px-4 py-2 border-2 border-gray-300 rounded-lg focus:outline-none focus:border-emerald-500">
                <option>All Categories</option>
                <option>Program</option>
                <option>Weather Alert</option>
                <option>Training</option>
                <option>Subsidy</option>
            </select>
            <select class="px-4 py-2 border-2 border-gray-300 rounded-lg focus:outline-none focus:border-emerald-500">
                <option>Latest First</option>
                <option>Oldest First</option>
            </select>
        </div>

        <!-- Announcements List -->
        <div class="space-y-6">
            <!-- Announcement 1 -->
            <div class="bg-white p-6 rounded-lg shadow-sm border-l-4 border-emerald-500 hover:shadow-md transition">
                <div class="flex justify-between items-start mb-3">
                    <div>
                        <h3 class="text-xl font-bold text-gray-800">Fertilizer Subsidy Program Now Open</h3>
                        <p class="text-sm text-gray-500 mt-1">January 27, 2026 • Program</p>
                    </div>
                    <span class="bg-emerald-100 text-emerald-800 px-3 py-1 rounded-full text-sm font-semibold">Active</span>
                </div>
                <p class="text-gray-700 mb-4">The Municipal Agriculture Office is pleased to announce the opening of the Q1 2026 Fertilizer Subsidy Program. This initiative aims to support local farmers with affordable fertilizer inputs to improve crop productivity.</p>
                <div class="grid grid-cols-2 gap-4 bg-gray-50 p-4 rounded-lg mb-4">
                    <div>
                        <p class="text-sm font-semibold text-gray-600">Application Deadline</p>
                        <p class="text-gray-800">February 15, 2026</p>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-gray-600">Subsidy Amount</p>
                        <p class="text-gray-800">Up to ₱5,000 per farmer</p>
                    </div>
                </div>
                <p class="text-gray-700 mb-4">For more information and aLOCpplication procedures, visit the Municipal Agriculture Office or call (078) 123-4567.</p>
                <a href="#" class="text-emerald-600 font-semibold hover:underline">Read full details →</a>
            </div>

            <!-- Announcement 2 -->
            <div class="bg-white p-6 rounded-lg shadow-sm border-l-4 border-red-500 hover:shadow-md transition">
                <div class="flex justify-between items-start mb-3">
                    <div>
                        <h3 class="text-xl font-bold text-gray-800">⚠️ Weather Alert: Strong Winds Expected</h3>
                        <p class="text-sm text-gray-500 mt-1">January 26, 2026 • Weather Alert</p>
                    </div>
                    <span class="bg-red-100 text-red-800 px-3 py-1 rounded-full text-sm font-semibold">Urgent</span>
                </div>
                <p class="text-gray-700 mb-4">The Philippine Atmospheric, Geophysical and Astronomical Services Administration (PAGASA) has issued a weather advisory for strong winds in the region.</p>
                <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-4">
                    <p class="font-semibold text-yellow-800">⚡ Alert Details:</p>
                    <ul class="text-yellow-700 text-sm mt-2 space-y-1 ml-4">
                        <li>• Expected date: January 28-29, 2026</li>
                        <li>• Wind speed: 40-60 km/h</li>
                        <li>• Gusts up to: 80 km/h</li>
                        <li>• Affected area: All municipalities in Cagayan</li>
                    </ul>
                </div>
                <p class="text-gray-700 mb-2"><strong>Recommendations:</strong></p>
                <ul class="text-gray-700 text-sm space-y-1 ml-4">
                    <li>• Secure loose items and structures</li>
                    <li>• Harvest crops if ready</li>
                    <li>• Reinforce plant supports</li>
                    <li>• Prepare emergency equipment</li>
                </ul>
            </div>

            <!-- Announcement 3 -->
            <div class="bg-white p-6 rounded-lg shadow-sm border-l-4 border-blue-500 hover:shadow-md transition">
                <div class="flex justify-between items-start mb-3">
                    <div>
                        <h3 class="text-xl font-bold text-gray-800">Free Training Workshop: Sustainable Farming Practices</h3>
                        <p class="text-sm text-gray-500 mt-1">January 25, 2026 • Training</p>
                    </div>
                    <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm font-semibold">Upcoming</span>
                </div>
                <p class="text-gray-700 mb-4">Join us for a comprehensive workshop on sustainable farming practices designed to improve farm productivity while protecting our environment.</p>
                <div class="grid grid-cols-3 gap-4 bg-blue-50 p-4 rounded-lg mb-4 text-center">
                    <div>
                        <p class="text-sm font-semibold text-blue-600">Date</p>
                        <p class="text-blue-800">Feb 20, 2026</p>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-blue-600">Time</p>
                        <p class="text-blue-800">9:00 AM - 12:00 PM</p>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-blue-600">Location</p>
                        <p class="text-blue-800">Municipal Hall</p>
                    </div>
                </div>
                <p class="text-gray-700 text-sm mb-4"><strong>Topics covered:</strong> Organic farming, water conservation, crop rotation, and pest management.</p>
                <a href="#" class="inline-block px-4 py-2 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 transition">Register Now</a>
            </div>

            <!-- Announcement 4 -->
            <div class="bg-white p-6 rounded-lg shadow-sm border-l-4 border-green-500 hover:shadow-md transition">
                <div class="flex justify-between items-start mb-3">
                    <div>
                        <h3 class="text-xl font-bold text-gray-800">Equipment Rental Program Available</h3>
                        <p class="text-sm text-gray-500 mt-1">January 20, 2026 • Program</p>
                    </div>
                    <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-semibold">Active</span>
                </div>
                <p class="text-gray-700 mb-4">The Municipal Agriculture Office now offers affordable equipment rental services to help farmers access modern farming tools.</p>
                <p class="text-gray-700 text-sm"><strong>Available Equipment:</strong> Tractors, plows, harvesters, and more. Rental rates start at ₱500/day.</p>
            </div>
        </div>

        <!-- Pagination -->
        <div class="mt-12 flex justify-center gap-2">
            <button class="px-4 py-2 border-2 border-emerald-500 text-emerald-600 rounded-lg font-semibold">← Previous</button>
            <button class="px-4 py-2 bg-emerald-600 text-white rounded-lg font-semibold">1</button>
            <button class="px-4 py-2 border-2 border-gray-300 text-gray-600 rounded-lg">2</button>
            <button class="px-4 py-2 border-2 border-gray-300 text-gray-600 rounded-lg">3</button>
            <button class="px-4 py-2 border-2 border-emerald-500 text-emerald-600 rounded-lg font-semibold">Next →</button>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-8 mt-12">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <p>&copy; 2026 MannalonApp. Your agricultural partner in Cagayan Province.</p>
        </div>
    </footer>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\Mannalon_App\resources\views\announcements.blade.php ENDPATH**/ ?>