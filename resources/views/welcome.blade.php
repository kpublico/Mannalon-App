<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MannalonApp - Modern Farming Management</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .hero-gradient {
            background: linear-gradient(135deg, #064e3b 0%, #047857 100%);
        }
        .stat-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        }
        .feature-card {
            transition: all 0.3s ease;
        }
        .feature-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 30px rgba(6, 78, 59, 0.15);
        }
        .service-card {
            transition: all 0.3s ease;
            border: 2px solid #e5e7eb;
        }
        .service-card:hover {
            border-color: #064e3b;
            box-shadow: 0 8px 20px rgba(6, 78, 59, 0.1);
            transform: translateY(-5px);
        }
        @media (max-width: 768px) {
            .nav-date-time {
                display: none;
            }
            .hero-text {
                text-align: center;
            }
        }
    </style>
</head>
<body class="bg-white">
    <!-- NAVIGATION HEADER -->
    <nav class="fixed top-0 w-full bg-white shadow-lg z-50">
        <div class="max-w-7xl mx-auto px-2 sm:px-4 lg:px-8">
            <div class="flex justify-between items-center h-14 md:h-16">
                <!-- Logo and Name -->
                <div class="flex items-center gap-2 flex-shrink-0">
                    <img src="/images/logo.png" alt="MannalonApp Logo" style="width: 40px; height: 40px;" class="flex-shrink-0">
                    <div class="min-w-0">
                        <div class="text-base md:text-lg font-bold text-emerald-700 truncate">MannalonApp</div>
                    </div>
                </div>

                <!-- Navigation Links -->
                <div class="hidden md:flex items-center gap-6 lg:gap-8">
                    <a href="#features" class="text-sm text-gray-700 font-semibold hover:text-emerald-700 transition">Features</a>
                    <a href="#services" class="text-sm text-gray-700 font-semibold hover:text-emerald-700 transition">Services</a>
                    <a href="#contact" class="text-sm text-gray-700 font-semibold hover:text-emerald-700 transition">Contact</a>
                </div>

                <!-- Real-time Date and Clock -->
                <div class="text-right nav-date-time hidden md:block">
                    <p class="text-xs lg:text-sm font-semibold text-gray-800"><span id="clockDisplay">00:00:00 AM</span> | <span id="dateDisplay">Monday, January 26, 2026</span></p>
                </div>
            </div>
        </div>
    </nav>

    <!-- HERO SECTION -->
    <section class="hero-gradient pt-20 pb-12 text-white mt-16 relative overflow-hidden">
        <!-- Background Image with Low Opacity -->
        <div class="absolute inset-0 z-0" style="background-image: url('/images/inserte_picture.jpg'); background-size: cover; background-position: center; opacity: 0.3;"></div>
        
        <!-- Overlay for Better Text Readability -->
        <div class="absolute inset-0 bg-gradient-to-r from-emerald-900/80 to-emerald-800/60 z-10"></div>
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-20">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 md:gap-12 items-center">
                <!-- Left Side -->
                <div class="hero-text">
                    <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-bold mb-4 leading-tight">
                        Where Data Meets the Field
                    </h1>
                    <p class="text-base sm:text-lg md:text-xl text-emerald-100 mb-6 md:mb-8 leading-relaxed">
                        Transform your farming operations with intelligent monitoring, real-time market insights, and weather-driven decision making.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-3 sm:gap-4">
                        <a href="{{ route('register') }}" class="inline-block px-6 sm:px-8 py-2.5 md:py-3 bg-white text-emerald-700 font-bold text-sm md:text-base rounded-lg hover:bg-gray-100 transition text-center">
                            Create Account
                        </a>
                        <a href="{{ route('login') }}" class="inline-block px-6 sm:px-8 py-2.5 md:py-3 border-2 border-white text-white font-bold text-sm md:text-base rounded-lg hover:bg-white hover:bg-opacity-10 transition text-center">
                            Log In
                        </a>
                    </div>
                </div>

                <!-- Right Side - Empty for background image -->
                
            </div>

            <!-- Quick Stats -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 md:gap-6 mt-12 md:mt-16">
                <div class="stat-card bg-white bg-opacity-20 backdrop-blur-sm rounded-xl p-4 md:p-6">
                    <div class="text-2xl sm:text-3xl md:text-4xl font-bold text-white mb-2">{{ number_format($activeFarmers) }}+</div>
                    <p class="text-sm md:text-base text-emerald-100">Active Farmers</p>
                </div>
                <div class="stat-card bg-white bg-opacity-20 backdrop-blur-sm rounded-xl p-4 md:p-6">
                    <div class="text-2xl sm:text-3xl md:text-4xl font-bold text-white mb-2">{{ number_format($monitoredFarms) }}+</div>
                    <p class="text-sm md:text-base text-emerald-100">Monitored Farms</p>
                </div>
                <div class="stat-card bg-white bg-opacity-20 backdrop-blur-sm rounded-xl p-4 md:p-6">
                    <div class="text-2xl sm:text-3xl md:text-4xl font-bold text-white mb-2">{{ number_format(round($tonsHarvested / 1000000, 1)) }}M+</div>
                    <p class="text-sm md:text-base text-emerald-100">Tons Harvested</p>
                </div>
            </div>>
                    <div class="text-4xl font-bold text-white mb-2">{{ number_format(round($tonsHarvested / 1000000, 1)) }}M+</div>
                    <p class="text-emerald-100">Tons Harvested</p>
                </div>
            </div>
        </div>
    </section>

    <!-- WHAT IS MANNALONAPP? SECTION -->
    <section id="features" class="py-12 md:py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-10 md:mb-16">
                <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold text-gray-900 mb-3 md:mb-4">What is MannalonApp?</h2>
                <p class="text-base md:text-xl text-gray-600">An intelligent farm management platform designed for all types of farmers in Cagayan Province</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
                <!-- Feature 1 -->
                <div class="feature-card bg-white rounded-xl p-6 md:p-8 text-center border-t-4 border-emerald-700">
                    <div class="text-4xl md:text-5xl mb-3 md:mb-4">📊</div>
                    <h3 class="text-lg md:text-2xl font-bold text-gray-900 mb-2 md:mb-3">Farm Monitoring</h3>
                    <p class="text-sm md:text-base text-gray-600 leading-relaxed">
                        Track your crops in real-time with advanced monitoring tools. Get alerts for soil conditions, water levels, and crop health.
                    </p>
                </div>

                <!-- Feature 2 -->
                <div class="feature-card bg-white rounded-xl p-6 md:p-8 text-center border-t-4 border-emerald-600">
                    <div class="text-4xl md:text-5xl mb-3 md:mb-4">💰</div>
                    <h3 class="text-lg md:text-2xl font-bold text-gray-900 mb-2 md:mb-3">Market Insights</h3>
                    <p class="text-sm md:text-base text-gray-600 leading-relaxed">
                        Stay ahead with real-time market prices, demand forecasts, and buyer connections to maximize your profits.
                    </p>
                </div>

                <!-- Feature 3 -->
                <div class="feature-card bg-white rounded-xl p-6 md:p-8 text-center border-t-4 border-emerald-500">
                    <div class="text-4xl md:text-5xl mb-3 md:mb-4">🌤️</div>
                    <h3 class="text-lg md:text-2xl font-bold text-gray-900 mb-2 md:mb-3">Weather Alerts</h3>
                    <p class="text-sm md:text-base text-gray-600 leading-relaxed">
                        Get timely weather predictions and alerts customized for your location to plan farming activities effectively.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- AVAILABLE SERVICES SECTION -->
    <section id="services" class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">Available Services</h2>
                <p class="text-xl text-gray-600">Comprehensive tools to manage every aspect of your farming operation</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Service 1 -->
                <div class="service-card bg-white rounded-xl p-8">
                    <div class="text-4xl mb-4">�</div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-3">Announcements</h3>
                    <p class="text-gray-600 mb-4">
                        Receive timely updates from admins and stay informed about important farming announcements, policies, and events in your area.
                    </p>
                    <button class="text-emerald-700 font-semibold hover:text-emerald-800">Learn More →</button>
                </div>

                <!-- Service 2 -->
                <div class="service-card bg-white rounded-xl p-8">
                    <div class="text-4xl mb-4">📚</div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-3">Farming Guides</h3>
                    <p class="text-gray-600 mb-4">
                        Access comprehensive farming guides with best practices, techniques, and expert tips to improve your crop and livestock management.
                    </p>
                    <button class="text-emerald-700 font-semibold hover:text-emerald-800">Learn More →</button>
                </div>

                <!-- Service 3 -->
                <div class="service-card bg-white rounded-xl p-8">
                    <div class="text-4xl mb-4">🌤️</div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-3">Weather Monitoring</h3>
                    <p class="text-gray-600 mb-4">
                        Track real-time weather data and forecasts customized for your location to make informed farming decisions.
                    </p>
                    <button class="text-emerald-700 font-semibold hover:text-emerald-800">Learn More →</button>
                </div>

                <!-- Service 4 -->
                <div class="service-card bg-white rounded-xl p-8">
                    <div class="text-4xl mb-4">💰</div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-3">Market Prices</h3>
                    <p class="text-gray-600 mb-4">
                        View current market prices for agricultural products and optimize your selling strategies based on real-time market insights.
                    </p>
                    <button class="text-emerald-700 font-semibold hover:text-emerald-800">Learn More →</button>
                </div>

                <!-- Service 5 -->
                <div class="service-card bg-white rounded-xl p-8">
                    <div class="text-4xl mb-4">🌾</div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-3">Crop Management</h3>
                    <p class="text-gray-600 mb-4">
                        Record and track your crops, monitor growth stages, and maintain detailed records for better farm management and analysis.
                    </p>
                    <button class="text-emerald-700 font-semibold hover:text-emerald-800">Learn More →</button>
                </div>

                <!-- Service 6 -->
                <div class="service-card bg-white rounded-xl p-8">
                    <div class="text-4xl mb-4">🐄</div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-3">Livestock Tracking</h3>
                    <p class="text-gray-600 mb-4">
                        Manage your livestock records including health, breeding cycles, and production metrics in one centralized platform.
                    </p>
                    <button class="text-emerald-700 font-semibold hover:text-emerald-800">Learn More →</button>
                </div>

                <!-- Service 7 -->
                <div class="service-card bg-white rounded-xl p-8">
                    <div class="text-4xl mb-4">🤖</div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-3">AI Chatbot Assistant</h3>
                    <p class="text-gray-600 mb-4">
                        Get instant farming advice and guidance from an intelligent AI assistant available 24/7 to answer your agricultural questions.
                    </p>
                    <button class="text-emerald-700 font-semibold hover:text-emerald-800">Learn More →</button>
                </div>

                <!-- Service 8 -->
                <div class="service-card bg-white rounded-xl p-8">
                    <div class="text-4xl mb-4">💬</div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-3">Messaging & Notifications</h3>
                    <p class="text-gray-600 mb-4">
                        Stay connected with direct messaging, broadcast notifications, and keep track of all important communications in one place.
                    </p>
                    <button class="text-emerald-700 font-semibold hover:text-emerald-800">Learn More →</button>
                </div>
            </div>
        </div>
    </section>

    <!-- HELPFUL RESOURCES SECTION -->
    <section class="py-12 md:py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-8 md:mb-12">
                <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold text-gray-900 mb-2 md:mb-4">Helpful Resources</h2>
                <p class="text-base md:text-xl text-gray-600">Everything you need to succeed</p>
            </div>

            <div class="flex flex-wrap justify-center gap-4 md:gap-8 lg:gap-16">
                <a href="#" class="flex items-center gap-2 md:gap-3 text-base md:text-lg font-semibold text-gray-700 hover:text-emerald-700 transition">
                    <span class="text-xl md:text-2xl">📚</span> <span class="whitespace-nowrap">Farming Guides</span>
                </a>
                <a href="#" class="flex items-center gap-2 md:gap-3 text-base md:text-lg font-semibold text-gray-700 hover:text-emerald-700 transition">
                    <span class="text-xl md:text-2xl">🎥</span> <span class="whitespace-nowrap">Video Tutorials</span>
                </a>
                <a href="#" class="flex items-center gap-2 md:gap-3 text-base md:text-lg font-semibold text-gray-700 hover:text-emerald-700 transition">
                    <span class="text-xl md:text-2xl">👥</span> <span class="whitespace-nowrap">Community Forum</span>
                </a>
                <a href="#" class="flex items-center gap-2 md:gap-3 text-base md:text-lg font-semibold text-gray-700 hover:text-emerald-700 transition">
                    <span class="text-xl md:text-2xl">🎧</span> <span class="whitespace-nowrap">Tech Support</span>
                </a>
            </div>
        </div>
    </section>

    <!-- CALL TO ACTION & FOOTER -->
    <section id="contact" class="py-12 md:py-20 bg-gradient-to-r from-emerald-900 to-emerald-800 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- CTA Section -->
            <div class="text-center mb-12 md:mb-20">
                <h2 class="text-2xl sm:text-3xl md:text-5xl font-bold mb-3 md:mb-4">Ready to Get Started?</h2>
                <p class="text-base md:text-xl text-emerald-100 mb-6 md:mb-8 max-w-2xl mx-auto">
                    Join thousands of farmers who are already transforming their operations with MannalonApp
                </p>
                <a href="{{ route('register') }}" class="inline-block px-6 md:px-10 py-2.5 md:py-4 bg-white text-emerald-700 font-bold text-sm md:text-lg rounded-lg hover:bg-gray-100 transition shadow-lg">
                    Create Free Account
                </a>
            </div>

            <!-- Footer -->
            <div class="border-t border-emerald-700 pt-8 md:pt-12">
                <div class="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-4 gap-6 md:gap-8 mb-6 md:mb-8">
                    <!-- About Us -->
                    <div>
                        <h3 class="text-lg md:text-xl font-bold mb-3 md:mb-4">About Us</h3>
                        <ul class="space-y-1.5 md:space-y-2 text-emerald-100 text-sm md:text-base">
                            <li><a href="#" class="hover:text-white transition">Our Story</a></li>
                            <li><a href="#" class="hover:text-white transition">Our Mission</a></li>
                            <li><a href="#" class="hover:text-white transition">Team</a></li>
                            <li><a href="#" class="hover:text-white transition">Careers</a></li>
                        </ul>
                    </div>

                    <!-- Quick Links -->
                    <div>
                        <h3 class="text-xl font-bold mb-4">Quick Links</h3>
                        <ul class="space-y-2 text-emerald-100">
                            <li><a href="#" class="hover:text-white transition">Dashboard</a></li>
                            <li><a href="#" class="hover:text-white transition">Features</a></li>
                            <li><a href="#" class="hover:text-white transition">Pricing</a></li>
                            <li><a href="#" class="hover:text-white transition">Blog</a></li>
                        </ul>
                    </div>

                    <!-- Services -->
                    <div>
                        <h3 class="text-xl font-bold mb-4">Services</h3>
                        <ul class="space-y-2 text-emerald-100">
                            <li><a href="#" class="hover:text-white transition">Farm Monitoring</a></li>
                            <li><a href="#" class="hover:text-white transition">Market Insights</a></li>
                            <li><a href="#" class="hover:text-white transition">Weather Alerts</a></li>
                            <li><a href="#" class="hover:text-white transition">Support</a></li>
                        </ul>
                    </div>

                    <!-- Contact Info -->
                    <div>
                        <h3 class="text-xl font-bold mb-4">Contact Info</h3>
                        <ul class="space-y-3 text-emerald-100">
                            <li class="flex items-center gap-2">
                                <svg style="width: 20px; height: 20px; flex-shrink-0;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/>
                                </svg>
                                <span>+1 (555) 123-4567</span>
                            </li>
                            <li class="flex items-center gap-2">
                                <svg style="width: 20px; height: 20px; flex-shrink-0;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <rect x="2" y="4" width="20" height="16" rx="2"/>
                                    <path d="m22 7-10 5L2 7"/>
                                </svg>
                                <span>support@mannalon.com</span>
                            </li>
                            <li class="flex items-center gap-2">
                                <svg style="width: 20px; height: 20px; flex-shrink-0;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/>
                                    <circle cx="12" cy="10" r="3"/>
                                </svg>
                                <span>Rural County, State</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Bottom Footer -->
                <div class="border-t border-emerald-700 pt-8 flex flex-col md:flex-row justify-between items-center text-emerald-100">
                    <p>&copy; 2026 MannalonApp. All rights reserved.</p>
                    <div class="flex gap-6 mt-4 md:mt-0">
                        <a href="#" class="hover:text-white transition">Privacy Policy</a>
                        <a href="#" class="hover:text-white transition">Terms of Service</a>
                        <a href="#" class="hover:text-white transition">Cookie Policy</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        // Mobile menu toggle (if needed in future)
        document.addEventListener('DOMContentLoaded', function() {
            // Smooth scrolling
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        target.scrollIntoView({ behavior: 'smooth' });
                    }
                });
            });
        });

        // Real-time clock update
        function updateClock() {
            const now = new Date();
            
            // Format time in 12-hour format with AM/PM
            let hours = now.getHours();
            const minutes = String(now.getMinutes()).padStart(2, '0');
            const seconds = String(now.getSeconds()).padStart(2, '0');
            const ampm = hours >= 12 ? 'PM' : 'AM';
            hours = hours % 12;
            hours = hours ? hours : 12;
            const hours12 = String(hours).padStart(2, '0');
            
            // Format date with day name
            const days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
            const months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
            
            const dayName = days[now.getDay()];
            const monthName = months[now.getMonth()];
            const date = now.getDate();
            const year = now.getFullYear();
            
            document.getElementById('clockDisplay').textContent = `${hours12}:${minutes}:${seconds} ${ampm}`;
            document.getElementById('dateDisplay').textContent = `${dayName}, ${monthName} ${date}, ${year}`;
        }

        // Update clock every second
        updateClock();
        setInterval(updateClock, 1000);
    </script>
</body>
</html>
