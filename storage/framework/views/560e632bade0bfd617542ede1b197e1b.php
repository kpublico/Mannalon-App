<main>
<div class="space-y-6">
    <!-- QUICK ACTIONS -->
    <div class="flex gap-3 flex-wrap">
        <button class="px-4 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 transition font-semibold">
            <i class="fas fa-plus mr-2"></i>Add Location
        </button>
        <button class="px-4 py-2 border border-emerald-600 text-emerald-600 rounded-lg hover:bg-emerald-50 transition font-semibold">
            <i class="fas fa-sync-alt mr-2"></i>Refresh Data
        </button>
    </div>

    <!-- LOCATION SETTINGS & ALERTS -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Managed Locations -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h3 class="text-lg font-bold text-gray-900 mb-4">Managed Regions/Municipalities</h3>
            <div class="space-y-2">
                <div class="flex items-center justify-between p-3 bg-emerald-50 rounded-lg border-l-4 border-emerald-600">
                    <span class="font-semibold text-gray-900">Tuguegarao City, Cagayan</span>
                    <button class="text-red-600 hover:text-red-900 text-sm"><i class="fas fa-times"></i></button>
                </div>
                <div class="flex items-center justify-between p-3 bg-emerald-50 rounded-lg border-l-4 border-emerald-600">
                    <span class="font-semibold text-gray-900">Aparri, Cagayan</span>
                    <button class="text-red-600 hover:text-red-900 text-sm"><i class="fas fa-times"></i></button>
                </div>
                <div class="flex items-center justify-between p-3 bg-emerald-50 rounded-lg border-l-4 border-emerald-600">
                    <span class="font-semibold text-gray-900">Lal-lo, Cagayan</span>
                    <button class="text-red-600 hover:text-red-900 text-sm"><i class="fas fa-times"></i></button>
                </div>
                <div class="flex items-center justify-between p-3 bg-emerald-50 rounded-lg border-l-4 border-emerald-600">
                    <span class="font-semibold text-gray-900">Solana, Cagayan</span>
                    <button class="text-red-600 hover:text-red-900 text-sm"><i class="fas fa-times"></i></button>
                </div>
                <div class="flex items-center justify-between p-3 bg-emerald-50 rounded-lg border-l-4 border-emerald-600">
                    <span class="font-semibold text-gray-900">Alcala, Cagayan</span>
                    <button class="text-red-600 hover:text-red-900 text-sm"><i class="fas fa-times"></i></button>
                </div>
            </div>
        </div>

        <!-- Alert Settings -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h3 class="text-lg font-bold text-gray-900 mb-4">Severe Weather Alerts</h3>
            <div class="space-y-4">
                <div class="flex items-center justify-between p-4 bg-emerald-50 border-l-4 border-emerald-600 rounded-lg">
                    <div>
                        <p class="font-semibold text-gray-900">Alert Toggle Status</p>
                        <p class="text-sm text-gray-600">Enable/disable alerts for all regions</p>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" checked class="sr-only peer">
                        <div class="w-11 h-6 bg-gray-300 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-emerald-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-emerald-600"></div>
                    </label>
                </div>

                <div class="p-4 bg-emerald-50 border-l-4 border-emerald-600 rounded-lg">
                    <p class="font-semibold text-gray-900">Active Alerts</p>
                    <p class="text-2xl font-bold text-emerald-600 mt-2">3 Active</p>
                    <p class="text-sm text-gray-600 mt-1">⚠️ Flash flood warning - Tuguegarao City</p>
                    <p class="text-sm text-gray-600">💨 Strong winds - Aparri coastal areas</p>
                    <p class="text-sm text-gray-600">🌧️ Heavy rainfall - Cagayan Valley region</p>
                </div>
            </div>
        </div>
    </div>

    <!-- API INTEGRATION SETTINGS -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <h3 class="text-lg font-bold text-gray-900 mb-4">Forecast Integration Settings</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">API Provider</label>
                <select class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-600">
                    <option selected>PAGASA (Philippine Atmospheric)</option>
                    <option>OpenWeather</option>
                    <option>Weather.com</option>
                    <option>Custom API</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">API Key</label>
                <input type="password" placeholder="Enter your API key" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-600">
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Update Frequency</label>
                <select class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-600">
                    <option>Every 6 hours</option>
                    <option selected>Every 12 hours</option>
                    <option>Daily</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Forecast Days</label>
                <input type="number" min="1" max="14" value="7" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-600">
            </div>
        </div>
        <button class="mt-4 px-6 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 transition font-semibold">
            <i class="fas fa-save mr-2"></i>Save Settings
        </button>
    </div>

    <!-- CURRENT WEATHER STATUS -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <h3 class="text-lg font-bold text-gray-900 mb-4">Current Weather Status - Cagayan Province</h3>
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div class="p-4 bg-gradient-to-br from-emerald-100 to-emerald-50 rounded-lg border-l-4 border-emerald-600">
                <p class="text-sm text-gray-700 font-semibold">Tuguegarao City</p>
                <p class="text-2xl font-bold text-emerald-600 mt-2">34°C</p>
                <p class="text-sm text-gray-600 mt-1">☀️ Hot & Sunny</p>
                <div class="mt-2 text-xs text-gray-600 space-y-1">
                    <p>💧 Humidity: 68%</p>
                    <p>💨 Wind: 12 km/h NE</p>
                    <p>🌅 UV Index: 9 (High)</p>
                </div>
                <p class="text-xs text-gray-500 mt-2">Last updated: 15 mins ago</p>
            </div>
            <div class="p-4 bg-gradient-to-br from-emerald-100 to-emerald-50 rounded-lg border-l-4 border-emerald-600">
                <p class="text-sm text-gray-700 font-semibold">Aparri</p>
                <p class="text-2xl font-bold text-emerald-600 mt-2">29°C</p>
                <p class="text-sm text-gray-600 mt-1">⛅ Partly Cloudy</p>
                <div class="mt-2 text-xs text-gray-600 space-y-1">
                    <p>💧 Humidity: 75%</p>
                    <p>💨 Wind: 18 km/h N</p>
                    <p>🌊 Sea: Moderate</p>
                </div>
                <p class="text-xs text-gray-500 mt-2">Last updated: 10 mins ago</p>
            </div>
            <div class="p-4 bg-gradient-to-br from-emerald-100 to-emerald-50 rounded-lg border-l-4 border-emerald-600">
                <p class="text-sm text-gray-700 font-semibold">Lal-lo</p>
                <p class="text-2xl font-bold text-emerald-600 mt-2">32°C</p>
                <p class="text-sm text-gray-600 mt-1">🌤️ Mostly Sunny</p>
                <div class="mt-2 text-xs text-gray-600 space-y-1">
                    <p>💧 Humidity: 72%</p>
                    <p>💨 Wind: 10 km/h E</p>
                    <p>🌾 Ideal for farming</p>
                </div>
                <p class="text-xs text-gray-500 mt-2">Last updated: 20 mins ago</p>
            </div>
            <div class="p-4 bg-gradient-to-br from-emerald-100 to-emerald-50 rounded-lg border-l-4 border-emerald-600">
                <p class="text-sm text-gray-700 font-semibold">Solana</p>
                <p class="text-2xl font-bold text-emerald-600 mt-2">27°C</p>
                <p class="text-sm text-gray-600 mt-1">⛈️ Thunderstorm</p>
                <div class="mt-2 text-xs text-gray-600 space-y-1">
                    <p>💧 Humidity: 92%</p>
                    <p>💨 Wind: 25 km/h SW</p>
                    <p>⚠️ Heavy rain alert</p>
                </div>
                <p class="text-xs text-gray-500 mt-2">Last updated: Just now</p>
            </div>
        </div>
    </div>

    <!-- DETAILED WEATHER INFORMATION -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- 7-Day Forecast -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h3 class="text-lg font-bold text-gray-900 mb-4">7-Day Forecast - Tuguegarao</h3>
            <div class="space-y-3">
                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition">
                    <div class="flex items-center gap-4">
                        <span class="text-2xl">☀️</span>
                        <div>
                            <p class="font-semibold text-gray-900">Today, Jan 29</p>
                            <p class="text-xs text-gray-600">Hot and sunny all day</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="text-lg font-bold text-gray-900">34°C / 24°C</p>
                        <p class="text-xs text-gray-600">Rain: 10%</p>
                    </div>
                </div>
                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition">
                    <div class="flex items-center gap-4">
                        <span class="text-2xl">🌤️</span>
                        <div>
                            <p class="font-semibold text-gray-900">Thu, Jan 30</p>
                            <p class="text-xs text-gray-600">Partly cloudy</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="text-lg font-bold text-gray-900">33°C / 25°C</p>
                        <p class="text-xs text-gray-600">Rain: 20%</p>
                    </div>
                </div>
                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition">
                    <div class="flex items-center gap-4">
                        <span class="text-2xl">⛅</span>
                        <div>
                            <p class="font-semibold text-gray-900">Fri, Jan 31</p>
                            <p class="text-xs text-gray-600">Cloudy with sun breaks</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="text-lg font-bold text-gray-900">31°C / 24°C</p>
                        <p class="text-xs text-gray-600">Rain: 30%</p>
                    </div>
                </div>
                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition">
                    <div class="flex items-center gap-4">
                        <span class="text-2xl">🌧️</span>
                        <div>
                            <p class="font-semibold text-gray-900">Sat, Feb 1</p>
                            <p class="text-xs text-gray-600">Scattered showers</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="text-lg font-bold text-gray-900">29°C / 23°C</p>
                        <p class="text-xs text-gray-600">Rain: 60%</p>
                    </div>
                </div>
                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition">
                    <div class="flex items-center gap-4">
                        <span class="text-2xl">⛈️</span>
                        <div>
                            <p class="font-semibold text-gray-900">Sun, Feb 2</p>
                            <p class="text-xs text-gray-600">Thunderstorms likely</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="text-lg font-bold text-gray-900">28°C / 23°C</p>
                        <p class="text-xs text-gray-600">Rain: 80%</p>
                    </div>
                </div>
                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition">
                    <div class="flex items-center gap-4">
                        <span class="text-2xl">🌦️</span>
                        <div>
                            <p class="font-semibold text-gray-900">Mon, Feb 3</p>
                            <p class="text-xs text-gray-600">Rain showers</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="text-lg font-bold text-gray-900">30°C / 24°C</p>
                        <p class="text-xs text-gray-600">Rain: 50%</p>
                    </div>
                </div>
                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition">
                    <div class="flex items-center gap-4">
                        <span class="text-2xl">🌤️</span>
                        <div>
                            <p class="font-semibold text-gray-900">Tue, Feb 4</p>
                            <p class="text-xs text-gray-600">Improving conditions</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="text-lg font-bold text-gray-900">32°C / 25°C</p>
                        <p class="text-xs text-gray-600">Rain: 25%</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Agricultural Weather Insights -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h3 class="text-lg font-bold text-gray-900 mb-4">Agricultural Weather Insights</h3>
            
            <!-- Today's Farming Conditions -->
            <div class="mb-6 p-4 bg-emerald-50 border-l-4 border-emerald-600 rounded-lg">
                <p class="font-semibold text-gray-900 mb-2">🌾 Today's Farming Conditions</p>
                <div class="space-y-2 text-sm text-gray-700">
                    <p><strong>Status:</strong> <span class="text-emerald-600 font-semibold">Excellent</span></p>
                    <p><strong>Best Activity:</strong> Harvesting, Land Preparation</p>
                    <p><strong>Soil Moisture:</strong> Moderate (45-55%)</p>
                    <p><strong>Recommendation:</strong> Ideal day for outdoor farm work. Apply fertilizers in the morning hours.</p>
                </div>
            </div>

            <!-- Rain Probability Chart -->
            <div class="mb-6">
                <p class="font-semibold text-gray-900 mb-3">💧 Weekly Rainfall Forecast</p>
                <div class="space-y-2">
                    <div class="flex items-center gap-3">
                        <span class="text-xs text-gray-600 w-16">Today</span>
                        <div class="flex-1 bg-gray-200 rounded-full h-4">
                            <div class="bg-emerald-400 h-4 rounded-full" style="width: 10%"></div>
                        </div>
                        <span class="text-xs font-semibold text-gray-700 w-12">10%</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <span class="text-xs text-gray-600 w-16">Tomorrow</span>
                        <div class="flex-1 bg-gray-200 rounded-full h-4">
                            <div class="bg-emerald-400 h-4 rounded-full" style="width: 20%"></div>
                        </div>
                        <span class="text-xs font-semibold text-gray-700 w-12">20%</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <span class="text-xs text-gray-600 w-16">Fri</span>
                        <div class="flex-1 bg-gray-200 rounded-full h-4">
                            <div class="bg-emerald-500 h-4 rounded-full" style="width: 30%"></div>
                        </div>
                        <span class="text-xs font-semibold text-gray-700 w-12">30%</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <span class="text-xs text-gray-600 w-16">Sat</span>
                        <div class="flex-1 bg-gray-200 rounded-full h-4">
                            <div class="bg-emerald-600 h-4 rounded-full" style="width: 60%"></div>
                        </div>
                        <span class="text-xs font-semibold text-gray-700 w-12">60%</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <span class="text-xs text-gray-600 w-16">Sun</span>
                        <div class="flex-1 bg-gray-200 rounded-full h-4">
                            <div class="bg-emerald-700 h-4 rounded-full" style="width: 80%"></div>
                        </div>
                        <span class="text-xs font-semibold text-gray-700 w-12">80%</span>
                    </div>
                </div>
            </div>

            <!-- Climate Summary -->
            <div class="p-4 bg-emerald-50 border-l-4 border-emerald-600 rounded-lg">
                <p class="font-semibold text-gray-900 mb-2">📊 This Week's Summary</p>
                <div class="grid grid-cols-2 gap-3 text-sm">
                    <div>
                        <p class="text-gray-600">Avg Temperature</p>
                        <p class="font-bold text-gray-900">31°C</p>
                    </div>
                    <div>
                        <p class="text-gray-600">Total Rainfall</p>
                        <p class="font-bold text-gray-900">45mm</p>
                    </div>
                    <div>
                        <p class="text-gray-600">Sunny Days</p>
                        <p class="font-bold text-gray-900">4 of 7</p>
                    </div>
                    <div>
                        <p class="text-gray-600">Humidity Avg</p>
                        <p class="font-bold text-gray-900">72%</p>
                    </div>
                </div>
            </div>

            <!-- Alerts for Farmers -->
            <div class="mt-6 p-4 bg-emerald-50 border-l-4 border-emerald-600 rounded-lg">
                <p class="font-semibold text-gray-900 mb-2">⚠️ Farmer Advisories</p>
                <ul class="space-y-1 text-sm text-gray-700">
                    <li>• Heavy rains expected this weekend - postpone spraying activities</li>
                    <li>• High UV index today - ensure adequate sun protection</li>
                    <li>• Favorable conditions for planting corn and vegetables</li>
                    <li>• Monitor water levels in irrigation canals</li>
                </ul>
            </div>
        </div>
    </div>

    <!-- HISTORICAL WEATHER DATA -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <h3 class="text-lg font-bold text-gray-900 mb-4">Historical Weather Data - Cagayan</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="p-4 bg-gradient-to-br from-purple-100 to-purple-50 rounded-lg">
                <p class="text-sm text-gray-700 font-semibold mb-2">📅 Last Month (December 2025)</p>
                <div class="space-y-2 text-sm">
                    <div class="flex justify-between">
                        <span class="text-gray-600">Avg Temp:</span>
                        <span class="font-bold text-gray-900">26°C</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Total Rain:</span>
                        <span class="font-bold text-gray-900">125mm</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Rainy Days:</span>
                        <span class="font-bold text-gray-900">12 days</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Max Temp:</span>
                        <span class="font-bold text-gray-900">32°C</span>
                    </div>
                </div>
            </div>
            <div class="p-4 bg-gradient-to-br from-indigo-100 to-indigo-50 rounded-lg">
                <p class="text-sm text-gray-700 font-semibold mb-2">📈 This Year (2026 YTD)</p>
                <div class="space-y-2 text-sm">
                    <div class="flex justify-between">
                        <span class="text-gray-600">Avg Temp:</span>
                        <span class="font-bold text-gray-900">27°C</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Total Rain:</span>
                        <span class="font-bold text-gray-900">78mm</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Dry Days:</span>
                        <span class="font-bold text-gray-900">22 days</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Typhoons:</span>
                        <span class="font-bold text-gray-900">0</span>
                    </div>
                </div>
            </div>
            <div class="p-4 bg-gradient-to-br from-teal-100 to-teal-50 rounded-lg">
                <p class="text-sm text-gray-700 font-semibold mb-2">🌍 Climate Trends</p>
                <div class="space-y-2 text-sm">
                    <div class="flex justify-between">
                        <span class="text-gray-600">vs Last Year:</span>
                        <span class="font-bold text-emerald-600">+1.2°C warmer</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Rainfall:</span>
                        <span class="font-bold text-emerald-600">-15% less</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Dry Season:</span>
                        <span class="font-bold text-emerald-600">Extended</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">El Niño:</span>
                        <span class="font-bold text-emerald-600">Weak</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</main>
<?php /**PATH C:\Users\jayso\Desktop\dev\web\Mannalon-App\resources\views/admin/weather-content.blade.php ENDPATH**/ ?>