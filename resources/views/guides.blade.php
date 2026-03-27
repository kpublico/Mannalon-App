<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Farming Guides - MannalonApp</title>
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
                <a href="{{ route('home') }}" class="hover:text-emerald-100 transition">Home</a>
                <a href="{{ route('announcements') }}" class="hover:text-emerald-100 transition">Announcements</a>
                <a href="{{ route('guides') }}" class="hover:text-emerald-100 transition font-bold">Guides</a>
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
                @endauth
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="emerald-gradient text-white py-12">
        <div class="max-w-7xl mx-auto px-6">
            <h1 class="text-4xl font-bold mb-2">📘 Farming Guides</h1>
            <p class="text-emerald-50">Expert tips and guides to improve your farming practices</p>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-6 py-12">
        <!-- Navigation Tabs -->
        <div class="mb-8 border-b border-gray-200 sticky top-16 bg-gray-50 -mx-6 px-6 py-4 z-40">
            <div class="flex gap-8 overflow-x-auto">
                <button onclick="showTab('guides')" class="nav-tab active px-4 py-2 border-b-4 border-emerald-600 text-emerald-600 font-semibold transition whitespace-nowrap">
                    📖 Farming Guides
                </button>
                <button onclick="showTab('research')" class="nav-tab px-4 py-2 border-b-4 border-transparent text-gray-600 hover:text-emerald-600 font-semibold transition whitespace-nowrap">
                    🔬 Research Resources
                </button>
                <button onclick="showTab('videos')" class="nav-tab px-4 py-2 border-b-4 border-transparent text-gray-600 hover:text-emerald-600 font-semibold transition whitespace-nowrap">
                    🎬 Video Tutorials
                </button>
                <button onclick="showTab('publications')" class="nav-tab px-4 py-2 border-b-4 border-transparent text-gray-600 hover:text-emerald-600 font-semibold transition whitespace-nowrap">
                    📄 Publications
                </button>
            </div>
        </div>

        <!-- GUIDES SECTION -->
        <div id="guides-section" class="tab-section">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Guide 1 -->
            <div class="bg-white p-6 rounded-lg shadow-sm hover:shadow-md transition">
                <div class="flex items-start justify-between mb-4">
                    <div>
                        <span class="inline-block bg-emerald-100 text-emerald-800 px-3 py-1 rounded-full text-sm font-semibold mb-2">Crop Management</span>
                        <h3 class="text-xl font-bold text-gray-800">Organic Rice Cultivation Guide</h3>
                    </div>
                </div>
                <p class="text-gray-700 mb-4">Learn the best practices for growing rice organically without harmful chemicals. This comprehensive guide covers land preparation, planting, care, and harvesting techniques.</p>
                <div class="bg-gray-50 p-3 rounded mb-4 text-sm text-gray-600">
                    <p><strong>Duration:</strong> 120-150 days</p>
                    <p><strong>Yield:</strong> 5-6 tons per hectare</p>
                </div>
                <a href="#" class="inline-block px-4 py-2 bg-emerald-600 text-white rounded-lg font-semibold hover:bg-emerald-700 transition">📖 Read Guide</a>
                <a href="#" class="inline-block ml-2 px-4 py-2 border-2 border-emerald-600 text-emerald-600 rounded-lg font-semibold hover:bg-emerald-50 transition">📥 Download PDF</a>
            </div>

            <!-- Guide 2 -->
            <div class="bg-white p-6 rounded-lg shadow-sm hover:shadow-md transition">
                <div class="flex items-start justify-between mb-4">
                    <div>
                        <span class="inline-block bg-red-100 text-red-800 px-3 py-1 rounded-full text-sm font-semibold mb-2">Pest Control</span>
                        <h3 class="text-xl font-bold text-gray-800">Natural Pest Management</h3>
                    </div>
                </div>
                <p class="text-gray-700 mb-4">Discover eco-friendly methods to protect your crops from common pests. This guide includes identification of pests, natural remedies, and preventive measures.</p>
                <div class="bg-gray-50 p-3 rounded mb-4 text-sm text-gray-600">
                    <p><strong>Coverage:</strong> 15+ Common pests</p>
                    <p><strong>Methods:</strong> Organic & biological</p>
                </div>
                <a href="#" class="inline-block px-4 py-2 bg-emerald-600 text-white rounded-lg font-semibold hover:bg-emerald-700 transition">📖 Read Guide</a>
                <a href="#" class="inline-block ml-2 px-4 py-2 border-2 border-emerald-600 text-emerald-600 rounded-lg font-semibold hover:bg-emerald-50 transition">📥 Download PDF</a>
            </div>

            <!-- Guide 3 -->
            <div class="bg-white p-6 rounded-lg shadow-sm hover:shadow-md transition">
                <div class="flex items-start justify-between mb-4">
                    <div>
                        <span class="inline-block bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm font-semibold mb-2">Soil Health</span>
                        <h3 class="text-xl font-bold text-gray-800">Soil Preparation & Amendment</h3>
                    </div>
                </div>
                <p class="text-gray-700 mb-4">Understand soil composition and how to improve soil fertility. This guide covers soil testing, composting, and nutrient management for optimal crop growth.</p>
                <div class="bg-gray-50 p-3 rounded mb-4 text-sm text-gray-600">
                    <p><strong>Topics:</strong> pH, fertility, structure</p>
                    <p><strong>Focus:</strong> Sustainable practices</p>
                </div>
                <a href="#" class="inline-block px-4 py-2 bg-emerald-600 text-white rounded-lg font-semibold hover:bg-emerald-700 transition">📖 Read Guide</a>
                <a href="#" class="inline-block ml-2 px-4 py-2 border-2 border-emerald-600 text-emerald-600 rounded-lg font-semibold hover:bg-emerald-50 transition">📥 Download PDF</a>
            </div>

            <!-- Guide 4 -->
            <div class="bg-white p-6 rounded-lg shadow-sm hover:shadow-md transition">
                <div class="flex items-start justify-between mb-4">
                    <div>
                        <span class="inline-block bg-cyan-100 text-cyan-800 px-3 py-1 rounded-full text-sm font-semibold mb-2">Irrigation</span>
                        <h3 class="text-xl font-bold text-gray-800">Efficient Water Management</h3>
                    </div>
                </div>
                <p class="text-gray-700 mb-4">Learn efficient irrigation techniques to conserve water and save costs. Includes drip irrigation, rainwater harvesting, and water scheduling strategies.</p>
                <div class="bg-gray-50 p-3 rounded mb-4 text-sm text-gray-600">
                    <p><strong>Savings:</strong> Up to 30% water</p>
                    <p><strong>Methods:</strong> Drip & sprinkler</p>
                </div>
                <a href="#" class="inline-block px-4 py-2 bg-emerald-600 text-white rounded-lg font-semibold hover:bg-emerald-700 transition">📖 Read Guide</a>
                <a href="#" class="inline-block ml-2 px-4 py-2 border-2 border-emerald-600 text-emerald-600 rounded-lg font-semibold hover:bg-emerald-50 transition">📥 Download PDF</a>
            </div>

            <!-- Guide 5 -->
            <div class="bg-white p-6 rounded-lg shadow-sm hover:shadow-md transition">
                <div class="flex items-start justify-between mb-4">
                    <div>
                        <span class="inline-block bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full text-sm font-semibold mb-2">Crop Management</span>
                        <h3 class="text-xl font-bold text-gray-800">Vegetable Gardening Essentials</h3>
                    </div>
                </div>
                <p class="text-gray-700 mb-4">Complete guide to growing healthy vegetables at home or in your farm. Covers 10+ vegetables with specific growing requirements and harvest tips.</p>
                <div class="bg-gray-50 p-3 rounded mb-4 text-sm text-gray-600">
                    <p><strong>Vegetables:</strong> 10+ varieties</p>
                    <p><strong>Season:</strong> Year-round</p>
                </div>
                <a href="#" class="inline-block px-4 py-2 bg-emerald-600 text-white rounded-lg font-semibold hover:bg-emerald-700 transition">📖 Read Guide</a>
                <a href="#" class="inline-block ml-2 px-4 py-2 border-2 border-emerald-600 text-emerald-600 rounded-lg font-semibold hover:bg-emerald-50 transition">📥 Download PDF</a>
            </div>

            <!-- Guide 6 -->
            <div class="bg-white p-6 rounded-lg shadow-sm hover:shadow-md transition">
                <div class="flex items-start justify-between mb-4">
                    <div>
                        <span class="inline-block bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-semibold mb-2">Crop Management</span>
                        <h3 class="text-xl font-bold text-gray-800">Corn Production Manual</h3>
                    </div>
                </div>
                <p class="text-gray-700 mb-4">Step-by-step guide to producing high-quality corn. Covers variety selection, planting techniques, fertilization, weed control, and harvesting.</p>
                <div class="bg-gray-50 p-3 rounded mb-4 text-sm text-gray-600">
                    <p><strong>Duration:</strong> 90-110 days</p>
                    <p><strong>Yield:</strong> 4-5 tons per hectare</p>
                </div>
                <a href="#" class="inline-block px-4 py-2 bg-emerald-600 text-white rounded-lg font-semibold hover:bg-emerald-700 transition">📖 Read Guide</a>
                <a href="#" class="inline-block ml-2 px-4 py-2 border-2 border-emerald-600 text-emerald-600 rounded-lg font-semibold hover:bg-emerald-50 transition">📥 Download PDF</a>
            </div>
        </div>
        </div><!-- end guides-section -->

        <!-- RESEARCH RESOURCES SECTION -->
        <div id="research-section" class="tab-section hidden">
            <div>
                <h2 class="text-2xl font-bold text-gray-800 mb-6">🔬 Farmer Research Resources</h2>
                <p class="text-gray-600 mb-8">Access cutting-edge agricultural research, studies, and scientific findings to improve your farming practices</p>
                
                <!-- Category Navigation -->
                <div class="flex flex-wrap gap-3 mb-8">
                    <button class="px-4 py-2 bg-emerald-600 text-white rounded-full font-semibold hover:bg-emerald-700 transition">All Research</button>
                    <button class="px-4 py-2 border-2 border-gray-300 text-gray-700 rounded-full hover:border-emerald-600 transition">Crop Science</button>
                    <button class="px-4 py-2 border-2 border-gray-300 text-gray-700 rounded-full hover:border-emerald-600 transition">Sustainability</button>
                    <button class="px-4 py-2 border-2 border-gray-300 text-gray-700 rounded-full hover:border-emerald-600 transition">Climate Adaptation</button>
                    <button class="px-4 py-2 border-2 border-gray-300 text-gray-700 rounded-full hover:border-emerald-600 transition">Soil Science</button>
                </div>

                <!-- Research Items Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Research 1 -->
                    <div class="bg-white p-6 rounded-lg shadow-sm hover:shadow-md transition border-l-4 border-emerald-600">
                        <span class="inline-block bg-emerald-100 text-emerald-800 px-3 py-1 rounded-full text-sm font-semibold mb-2">Crop Science</span>
                        <h3 class="text-lg font-bold text-gray-800 mb-3">Climate-Smart Agriculture Research Study</h3>
                        <p class="text-gray-600 text-sm mb-4">Latest findings on adapting farming practices to climate variability. Research by Philippine Agricultural Institute.</p>
                        <div class="bg-gray-50 p-3 rounded mb-4 text-xs text-gray-600">
                            <p><strong>Published:</strong> January 2026</p>
                            <p><strong>Format:</strong> Research Paper (PDF, 45 pages)</p>
                        </div>
                        <div class="flex gap-3">
                            <a href="#" class="flex-1 text-center px-3 py-2 bg-emerald-600 text-white rounded-lg font-semibold hover:bg-emerald-700 transition text-sm">📥 Download Study</a>
                            <a href="#" class="flex-1 text-center px-3 py-2 border-2 border-emerald-600 text-emerald-600 rounded-lg font-semibold hover:bg-emerald-50 transition text-sm">👁️ Preview</a>
                        </div>
                    </div>

                    <!-- Research 2 -->
                    <div class="bg-white p-6 rounded-lg shadow-sm hover:shadow-md transition border-l-4 border-blue-500">
                        <span class="inline-block bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm font-semibold mb-2">Sustainability</span>
                        <h3 class="text-lg font-bold text-gray-800 mb-3">Organic Farming Impact Assessment</h3>
                        <p class="text-gray-600 text-sm mb-4">Comprehensive study on the environmental and economic benefits of organic farming methods. Bureau of Agriculture Research.</p>
                        <div class="bg-gray-50 p-3 rounded mb-4 text-xs text-gray-600">
                            <p><strong>Published:</strong> December 2025</p>
                            <p><strong>Format:</strong> Research Report (PDF, 62 pages)</p>
                        </div>
                        <div class="flex gap-3">
                            <a href="#" class="flex-1 text-center px-3 py-2 bg-emerald-600 text-white rounded-lg font-semibold hover:bg-emerald-700 transition text-sm">📥 Download Study</a>
                            <a href="#" class="flex-1 text-center px-3 py-2 border-2 border-emerald-600 text-emerald-600 rounded-lg font-semibold hover:bg-emerald-50 transition text-sm">👁️ Preview</a>
                        </div>
                    </div>

                    <!-- Research 3 -->
                    <div class="bg-white p-6 rounded-lg shadow-sm hover:shadow-md transition border-l-4 border-green-500">
                        <span class="inline-block bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-semibold mb-2">Soil Science</span>
                        <h3 class="text-lg font-bold text-gray-800 mb-3">Soil Health Improvement Through Composting</h3>
                        <p class="text-gray-600 text-sm mb-4">Scientific analysis of composting methods and their effectiveness in enhancing soil fertility and structure.</p>
                        <div class="bg-gray-50 p-3 rounded mb-4 text-xs text-gray-600">
                            <p><strong>Published:</strong> November 2025</p>
                            <p><strong>Format:</strong> Research Paper (PDF, 38 pages)</p>
                        </div>
                        <div class="flex gap-3">
                            <a href="#" class="flex-1 text-center px-3 py-2 bg-emerald-600 text-white rounded-lg font-semibold hover:bg-emerald-700 transition text-sm">📥 Download Study</a>
                            <a href="#" class="flex-1 text-center px-3 py-2 border-2 border-emerald-600 text-emerald-600 rounded-lg font-semibold hover:bg-emerald-50 transition text-sm">👁️ Preview</a>
                        </div>
                    </div>

                    <!-- Research 4 -->
                    <div class="bg-white p-6 rounded-lg shadow-sm hover:shadow-md transition border-l-4 border-yellow-500">
                        <span class="inline-block bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full text-sm font-semibold mb-2">Climate Adaptation</span>
                        <h3 class="text-lg font-bold text-gray-800 mb-3">Drought-Resistant Crop Varieties Guide</h3>
                        <p class="text-gray-600 text-sm mb-4">Research on climate-resilient crop varieties suitable for Cagayan Province's diverse agricultural zones.</p>
                        <div class="bg-gray-50 p-3 rounded mb-4 text-xs text-gray-600">
                            <p><strong>Published:</strong> October 2025</p>
                            <p><strong>Format:</strong> Technical Brief (PDF, 28 pages)</p>
                        </div>
                        <div class="flex gap-3">
                            <a href="#" class="flex-1 text-center px-3 py-2 bg-emerald-600 text-white rounded-lg font-semibold hover:bg-emerald-700 transition text-sm">📥 Download Study</a>
                            <a href="#" class="flex-1 text-center px-3 py-2 border-2 border-emerald-600 text-emerald-600 rounded-lg font-semibold hover:bg-emerald-50 transition text-sm">👁️ Preview</a>
                        </div>
                    </div>

                    <!-- Research 5 -->
                    <div class="bg-white p-6 rounded-lg shadow-sm hover:shadow-md transition border-l-4 border-purple-500">
                        <span class="inline-block bg-purple-100 text-purple-800 px-3 py-1 rounded-full text-sm font-semibold mb-2">Crop Science</span>
                        <h3 class="text-lg font-bold text-gray-800 mb-3">Integrated Pest Management (IPM) Research</h3>
                        <p class="text-gray-600 text-sm mb-4">Comprehensive study on IPM techniques combining cultural, biological, and chemical pest control methods.</p>
                        <div class="bg-gray-50 p-3 rounded mb-4 text-xs text-gray-600">
                            <p><strong>Published:</strong> September 2025</p>
                            <p><strong>Format:</strong> Research Manual (PDF, 54 pages)</p>
                        </div>
                        <div class="flex gap-3">
                            <a href="#" class="flex-1 text-center px-3 py-2 bg-emerald-600 text-white rounded-lg font-semibold hover:bg-emerald-700 transition text-sm">📥 Download Study</a>
                            <a href="#" class="flex-1 text-center px-3 py-2 border-2 border-emerald-600 text-emerald-600 rounded-lg font-semibold hover:bg-emerald-50 transition text-sm">👁️ Preview</a>
                        </div>
                    </div>

                    <!-- Research 6 -->
                    <div class="bg-white p-6 rounded-lg shadow-sm hover:shadow-md transition border-l-4 border-red-500">
                        <span class="inline-block bg-red-100 text-red-800 px-3 py-1 rounded-full text-sm font-semibold mb-2">Sustainability</span>
                        <h3 class="text-lg font-bold text-gray-800 mb-3">Water Conservation Techniques for Agriculture</h3>
                        <p class="text-gray-600 text-sm mb-4">Scientific analysis of water-saving irrigation methods and rainwater harvesting systems for Philippine farms.</p>
                        <div class="bg-gray-50 p-3 rounded mb-4 text-xs text-gray-600">
                            <p><strong>Published:</strong> August 2025</p>
                            <p><strong>Format:</strong> Technical Guide (PDF, 41 pages)</p>
                        </div>
                        <div class="flex gap-3">
                            <a href="#" class="flex-1 text-center px-3 py-2 bg-emerald-600 text-white rounded-lg font-semibold hover:bg-emerald-700 transition text-sm">📥 Download Study</a>
                            <a href="#" class="flex-1 text-center px-3 py-2 border-2 border-emerald-600 text-emerald-600 rounded-lg font-semibold hover:bg-emerald-50 transition text-sm">👁️ Preview</a>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- end research-section -->

        <!-- VIDEO TUTORIALS SECTION -->
        <div id="videos-section" class="tab-section hidden">
            <div>
                <h2 class="text-2xl font-bold text-gray-800 mb-6">🎬 Video Tutorials & Webinars</h2>
                <p class="text-gray-600 mb-8">Learn from expert agricultural specialists through our collection of video tutorials and recorded webinars</p>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Video 1 -->
                    <div class="bg-white rounded-lg shadow-sm overflow-hidden hover:shadow-md transition">
                        <div class="bg-gray-200 h-40 flex items-center justify-center">
                            <span class="text-5xl">▶️</span>
                        </div>
                        <div class="p-4">
                            <h3 class="font-bold text-gray-800 mb-2">Rice Farming from Seed to Harvest</h3>
                            <p class="text-sm text-gray-600 mb-3">Complete rice farming process explained step-by-step</p>
                            <p class="text-xs text-gray-500 mb-3">Duration: 28 minutes</p>
                            <button class="w-full px-4 py-2 bg-emerald-600 text-white rounded-lg font-semibold hover:bg-emerald-700 transition">▶️ Watch Now</button>
                        </div>
                    </div>

                    <!-- Video 2 -->
                    <div class="bg-white rounded-lg shadow-sm overflow-hidden hover:shadow-md transition">
                        <div class="bg-gray-200 h-40 flex items-center justify-center">
                            <span class="text-5xl">▶️</span>
                        </div>
                        <div class="p-4">
                            <h3 class="font-bold text-gray-800 mb-2">Organic Pest Management Techniques</h3>
                            <p class="text-sm text-gray-600 mb-3">Natural methods to protect your crops</p>
                            <p class="text-xs text-gray-500 mb-3">Duration: 22 minutes</p>
                            <button class="w-full px-4 py-2 bg-emerald-600 text-white rounded-lg font-semibold hover:bg-emerald-700 transition">▶️ Watch Now</button>
                        </div>
                    </div>

                    <!-- Video 3 -->
                    <div class="bg-white rounded-lg shadow-sm overflow-hidden hover:shadow-md transition">
                        <div class="bg-gray-200 h-40 flex items-center justify-center">
                            <span class="text-5xl">▶️</span>
                        </div>
                        <div class="p-4">
                            <h3 class="font-bold text-gray-800 mb-2">Composting for Better Soil Health</h3>
                            <p class="text-sm text-gray-600 mb-3">Turn waste into valuable soil amendment</p>
                            <p class="text-xs text-gray-500 mb-3">Duration: 18 minutes</p>
                            <button class="w-full px-4 py-2 bg-emerald-600 text-white rounded-lg font-semibold hover:bg-emerald-700 transition">▶️ Watch Now</button>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- end videos-section -->

        <!-- PUBLICATIONS SECTION -->
        <div id="publications-section" class="tab-section hidden">
            <div>
                <h2 class="text-2xl font-bold text-gray-800 mb-6">📄 Agricultural Publications & Articles</h2>
                <p class="text-gray-600 mb-8">Featured articles and publications from agricultural experts and government agencies</p>
                
                <div class="space-y-4">
                    <!-- Publication 1 -->
                    <div class="bg-white p-6 rounded-lg shadow-sm hover:shadow-md transition border-l-4 border-emerald-600">
                        <div class="flex justify-between items-start mb-3">
                            <div class="flex-1">
                                <p class="text-xs text-gray-500 mb-1">📄 Article • Published Jan 25, 2026</p>
                                <h3 class="text-lg font-bold text-gray-800">Sustainable Farming Practices for Climate Resilience</h3>
                            </div>
                            <span class="bg-emerald-100 text-emerald-800 px-3 py-1 rounded-full text-sm font-semibold whitespace-nowrap ml-4">Featured</span>
                        </div>
                        <p class="text-gray-600 mb-4">Exploring how Philippine farmers are adapting to climate change through sustainable and regenerative agriculture methods...</p>
                        <div class="flex gap-3">
                            <a href="#" class="text-emerald-600 font-semibold text-sm hover:underline">Read Full Article →</a>
                            <span class="text-gray-400">•</span>
                            <a href="#" class="text-emerald-600 font-semibold text-sm hover:underline">Share</a>
                        </div>
                    </div>

                    <!-- Publication 2 -->
                    <div class="bg-white p-6 rounded-lg shadow-sm hover:shadow-md transition border-l-4 border-blue-500">
                        <div class="flex justify-between items-start mb-3">
                            <div class="flex-1">
                                <p class="text-xs text-gray-500 mb-1">📄 Research Update • Published Jan 20, 2026</p>
                                <h3 class="text-lg font-bold text-gray-800">High-Yield Crop Varieties Released for Northern Luzon</h3>
                            </div>
                        </div>
                        <p class="text-gray-600 mb-4">The Philippine Rice Research Institute has released five new rice varieties suitable for Cagayan Province's climate conditions...</p>
                        <div class="flex gap-3">
                            <a href="#" class="text-emerald-600 font-semibold text-sm hover:underline">Read Full Article →</a>
                            <span class="text-gray-400">•</span>
                            <a href="#" class="text-emerald-600 font-semibold text-sm hover:underline">Share</a>
                        </div>
                    </div>

                    <!-- Publication 3 -->
                    <div class="bg-white p-6 rounded-lg shadow-sm hover:shadow-md transition border-l-4 border-green-500">
                        <div class="flex justify-between items-start mb-3">
                            <div class="flex-1">
                                <p class="text-xs text-gray-500 mb-1">📄 Opinion Piece • Published Jan 15, 2026</p>
                                <h3 class="text-lg font-bold text-gray-800">The Future of Precision Agriculture in the Philippines</h3>
                            </div>
                        </div>
                        <p class="text-gray-600 mb-4">Dr. Maria Santos discusses how digital farming technologies can revolutionize productivity and sustainability for Filipino farmers...</p>
                        <div class="flex gap-3">
                            <a href="#" class="text-emerald-600 font-semibold text-sm hover:underline">Read Full Article →</a>
                            <span class="text-gray-400">•</span>
                            <a href="#" class="text-emerald-600 font-semibold text-sm hover:underline">Share</a>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- end publications-section -->
    </div>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-8 mt-12">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <p>&copy; 2026 MannalonApp. Your agricultural partner in Cagayan Province.</p>
            <p class="text-gray-400 mt-2">Empowering farmers with technology and knowledge</p>
        </div>
    </footer>

    <script>
        function showTab(tabName) {
            // Hide all sections
            document.querySelectorAll('.tab-section').forEach(section => {
                section.classList.add('hidden');
            });
            
            // Remove active class from all buttons
            document.querySelectorAll('.nav-tab').forEach(btn => {
                btn.classList.remove('active');
            });
            
            // Show selected section
            const sectionId = tabName + '-section';
            const section = document.getElementById(sectionId);
            if (section) {
                section.classList.remove('hidden');
            }
            
            // Add active class to clicked button
            event.target.classList.add('active');
            
            // Update styles for active button
            document.querySelectorAll('.nav-tab').forEach(btn => {
                if (btn.textContent.toLowerCase().includes(tabName) || (tabName === 'guides' && btn.textContent.includes('Farming Guides'))) {
                    btn.classList.add('border-emerald-600', 'text-emerald-600');
                    btn.classList.remove('border-transparent', 'text-gray-600');
                } else {
                    btn.classList.remove('border-emerald-600', 'text-emerald-600');
                    btn.classList.add('border-transparent', 'text-gray-600');
                }
            });
        }
    </script>
</body>
</html>
