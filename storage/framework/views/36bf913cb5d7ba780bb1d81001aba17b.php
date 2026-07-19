<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - MannalonApp</title>
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

        .wave-pattern {
            position: relative;
            overflow: hidden;
        }

        .wave-pattern::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 60px;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 60"><path d="M0,30 Q150,0 300,30 T600,30 T900,30 T1200,30 L1200,60 L0,60" fill="rgba(255,255,255,0.1)"/></svg>') repeat-x;
            background-size: 600px 60px;
        }

        .stat-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(16, 185, 129, 0.15);
        }

        .service-grid-item {
            transition: all 0.3s ease;
        }

        .service-grid-item:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        }

        .alert-badge {
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0%, 100% {
                opacity: 1;
            }
            50% {
                opacity: 0.7;
            }
        }

        .header-bar {
            background: white;
            border-bottom: 1px solid #e5e7eb;
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .user-avatar {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            background: #10b981;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <!-- Top Navigation Header -->
    <nav class="emerald-gradient text-white px-6 py-4 shadow-md">
        <div class="flex justify-between items-center">
            <h1 class="text-2xl font-bold">🌾 MannalonApp</h1>
            <div class="flex items-center gap-6">
                <a href="#" class="hover:text-emerald-100 transition">Dashboard</a>
                <a href="#" class="hover:text-emerald-100 transition">Services</a>
                <a href="#" class="hover:text-emerald-100 transition">Announcements</a>
                <form action="<?php echo e(route('logout')); ?>" method="POST" class="inline">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="hover:text-emerald-100 transition">Logout</button>
                </form>
            </div>
        </div>
    </nav>

    <!-- Secondary Header with User Info -->
    <div class="header-bar">
        <div class="user-info">
            <div class="user-avatar"><?php echo e(strtoupper(substr(auth()->user()->name, 0, 1))); ?></div>
            <div>
                <p class="font-semibold text-gray-800"><?php echo e(auth()->user()->name); ?></p>
                <p class="text-sm text-gray-500"><?php echo e(ucfirst(auth()->user()->role)); ?> • <?php echo e(auth()->user()->barangay ?? 'N/A'); ?></p>
            </div>
        </div>
        <div class="text-sm text-gray-600">
            <span><?php echo e(now()->format('l, M d, Y')); ?></span>
        </div>
    </div>

    <?php if(auth()->user()->role === 'farmer'): ?>
        <!-- ============ FARMER DASHBOARD ============ -->
        <div class="p-6 max-w-7xl mx-auto">
            
            <!-- Welcome Banner -->
            <div class="emerald-gradient text-white rounded-lg p-8 mb-8 wave-pattern">
                <div class="flex justify-between items-start relative z-10">
                    <div>
                        <h2 class="text-3xl font-bold mb-2">Welcome to MannalonApp, <?php echo e(auth()->user()->name); ?>!</h2>
                        <p class="text-emerald-50">Your gateway to modern agriculture services and farm management.</p>
                    </div>
                    <div class="flex gap-3">
                        <button class="bg-white text-emerald-700 px-6 py-2 rounded-lg font-semibold hover:bg-emerald-50 transition">
                            📋 Request Assistance
                        </button>
                        <button class="border-2 border-white text-white px-6 py-2 rounded-lg font-semibold hover:bg-emerald-700 transition">
                            📊 View Farm Stats
                        </button>
                    </div>
                </div>
            </div>

            <!-- Stats Grid -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                <!-- Active Requests -->
                <div class="stat-card bg-white p-6 rounded-lg shadow-sm border-t-4 border-emerald-500">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500 text-sm">Active Requests</p>
                            <p class="text-3xl font-bold text-gray-800"><?php echo e($activeRequests ?? 0); ?></p>
                        </div>
                        <div class="text-4xl text-emerald-500">📄</div>
                    </div>
                </div>

                <!-- Payouts/Subsidies Ready -->
                <div class="stat-card bg-white p-6 rounded-lg shadow-sm border-t-4 border-yellow-500">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500 text-sm">Subsidies Ready</p>
                            <p class="text-3xl font-bold text-gray-800">₱<?php echo e($subsidiesReady ?? '0'); ?></p>
                        </div>
                        <div class="text-4xl text-yellow-500">⭐</div>
                    </div>
                </div>

                <!-- Completed Harvests -->
                <div class="stat-card bg-white p-6 rounded-lg shadow-sm border-t-4 border-blue-500">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500 text-sm">Completed Harvests</p>
                            <p class="text-3xl font-bold text-gray-800"><?php echo e($completedHarvests ?? 0); ?></p>
                        </div>
                        <div class="text-4xl text-blue-500">✓</div>
                    </div>
                </div>

                <!-- Weather/Pest Alerts -->
                <div class="stat-card bg-white p-6 rounded-lg shadow-sm border-t-4 border-red-500">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500 text-sm">Alerts</p>
                            <p class="text-3xl font-bold text-gray-800"><?php echo e($alerts ?? 0); ?></p>
                        </div>
                        <div class="text-4xl text-red-500">🔔</div>
                    </div>
                </div>
            </div>

            <!-- Main Content Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-8">
                <!-- Farm Services (Left) -->
                <div class="lg:col-span-2">
                    <h3 class="text-2xl font-bold text-gray-800 mb-6">Farm Services</h3>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="service-grid-item bg-white p-6 rounded-lg shadow-sm hover:shadow-md border-l-4 border-emerald-500">
                            <p class="text-3xl mb-2">📋</p>
                            <h4 class="font-semibold text-gray-800">Business Permit</h4>
                            <p class="text-sm text-gray-500 mt-2">Manage your farm permits</p>
                            <a href="#" class="text-emerald-600 text-sm font-semibold mt-4 inline-block hover:underline">Learn more →</a>
                        </div>

                        <div class="service-grid-item bg-white p-6 rounded-lg shadow-sm hover:shadow-md border-l-4 border-emerald-500">
                            <p class="text-3xl mb-2">🌱</p>
                            <h4 class="font-semibold text-gray-800">Fertilizer Subsidy</h4>
                            <p class="text-sm text-gray-500 mt-2">Apply for subsidies</p>
                            <a href="#" class="text-emerald-600 text-sm font-semibold mt-4 inline-block hover:underline">Learn more →</a>
                        </div>

                        <div class="service-grid-item bg-white p-6 rounded-lg shadow-sm hover:shadow-md border-l-4 border-emerald-500">
                            <p class="text-3xl mb-2">🚜</p>
                            <h4 class="font-semibold text-gray-800">Equipment Rental</h4>
                            <p class="text-sm text-gray-500 mt-2">Rent farm equipment</p>
                            <a href="#" class="text-emerald-600 text-sm font-semibold mt-4 inline-block hover:underline">Learn more →</a>
                        </div>

                        <div class="service-grid-item bg-white p-6 rounded-lg shadow-sm hover:shadow-md border-l-4 border-emerald-500">
                            <p class="text-3xl mb-2">🌾</p>
                            <h4 class="font-semibold text-gray-800">Seed Distribution</h4>
                            <p class="text-sm text-gray-500 mt-2">Get quality seeds</p>
                            <a href="#" class="text-emerald-600 text-sm font-semibold mt-4 inline-block hover:underline">Learn more →</a>
                        </div>
                    </div>
                </div>

                <!-- Profile Status (Right) -->
                <div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-6">Profile Status</h3>
                    <div class="bg-white p-6 rounded-lg shadow-sm space-y-4">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <span class="text-2xl">✓</span>
                                <span class="text-gray-700">Email Verified</span>
                            </div>
                            <span class="bg-emerald-100 text-emerald-800 px-3 py-1 rounded-full text-sm font-semibold">Active</span>
                        </div>
                        <div class="h-px bg-gray-200"></div>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <span class="text-2xl"><?php echo e(auth()->user()->role === 'farmer' ? '✓' : '⏳'); ?></span>
                                <span class="text-gray-700">RSBSA Linked</span>
                            </div>
                            <span class="bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full text-sm font-semibold">Pending</span>
                        </div>
                        <div class="h-px bg-gray-200"></div>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <span class="text-2xl">⏳</span>
                                <span class="text-gray-700">Gov ID Verified</span>
                            </div>
                            <span class="bg-gray-100 text-gray-800 px-3 py-1 rounded-full text-sm font-semibold">Pending</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Announcements Section -->
            <div class="bg-white rounded-lg shadow-sm p-6 mb-8">
                <h3 class="text-2xl font-bold text-gray-800 mb-4">📢 Municipal Agriculture Office Updates</h3>
                <div class="space-y-4">
                    <div class="border-l-4 border-emerald-500 pl-4 py-2">
                        <p class="font-semibold text-gray-800">New Fertilizer Subsidy Program Open</p>
                        <p class="text-sm text-gray-600 mt-1">Applications now open for Q1 2026 fertilizer assistance. Deadline: February 15, 2026.</p>
                    </div>
                    <div class="h-px bg-gray-200"></div>
                    <div class="border-l-4 border-emerald-500 pl-4 py-2">
                        <p class="font-semibold text-gray-800">Weather Alert: Strong Winds Expected</p>
                        <p class="text-sm text-gray-600 mt-1">Department warning of strong winds on January 28-29. Secure your crops accordingly.</p>
                    </div>
                    <div class="h-px bg-gray-200"></div>
                    <div class="border-l-4 border-emerald-500 pl-4 py-2">
                        <p class="font-semibold text-gray-800">Training Workshop: Sustainable Farming</p>
                        <p class="text-sm text-gray-600 mt-1">Free workshop on sustainable farming practices. February 20, 2026 at the Municipal Hall.</p>
                    </div>
                </div>
            </div>

        </div>

    <?php elseif(auth()->user()->role === 'admin'): ?>
        <!-- ============ ADMIN DASHBOARD ============ -->
        <div class="p-6 max-w-7xl mx-auto">
            
            <!-- Welcome Banner -->
            <div class="emerald-gradient text-white rounded-lg p-8 mb-8 wave-pattern">
                <div class="flex justify-between items-start relative z-10">
                    <div>
                        <h2 class="text-3xl font-bold mb-2">Agriculture Management Portal</h2>
                        <p class="text-emerald-50">Overview for Municipality of <?php echo e(auth()->user()->city ?? 'Buguey'); ?></p>
                    </div>
                    <div class="flex gap-3">
                        <button class="bg-white text-emerald-700 px-6 py-2 rounded-lg font-semibold hover:bg-emerald-50 transition">
                            📝 Post Announcement
                        </button>
                        <button class="border-2 border-white text-white px-6 py-2 rounded-lg font-semibold hover:bg-emerald-700 transition">
                            📊 Generate Reports
                        </button>
                    </div>
                </div>
            </div>

            <!-- Verification Alert Badge -->
            <?php if(($pendingVerifications ?? 0) > 0): ?>
            <div class="alert-badge bg-red-100 border-l-4 border-red-500 text-red-800 p-4 rounded mb-8 flex items-center gap-3">
                <span class="text-2xl">⚠️</span>
                <div>
                    <p class="font-bold"><?php echo e($pendingVerifications); ?> Pending Verifications</p>
                    <p class="text-sm">New farmer registrations awaiting approval</p>
                </div>
            </div>
            <?php endif; ?>

            <!-- Stats Grid -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                <!-- Total Registered Farmers -->
                <div class="stat-card bg-white p-6 rounded-lg shadow-sm border-t-4 border-emerald-500">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500 text-sm">Total Registered Farmers</p>
                            <p class="text-3xl font-bold text-gray-800"><?php echo e($totalFarmers ?? 0); ?></p>
                        </div>
                        <div class="text-4xl text-emerald-500">👨‍🌾</div>
                    </div>
                </div>

                <!-- Pending Verifications -->
                <div class="stat-card bg-white p-6 rounded-lg shadow-sm border-t-4 border-yellow-500">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500 text-sm">Pending Verifications</p>
                            <p class="text-3xl font-bold text-gray-800"><?php echo e($pendingVerifications ?? 0); ?></p>
                        </div>
                        <div class="text-4xl text-yellow-500">⏳</div>
                    </div>
                </div>

                <!-- Total Distribution Requests -->
                <div class="stat-card bg-white p-6 rounded-lg shadow-sm border-t-4 border-blue-500">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500 text-sm">Distribution Requests</p>
                            <p class="text-3xl font-bold text-gray-800"><?php echo e($distributionRequests ?? 0); ?></p>
                        </div>
                        <div class="text-4xl text-blue-500">📦</div>
                    </div>
                </div>

                <!-- System Alerts -->
                <div class="stat-card bg-white p-6 rounded-lg shadow-sm border-t-4 border-red-500">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500 text-sm">System Alerts</p>
                            <p class="text-3xl font-bold text-gray-800"><?php echo e($systemAlerts ?? 0); ?></p>
                        </div>
                        <div class="text-4xl text-red-500">🚨</div>
                    </div>
                </div>
            </div>

            <!-- Main Content Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-8">
                <!-- Management Tools (Left) -->
                <div class="lg:col-span-2">
                    <h3 class="text-2xl font-bold text-gray-800 mb-6">Management Tools</h3>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="service-grid-item bg-white p-6 rounded-lg shadow-sm hover:shadow-md border-l-4 border-emerald-500">
                            <p class="text-3xl mb-2">✓</p>
                            <h4 class="font-semibold text-gray-800">User Approval</h4>
                            <p class="text-sm text-gray-500 mt-2">Verify & approve new farmers</p>
                            <a href="#" class="text-emerald-600 text-sm font-semibold mt-4 inline-block hover:underline">Manage →</a>
                        </div>

                        <div class="service-grid-item bg-white p-6 rounded-lg shadow-sm hover:shadow-md border-l-4 border-emerald-500">
                            <p class="text-3xl mb-2">📊</p>
                            <h4 class="font-semibold text-gray-800">Inventory Management</h4>
                            <p class="text-sm text-gray-500 mt-2">Track distribution items</p>
                            <a href="#" class="text-emerald-600 text-sm font-semibold mt-4 inline-block hover:underline">Manage →</a>
                        </div>

                        <div class="service-grid-item bg-white p-6 rounded-lg shadow-sm hover:shadow-md border-l-4 border-emerald-500">
                            <p class="text-3xl mb-2">🗺️</p>
                            <h4 class="font-semibold text-gray-800">GIS Farm Mapping</h4>
                            <p class="text-sm text-gray-500 mt-2">View farm locations on map</p>
                            <a href="#" class="text-emerald-600 text-sm font-semibold mt-4 inline-block hover:underline">View Map →</a>
                        </div>

                        <div class="service-grid-item bg-white p-6 rounded-lg shadow-sm hover:shadow-md border-l-4 border-emerald-500">
                            <p class="text-3xl mb-2">📈</p>
                            <h4 class="font-semibold text-gray-800">Data Analytics</h4>
                            <p class="text-sm text-gray-500 mt-2">Agricultural insights & reports</p>
                            <a href="#" class="text-emerald-600 text-sm font-semibold mt-4 inline-block hover:underline">Analyze →</a>
                        </div>
                    </div>
                </div>

                <!-- System Health (Right) -->
                <div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-6">System Health</h3>
                    <div class="bg-white p-6 rounded-lg shadow-sm space-y-4">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <span class="text-2xl">✓</span>
                                <span class="text-gray-700">Server Status</span>
                            </div>
                            <span class="bg-emerald-100 text-emerald-800 px-3 py-1 rounded-full text-sm font-semibold">Online</span>
                        </div>
                        <div class="h-px bg-gray-200"></div>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <span class="text-2xl">✓</span>
                                <span class="text-gray-700">Database</span>
                            </div>
                            <span class="bg-emerald-100 text-emerald-800 px-3 py-1 rounded-full text-sm font-semibold">Healthy</span>
                        </div>
                        <div class="h-px bg-gray-200"></div>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <span class="text-2xl">✓</span>
                                <span class="text-gray-700">Email Service</span>
                            </div>
                            <span class="bg-emerald-100 text-emerald-800 px-3 py-1 rounded-full text-sm font-semibold">Active</span>
                        </div>
                    </div>

                    <div class="bg-white p-6 rounded-lg shadow-sm mt-6">
                        <h4 class="font-bold text-gray-800 mb-4">Recent Admin Logs</h4>
                        <div class="space-y-3 text-sm">
                            <div class="text-gray-700">
                                <span class="text-gray-500">Just now:</span> Admin Smith verified 3 farmers
                            </div>
                            <div class="text-gray-700">
                                <span class="text-gray-500">2 hours ago:</span> Fertilizer stock updated
                            </div>
                            <div class="text-gray-700">
                                <span class="text-gray-500">Today:</span> Weather alert posted
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Farmer Registrations Table -->
            <div class="bg-white rounded-lg shadow-sm p-6">
                <h3 class="text-2xl font-bold text-gray-800 mb-6">Recent Farmer Registrations</h3>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="border-b-2 border-gray-200">
                                <th class="text-left py-3 px-4 text-gray-700 font-semibold">Name</th>
                                <th class="text-left py-3 px-4 text-gray-700 font-semibold">Email</th>
                                <th class="text-left py-3 px-4 text-gray-700 font-semibold">Barangay</th>
                                <th class="text-left py-3 px-4 text-gray-700 font-semibold">Status</th>
                                <th class="text-center py-3 px-4 text-gray-700 font-semibold">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            <tr class="border-b border-gray-100 hover:bg-gray-50">
                                <td class="py-3 px-4">Juan Dela Cruz</td>
                                <td class="py-3 px-4">juan@example.com</td>
                                <td class="py-3 px-4">Calagawan</td>
                                <td class="py-3 px-4"><span class="bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full text-sm">Pending</span></td>
                                <td class="py-3 px-4 text-center">
                                    <button class="text-emerald-600 hover:text-emerald-800 font-semibold mr-3">Verify</button>
                                    <button class="text-blue-600 hover:text-blue-800 font-semibold">View</button>
                                </td>
                            </tr>
                            <tr class="border-b border-gray-100 hover:bg-gray-50">
                                <td class="py-3 px-4">Maria Santos</td>
                                <td class="py-3 px-4">maria@example.com</td>
                                <td class="py-3 px-4">Bangcal</td>
                                <td class="py-3 px-4"><span class="bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full text-sm">Pending</span></td>
                                <td class="py-3 px-4 text-center">
                                    <button class="text-emerald-600 hover:text-emerald-800 font-semibold mr-3">Verify</button>
                                    <button class="text-blue-600 hover:text-blue-800 font-semibold">View</button>
                                </td>
                            </tr>
                            <tr class="border-b border-gray-100 hover:bg-gray-50">
                                <td class="py-3 px-4">Pedro Reyes</td>
                                <td class="py-3 px-4">pedro@example.com</td>
                                <td class="py-3 px-4">Camalaniugan</td>
                                <td class="py-3 px-4"><span class="bg-emerald-100 text-emerald-800 px-3 py-1 rounded-full text-sm">Verified</span></td>
                                <td class="py-3 px-4 text-center">
                                    <button class="text-blue-600 hover:text-blue-800 font-semibold">View</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    <?php endif; ?>

</body>
</html>
<?php /**PATH C:\xampp\htdocs\Mannalon_App\resources\views\dashboard\main.blade.php ENDPATH**/ ?>