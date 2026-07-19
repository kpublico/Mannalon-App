<main>
<div class="space-y-6">
    <!-- PROFILE SETTINGS -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <h3 class="text-lg font-bold text-gray-900 mb-4">Admin Profile Settings</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Full Name</label>
                <input type="text" value="Juan Dela Cruz" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-600">
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Email Address</label>
                <input type="email" value="admin@mannalonapp.com" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-600">
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Current Password</label>
                <input type="password" placeholder="Enter current password to change settings" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-600">
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">New Password</label>
                <input type="password" placeholder="Leave blank to keep current password" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-600">
            </div>
        </div>
        <button class="mt-4 px-6 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 transition font-semibold">
            <i class="fas fa-save mr-2"></i>Save Profile Changes
        </button>
    </div>

    <!-- APP CONFIGURATION -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <h3 class="text-lg font-bold text-gray-900 mb-4">Application Configuration</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">App Name</label>
                <input type="text" value="MannalonApp" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-600">
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Support Email</label>
                <input type="email" value="support@mannalonapp.com" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-600">
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Support Phone</label>
                <input type="tel" value="+94-11-234-5678" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-600">
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Primary Brand Color</label>
                <div class="flex gap-2">
                    <input type="color" value="#059669" class="w-16 h-10 border border-gray-300 rounded-lg cursor-pointer">
                    <input type="text" value="#059669 (Emerald)" class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-600">
                </div>
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Upload App Logo</label>
                <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center">
                    <i class="fas fa-cloud-upload-alt text-3xl text-gray-400 mb-2"></i>
                    <p class="text-sm text-gray-600">Drag and drop or <span class="text-blue-600 cursor-pointer">click to upload</span></p>
                    <p class="text-xs text-gray-500 mt-1">Max 5MB | PNG, JPG, SVG</p>
                </div>
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Timezone</label>
                <select class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-600">
                    <option selected>UTC+5:30 (Asia/Colombo)</option>
                    <option>UTC+8:00 (Asia/Manila)</option>
                    <option>UTC+0:00 (GMT)</option>
                    <option>UTC-5:00 (EST)</option>
                </select>
            </div>
        </div>
        <button class="mt-4 px-6 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 transition font-semibold">
            <i class="fas fa-save mr-2"></i>Save Configuration
        </button>
    </div>

    <!-- SYSTEM LOGS -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <h3 class="text-lg font-bold text-gray-900 mb-4">System Logs & Performance</h3>
        <div class="flex gap-3 mb-6">
            <button class="px-4 py-2 bg-white text-emerald-600 border-2 border-emerald-600 rounded-lg hover:bg-emerald-50 transition font-semibold">
                <i class="fas fa-eye mr-2"></i>View Full Logs
            </button>
            <button class="px-4 py-2 bg-white text-emerald-600 border-2 border-emerald-600 rounded-lg hover:bg-emerald-50 transition font-semibold">
                <i class="fas fa-download mr-2"></i>Export Logs
            </button>
            <button class="px-4 py-2 bg-white text-emerald-600 border-2 border-emerald-600 rounded-lg hover:bg-emerald-50 transition font-semibold">
                <i class="fas fa-trash mr-2"></i>Clear Logs
            </button>
        </div>
        
        <!-- System Logs Summary -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
            <div class="bg-emerald-50 rounded-lg p-4 border-l-4 border-emerald-600">
                <p class="text-gray-700 text-sm font-medium">Today's Events</p>
                <p class="text-3xl font-bold text-emerald-600 mt-2">24</p>
                <p class="text-xs text-gray-600 mt-1">System activities</p>
            </div>
            <div class="bg-emerald-50 rounded-lg p-4 border-l-4 border-emerald-600">
                <p class="text-gray-700 text-sm font-medium">Errors</p>
                <p class="text-3xl font-bold text-emerald-600 mt-2">0</p>
                <p class="text-xs text-gray-600 mt-1">No critical errors</p>
            </div>
            <div class="bg-emerald-50 rounded-lg p-4 border-l-4 border-emerald-600">
                <p class="text-gray-700 text-sm font-medium">Warnings</p>
                <p class="text-3xl font-bold text-emerald-600 mt-2">1</p>
                <p class="text-xs text-gray-600 mt-1">High memory usage</p>
            </div>
            <div class="bg-emerald-50 rounded-lg p-4 border-l-4 border-emerald-600">
                <p class="text-gray-700 text-sm font-medium">Last Update</p>
                <p class="text-lg font-bold text-emerald-600 mt-2">Just now</p>
                <p class="text-xs text-gray-600 mt-1">2:45 PM Today</p>
            </div>
        </div>

        <!-- Recent Activities -->
        <div class="space-y-3">
            <h4 class="font-semibold text-gray-800 text-sm mb-4">Recent System Activities</h4>
            <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg border-l-4 border-emerald-600">
                <div class="flex items-center gap-3">
                    <div class="bg-emerald-100 rounded-full p-2">
                        <i class="fas fa-sign-in-alt text-emerald-600"></i>
                    </div>
                    <div>
                        <p class="font-semibold text-gray-800 text-sm">Admin Login</p>
                        <p class="text-xs text-gray-600">juan@email.com</p>
                    </div>
                </div>
                <span class="text-xs text-gray-600">10:45 AM</span>
            </div>
            <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg border-l-4 border-emerald-600">
                <div class="flex items-center gap-3">
                    <div class="bg-emerald-100 rounded-full p-2">
                        <i class="fas fa-user-plus text-emerald-600"></i>
                    </div>
                    <div>
                        <p class="font-semibold text-gray-800 text-sm">Farmer Record Created</p>
                        <p class="text-xs text-gray-600">New farmer ID: 245</p>
                    </div>
                </div>
                <span class="text-xs text-gray-600">10:42 AM</span>
            </div>
            <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg border-l-4 border-yellow-600">
                <div class="flex items-center gap-3">
                    <div class="bg-yellow-100 rounded-full p-2">
                        <i class="fas fa-exclamation-triangle text-yellow-600"></i>
                    </div>
                    <div>
                        <p class="font-semibold text-gray-800 text-sm">High Memory Usage</p>
                        <p class="text-xs text-gray-600">78% of total capacity</p>
                    </div>
                </div>
                <span class="text-xs text-gray-600">10:39 AM</span>
            </div>
            <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg border-l-4 border-emerald-600">
                <div class="flex items-center gap-3">
                    <div class="bg-emerald-100 rounded-full p-2">
                        <i class="fas fa-database text-emerald-600"></i>
                    </div>
                    <div>
                        <p class="font-semibold text-gray-800 text-sm">Database Backup</p>
                        <p class="text-xs text-gray-600">Completed successfully</p>
                    </div>
                </div>
                <span class="text-xs text-gray-600">10:35 AM</span>
            </div>
            <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg border-l-4 border-emerald-600">
                <div class="flex items-center gap-3">
                    <div class="bg-emerald-100 rounded-full p-2">
                        <i class="fas fa-cloud-sun text-emerald-600"></i>
                    </div>
                    <div>
                        <p class="font-semibold text-gray-800 text-sm">Weather Data Sync</p>
                        <p class="text-xs text-gray-600">Updated from external API</p>
                    </div>
                </div>
                <span class="text-xs text-gray-600">10:30 AM</span>
            </div>
        </div>
    </div>

    <!-- SYSTEM STATS -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <div class="bg-emerald-50 rounded-lg p-4 border-l-4 border-emerald-600">
            <p class="text-gray-700 text-sm font-medium">Server Status</p>
            <p class="text-lg font-bold text-emerald-600 mt-2">✓ Online</p>
            <p class="text-xs text-gray-600 mt-1">Uptime: 99.9%</p>
        </div>
        <div class="bg-emerald-50 rounded-lg p-4 border-l-4 border-emerald-600">
            <p class="text-gray-700 text-sm font-medium">Database</p>
            <p class="text-lg font-bold text-emerald-600 mt-2">✓ Connected</p>
            <p class="text-xs text-gray-600 mt-1">Response: 12ms</p>
        </div>
        <div class="bg-emerald-50 rounded-lg p-4 border-l-4 border-emerald-600">
            <p class="text-gray-700 text-sm font-medium">Memory Usage</p>
            <p class="text-lg font-bold text-emerald-600 mt-2">78%</p>
            <p class="text-xs text-gray-600 mt-1">1.2GB / 1.5GB</p>
        </div>
        <div class="bg-emerald-50 rounded-lg p-4 border-l-4 border-emerald-600">
            <p class="text-gray-700 text-sm font-medium">Last Backup</p>
            <p class="text-lg font-bold text-emerald-600 mt-2">Jan 29</p>
            <p class="text-xs text-gray-600 mt-1">2:15 AM - Success</p>
        </div>
    </div>
</div>
</main>
<?php /**PATH C:\xampp\htdocs\Mannalon_App\resources\views/admin/settings-content.blade.php ENDPATH**/ ?>