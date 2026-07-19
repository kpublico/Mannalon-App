<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About MannalonApp - MannalonApp</title>
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
                <a href="<?php echo e(route('market-prices')); ?>" class="hover:text-emerald-100 transition">Market Prices</a>
                <a href="<?php echo e(route('about')); ?>" class="hover:text-emerald-100 transition font-bold">About</a>
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
    <div class="emerald-gradient text-white py-16">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <h1 class="text-5xl font-bold mb-4">About MannalonApp</h1>
            <p class="text-xl text-emerald-50">Empowering farmers in Cagayan Province with technology and knowledge</p>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-4xl mx-auto px-6 py-12">
        <!-- About Section -->
        <div class="bg-white rounded-lg shadow-sm p-8 mb-8">
            <h2 class="text-3xl font-bold text-gray-800 mb-4">What is MannalonApp?</h2>
            <p class="text-gray-700 mb-4">MannalonApp is a comprehensive digital platform designed to empower farmers and agricultural communities in Cagayan Province. Our mission is to bridge the gap between traditional farming practices and modern agricultural technology.</p>
            <p class="text-gray-700">By providing real-time information, government support programs, market insights, and expert guidance, MannalonApp helps farmers make informed decisions to improve productivity and profitability.</p>
        </div>

        <!-- Mission & Vision -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
            <div class="bg-white rounded-lg shadow-sm p-8">
                <h3 class="text-2xl font-bold text-gray-800 mb-4">🎯 Our Mission</h3>
                <p class="text-gray-700">To enhance agricultural productivity in Cagayan Province by providing farmers with accessible technology, expert information, and government support programs that promote sustainable and profitable farming practices.</p>
            </div>
            <div class="bg-white rounded-lg shadow-sm p-8">
                <h3 class="text-2xl font-bold text-gray-800 mb-4">🌟 Our Vision</h3>
                <p class="text-gray-700">A prosperous agricultural community in Cagayan Province where farmers have equal access to information, resources, and opportunities to succeed in modern agriculture.</p>
            </div>
        </div>

        <!-- Features -->
        <div class="bg-white rounded-lg shadow-sm p-8 mb-8">
            <h2 class="text-3xl font-bold text-gray-800 mb-6">Key Features</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="flex gap-4">
                    <span class="text-3xl">📱</span>
                    <div>
                        <h4 class="font-bold text-gray-800 mb-1">User-Friendly Dashboard</h4>
                        <p class="text-gray-600 text-sm">Manage your farm, track progress, and access resources in one place</p>
                    </div>
                </div>
                <div class="flex gap-4">
                    <span class="text-3xl">📊</span>
                    <div>
                        <h4 class="font-bold text-gray-800 mb-1">Real-Time Market Data</h4>
                        <p class="text-gray-600 text-sm">Track crop prices and market trends to make profitable decisions</p>
                    </div>
                </div>
                <div class="flex gap-4">
                    <span class="text-3xl">🌦️</span>
                    <div>
                        <h4 class="font-bold text-gray-800 mb-1">Weather Information</h4>
                        <p class="text-gray-600 text-sm">Get accurate forecasts and agricultural advisories</p>
                    </div>
                </div>
                <div class="flex gap-4">
                    <span class="text-3xl">📚</span>
                    <div>
                        <h4 class="font-bold text-gray-800 mb-1">Expert Guides</h4>
                        <p class="text-gray-600 text-sm">Access farming tips, best practices, and downloadable resources</p>
                    </div>
                </div>
                <div class="flex gap-4">
                    <span class="text-3xl">💰</span>
                    <div>
                        <h4 class="font-bold text-gray-800 mb-1">Government Programs</h4>
                        <p class="text-gray-600 text-sm">Learn about and apply for subsidies and support programs</p>
                    </div>
                </div>
                <div class="flex gap-4">
                    <span class="text-3xl">📢</span>
                    <div>
                        <h4 class="font-bold text-gray-800 mb-1">Latest Announcements</h4>
                        <p class="text-gray-600 text-sm">Stay updated with agricultural news and initiatives</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Contact Information -->
        <div class="bg-emerald-50 rounded-lg shadow-sm p-8 mb-8 border-l-4 border-emerald-600">
            <h2 class="text-3xl font-bold text-gray-800 mb-6">📞 Contact Information</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div>
                    <h4 class="font-bold text-gray-800 mb-3">Municipal Agriculture Office</h4>
                    <p class="text-gray-700 mb-2"><strong>Address:</strong> Municipal Hall, Buguey, Cagayan</p>
                    <p class="text-gray-700 mb-2"><strong>Phone:</strong> (078) 123-4567</p>
                    <p class="text-gray-700 mb-2"><strong>Email:</strong> agriculture@buguey.gov.ph</p>
                    <p class="text-gray-700"><strong>Office Hours:</strong> Monday-Friday, 8:00 AM - 5:00 PM</p>
                </div>
                <div>
                    <h4 class="font-bold text-gray-800 mb-3">Technical Support</h4>
                    <p class="text-gray-700 mb-2"><strong>Email:</strong> support@mannalonapp.com</p>
                    <p class="text-gray-700 mb-2"><strong>Phone:</strong> (078) 987-6543</p>
                    <p class="text-gray-700 mb-2"><strong>Response Time:</strong> Within 24 hours</p>
                    <p class="text-gray-700"><strong>Support Hours:</strong> Available 24/7 via email</p>
                </div>
            </div>
        </div>

        <!-- FAQ -->
        <div class="bg-white rounded-lg shadow-sm p-8">
            <h2 class="text-3xl font-bold text-gray-800 mb-6">❓ Frequently Asked Questions</h2>
            <div class="space-y-4">
                <details class="border-b pb-4">
                    <summary class="font-semibold text-gray-800 cursor-pointer">Is MannalonApp free to use?</summary>
                    <p class="text-gray-700 mt-2">Yes! MannalonApp is completely free for all farmers in Cagayan Province. We believe that access to agricultural information and resources should not be a barrier.</p>
                </details>
                <details class="border-b pb-4">
                    <summary class="font-semibold text-gray-800 cursor-pointer">How do I register as a farmer?</summary>
                    <p class="text-gray-700 mt-2">Simply click the "Register" button on our home page, fill in your information, and verify your account. Once verified by the agricultural office, you'll have full access to farmer features.</p>
                </details>
                <details class="border-b pb-4">
                    <summary class="font-semibold text-gray-800 cursor-pointer">Can I update my profile information?</summary>
                    <p class="text-gray-700 mt-2">Yes, you can update your personal information anytime. Go to your Profile page and use the update option. Password changes are available for security.</p>
                </details>
                <details class="border-b pb-4">
                    <summary class="font-semibold text-gray-800 cursor-pointer">How often is market price data updated?</summary>
                    <p class="text-gray-700 mt-2">Market prices are updated daily based on data from the Municipal Agriculture Office and local markets. Check back regularly for the latest information.</p>
                </details>
                <details>
                    <summary class="font-semibold text-gray-800 cursor-pointer">Can I download farming guides?</summary>
                    <p class="text-gray-700 mt-2">Yes! All farming guides are available for download in PDF format. You can access them offline and share them with other farmers.</p>
                </details>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-8 mt-12">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <p>&copy; 2026 MannalonApp. Empowering Agriculture in Cagayan Province.</p>
            <p class="text-gray-400 mt-2">A project by the Municipal Agriculture Office with support from local government units</p>
        </div>
    </footer>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\Mannalon_App\resources\views\about.blade.php ENDPATH**/ ?>