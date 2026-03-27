<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - MannalonApp</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
                <a href="{{ route('home') }}" class="hover:text-emerald-100 transition">Home</a>
                <a href="{{ route('announcements') }}" class="hover:text-emerald-100 transition">Announcements</a>
                <a href="{{ route('guides') }}" class="hover:text-emerald-100 transition">Guides</a>
                <a href="{{ route('weather.public') }}" class="hover:text-emerald-100 transition">Weather</a>
                <a href="{{ route('market-prices.public') }}" class="hover:text-emerald-100 transition">Market Prices</a>
                <a href="{{ route('about') }}" class="hover:text-emerald-100 transition">About</a>
                @auth
                    <a href="{{ route('profile') }}" class="hover:text-emerald-100 transition">👤 Profile</a>
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="hover:text-emerald-100 transition">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="hover:text-emerald-100 transition">Login</a>
                    <a href="{{ route('register') }}" class="bg-white text-emerald-600 px-4 py-2 rounded-lg font-semibold hover:bg-emerald-50 transition">Register</a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="emerald-gradient text-white py-12">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <h1 class="text-5xl font-bold mb-4">Welcome to MannalonApp</h1>
            <p class="text-xl text-emerald-50">Your comprehensive platform for modern agriculture in Cagayan Province</p>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-6 py-12">
        <!-- Quick Stats -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-12">
            <div class="bg-white p-6 rounded-lg shadow-sm">
                <p class="text-4xl font-bold text-emerald-600 mb-2">{{ $totalFarmers ?? 0 }}</p>
                <p class="text-gray-600">Registered Farmers</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-sm">
                <p class="text-4xl font-bold text-blue-600 mb-2">{{ $municipalities ?? 15 }}</p>
                <p class="text-gray-600">Municipalities</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-sm">
                <p class="text-4xl font-bold text-yellow-600 mb-2">{{ $crops ?? 0 }}</p>
                <p class="text-gray-600">Crops Tracked</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-sm">
                <p class="text-4xl font-bold text-green-600 mb-2">{{ $activePrograms ?? 8 }}</p>
                <p class="text-gray-600">Active Programs</p>
            </div>
        </div>

        <!-- Latest Announcements Section -->
        <div class="mb-12">
            <h2 class="text-3xl font-bold text-gray-800 mb-6">📢 Latest Announcements</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Announcement 1 -->
                <div class="bg-white p-6 rounded-lg shadow-sm border-l-4 border-emerald-500 hover:shadow-md transition">
                    <p class="text-sm text-gray-500 mb-2">January 27, 2026</p>
                    <h3 class="text-lg font-semibold text-gray-800 mb-3">Fertilizer Subsidy Program Open</h3>
                    <p class="text-gray-600 text-sm mb-4">Applications now open for Q1 2026 fertilizer assistance. Deadline: February 15, 2026.</p>
                    <a href="{{ route('announcements') }}" class="text-emerald-600 font-semibold text-sm hover:underline">Read more →</a>
                </div>

                <!-- Announcement 2 -->
                <div class="bg-white p-6 rounded-lg shadow-sm border-l-4 border-red-500 hover:shadow-md transition">
                    <p class="text-sm text-gray-500 mb-2">January 26, 2026</p>
                    <h3 class="text-lg font-semibold text-gray-800 mb-3">⚠️ Weather Alert: Strong Winds</h3>
                    <p class="text-gray-600 text-sm mb-4">Department warning of strong winds on January 28-29. Secure your crops accordingly.</p>
                    <a href="{{ route('announcements') }}" class="text-emerald-600 font-semibold text-sm hover:underline">Read more →</a>
                </div>

                <!-- Announcement 3 -->
                <div class="bg-white p-6 rounded-lg shadow-sm border-l-4 border-blue-500 hover:shadow-md transition">
                    <p class="text-sm text-gray-500 mb-2">January 25, 2026</p>
                    <h3 class="text-lg font-semibold text-gray-800 mb-3">Training Workshop: Sustainable Farming</h3>
                    <p class="text-gray-600 text-sm mb-4">Free workshop on sustainable farming practices. February 20, 2026 at the Municipal Hall.</p>
                    <a href="{{ route('announcements') }}" class="text-emerald-600 font-semibold text-sm hover:underline">Read more →</a>
                </div>
            </div>
            <div class="text-center mt-6">
                <a href="{{ route('announcements') }}" class="inline-block px-6 py-2 bg-emerald-600 text-white rounded-lg font-semibold hover:bg-emerald-700 transition">View All Announcements</a>
            </div>
        </div>

        <!-- Weather Summary Section -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-12">
            <!-- Weather Card -->
            <div class="bg-white p-8 rounded-lg shadow-sm">
                <h2 class="text-2xl font-bold text-gray-800 mb-6">🌦️ Weather Summary</h2>
                <div class="grid grid-cols-2 gap-4">
                    <div class="bg-blue-50 p-4 rounded-lg">
                        <p class="text-sm text-gray-600 mb-1">Temperature</p>
                        <p class="text-3xl font-bold text-blue-600">28°C</p>
                    </div>
                    <div class="bg-blue-50 p-4 rounded-lg">
                        <p class="text-sm text-gray-600 mb-1">Humidity</p>
                        <p class="text-3xl font-bold text-blue-600">65%</p>
                    </div>
                    <div class="bg-blue-50 p-4 rounded-lg">
                        <p class="text-sm text-gray-600 mb-1">Wind Speed</p>
                        <p class="text-3xl font-bold text-blue-600">12 km/h</p>
                    </div>
                    <div class="bg-blue-50 p-4 rounded-lg">
                        <p class="text-sm text-gray-600 mb-1">Rainfall</p>
                        <p class="text-3xl font-bold text-blue-600">5 mm</p>
                    </div>
                </div>
                <p class="mt-6 p-4 bg-yellow-50 border border-yellow-200 rounded-lg text-yellow-800">
                    <strong>⚠️ Advisory:</strong> Strong winds expected tomorrow. Secure loose items on your farm.
                </p>
                <a href="{{ route('weather.public') }}" class="inline-block mt-4 text-emerald-600 font-semibold hover:underline">View Detailed Weather →</a>
            </div>

            <!-- Market Prices Summary -->
            <div class="bg-white p-8 rounded-lg shadow-sm">
                <h2 class="text-2xl font-bold text-gray-800 mb-6">💰 Market Prices</h2>
                <div class="space-y-4">
                    <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
                        <span class="font-semibold text-gray-800">Rice (per kg)</span>
                        <div class="text-right">
                            <p class="text-lg font-bold text-emerald-600">₱45.50</p>
                            <p class="text-sm text-red-600">↑ +2.5%</p>
                        </div>
                    </div>
                    <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
                        <span class="font-semibold text-gray-800">Corn (per kg)</span>
                        <div class="text-right">
                            <p class="text-lg font-bold text-emerald-600">₱38.00</p>
                            <p class="text-sm text-gray-600">→ Stable</p>
                        </div>
                    </div>
                    <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
                        <span class="font-semibold text-gray-800">Vegetable Mix (per kg)</span>
                        <div class="text-right">
                            <p class="text-lg font-bold text-emerald-600">₱52.00</p>
                            <p class="text-sm text-green-600">↓ -1.2%</p>
                        </div>
                    </div>
                </div>
                <a href="{{ route('market-prices.public') }}" class="inline-block mt-4 text-emerald-600 font-semibold hover:underline">View All Prices →</a>
            </div>
        </div>

        <!-- Features Grid -->
        <div class="bg-white rounded-lg shadow-sm p-8 mb-12">
            <h2 class="text-2xl font-bold text-gray-800 mb-8">📚 Quick Links</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <a href="{{ route('guides') }}" class="p-6 border-2 border-gray-200 rounded-lg hover:border-emerald-500 hover:shadow-md transition">
                    <p class="text-3xl mb-2">📖</p>
                    <h3 class="font-semibold text-gray-800">Farming Guides</h3>
                    <p class="text-sm text-gray-600 mt-2">Access expert farming tips and downloadable guides</p>
                </a>
                <a href="{{ route('weather.public') }}" class="p-6 border-2 border-gray-200 rounded-lg hover:border-emerald-500 hover:shadow-md transition">
                    <p class="text-3xl mb-2">🌡️</p>
                    <h3 class="font-semibold text-gray-800">Weather Information</h3>
                    <p class="text-sm text-gray-600 mt-2">Get detailed weather forecasts and alerts</p>
                </a>
                <a href="{{ route('market-prices.public') }}" class="p-6 border-2 border-gray-200 rounded-lg hover:border-emerald-500 hover:shadow-md transition">
                    <p class="text-3xl mb-2">💵</p>
                    <h3 class="font-semibold text-gray-800">Market Prices</h3>
                    <p class="text-sm text-gray-600 mt-2">Track crop prices and market trends</p>
                </a>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-8 mt-12">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <p>&copy; 2026 MannalonApp. Your agricultural partner in Cagayan Province.</p>
            <p class="text-gray-400 mt-2">Empowering farmers with technology and knowledge</p>
        </div>
    </footer>
</body>
</html>
