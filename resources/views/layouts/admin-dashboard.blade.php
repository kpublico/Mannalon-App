<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') - Admin Panel | MannalonApp</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .admin-sidebar-link {
            transition: all 0.3s ease;
            color: #374151;
        }
        .admin-sidebar-link:hover {
            background: #ecfdf5;
            color: #059669;
            transform: translateX(5px);
        }
        .admin-sidebar-link.active {
            background: #059669;
            color: white;
            border-left: 4px solid #047857;
        }
    </style>
</head>
<body class="bg-gray-100">
    @php $isSuperAdmin = auth()->check() && auth()->user()->isSuperAdmin(); @endphp
    <div class="flex h-screen overflow-hidden bg-gray-100">
        <!-- Admin Sidebar -->
        <aside class="w-64 bg-white text-gray-800 flex-shrink-0 hidden md:block shadow-xl border-r-2 border-emerald-500 fixed h-full left-0 top-0 z-40">
            <div class="p-6 bg-gradient-to-r from-emerald-600 to-emerald-700">
                <div class="flex items-center gap-3 mb-2">
                    <div class="w-10 h-10 bg-white rounded-full flex items-center justify-center">
                        <span class="text-2xl">🌾</span>
                    </div>
                    <div>
                        <h2 class="text-xl font-bold text-white">MannalonApp</h2>
                        <p class="text-xs text-emerald-100">{{ $isSuperAdmin ? 'Super Admin Control Panel' : 'Admin Control Panel' }}</p>
                    </div>
                </div>
                <div class="mt-3 bg-white/20 rounded-lg px-3 py-2">
                    <p class="text-xs text-emerald-100">Welcome back</p>
                    <p class="text-sm font-semibold text-white">{{ auth()->user()->name ?? 'Administrator' }}</p>
                </div>
            </div>

            <nav class="p-4 space-y-2 overflow-y-auto" style="max-height: calc(100vh - 180px);">
                <a href="javascript:void(0)" onclick="loadAdminPage('dashboard', '{{ route('admin.dashboard') }}')" class="sidebar-nav-link admin-sidebar-link flex items-center gap-3 px-4 py-3 rounded-lg active" data-page="dashboard">
                    <i class="fas fa-chart-line w-5"></i>
                    <span>Dashboard</span>
                </a>

                @if($isSuperAdmin)
                    <a href="javascript:void(0)" onclick="loadAdminPage('users', '{{ route('admin.users.index') }}')" class="sidebar-nav-link admin-sidebar-link flex items-center gap-3 px-4 py-3 rounded-lg" data-page="users">
                        <i class="fas fa-user-shield w-5"></i>
                        <span>User Management</span>
                    </a>

                    <a href="javascript:void(0)" onclick="loadAdminPage('reports-analytics', '{{ route('admin.reports-analytics') }}')" class="sidebar-nav-link admin-sidebar-link flex items-center gap-3 px-4 py-3 rounded-lg" data-page="reports-analytics">
                        <i class="fas fa-chart-pie w-5"></i>
                        <span>Global Reports</span>
                    </a>

                    <a href="javascript:void(0)" onclick="loadAdminPage('settings', '{{ route('admin.settings') }}')" class="sidebar-nav-link admin-sidebar-link flex items-center gap-3 px-4 py-3 rounded-lg" data-page="settings">
                        <i class="fas fa-cog w-5"></i>
                        <span>System Settings</span>
                    </a>
                @else
                    <a href="javascript:void(0)" onclick="loadAdminPage('farmers', '{{ route('admin.farmers.index') }}')" class="sidebar-nav-link admin-sidebar-link flex items-center gap-3 px-4 py-3 rounded-lg" data-page="farmers">
                        <i class="fas fa-users w-5"></i>
                        <span>Farmer Information</span>
                    </a>

                    <a href="javascript:void(0)" onclick="loadAdminPage('announcements', '{{ route('admin.announcements.index') }}')" class="sidebar-nav-link admin-sidebar-link flex items-center gap-3 px-4 py-3 rounded-lg" data-page="announcements">
                        <i class="fas fa-bullhorn w-5"></i>
                        <span>Announcements</span>
                    </a>

                    <a href="javascript:void(0)" onclick="loadAdminPage('guides', '{{ route('admin.guides.index') }}')" class="sidebar-nav-link admin-sidebar-link flex items-center gap-3 px-4 py-3 rounded-lg" data-page="guides">
                        <i class="fas fa-book-open w-5"></i>
                        <span>Farming Guides</span>
                    </a>

                    <a href="javascript:void(0)" onclick="loadAdminPage('weather', '{{ route('admin.weather.index') }}')" class="sidebar-nav-link admin-sidebar-link flex items-center gap-3 px-4 py-3 rounded-lg" data-page="weather">
                        <i class="fas fa-cloud-sun w-5"></i>
                        <span>Weather Updates</span>
                    </a>

                    <a href="javascript:void(0)" onclick="loadAdminPage('market-prices', '{{ route('admin.market-prices.index') }}')" class="sidebar-nav-link admin-sidebar-link flex items-center gap-3 px-4 py-3 rounded-lg" data-page="market-prices">
                        <i class="fas fa-chart-bar w-5"></i>
                        <span>Current Commodity Prices</span>
                    </a>

                    <a href="javascript:void(0)" onclick="loadAdminPage('reports-analytics', '{{ route('admin.reports-analytics') }}')" class="sidebar-nav-link admin-sidebar-link flex items-center gap-3 px-4 py-3 rounded-lg" data-page="reports-analytics">
                        <i class="fas fa-chart-line w-5"></i>
                        <span>Reports & Analytics</span>
                    </a>

                    <a href="javascript:void(0)" onclick="loadAdminPage('land-management', '{{ route('admin.land.index') }}')" class="sidebar-nav-link admin-sidebar-link flex items-center gap-3 px-4 py-3 rounded-lg" data-page="land-management">
                        <i class="fas fa-map-marked-alt w-5"></i>
                        <span>Land Management</span>
                    </a>

                    <a href="javascript:void(0)" onclick="loadAdminPage('settings', '{{ route('admin.settings') }}')" class="sidebar-nav-link admin-sidebar-link flex items-center gap-3 px-4 py-3 rounded-lg" data-page="settings">
                        <i class="fas fa-cog w-5"></i>
                        <span>Settings</span>
                    </a>
                @endif

                <div class="pt-4 mt-4 border-t border-gray-200">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="admin-sidebar-link flex items-center gap-3 px-4 py-3 rounded-lg w-full text-left text-red-600 hover:bg-red-50">
                            <i class="fas fa-sign-out-alt w-5"></i>
                            <span>Logout</span>
                        </button>
                    </form>
                </div>
            </nav>
        </aside>

        <!-- Main Content Area -->
        <div class="flex-1 flex flex-col overflow-hidden md:ml-64">
            <!-- Top Header with Admin Badge -->
            <header class="bg-white shadow-md px-6 py-4 flex items-center justify-between border-b-4 border-emerald-600 flex-shrink-0">
                <div>
                    <div class="flex items-center gap-3 mb-1">
                        <h1 id="page-title" class="text-2xl font-bold text-gray-800">Dashboard</h1>
                        <span class="px-3 py-1 {{ $isSuperAdmin ? 'bg-indigo-700' : 'bg-red-600' }} text-white text-xs font-bold rounded-full">{{ $isSuperAdmin ? 'SUPER ADMIN' : 'ADMIN' }}</span>
                    </div>
                    <p id="page-subtitle" class="text-sm text-gray-500">Manage your agricultural platform</p>
                </div>
                <div class="flex items-center gap-4">
                    <button class="relative p-2 text-gray-600 hover:text-emerald-600 transition">
                        <i class="fas fa-bell text-xl"></i>
                        <span class="absolute top-0 right-0 w-2 h-2 bg-red-500 rounded-full"></span>
                    </button>
                    <div class="flex items-center gap-3">
                        <div class="text-right">
                            <p class="text-sm font-semibold text-gray-800">{{ auth()->user()->name ?? 'Admin' }}</p>
                            <p class="text-xs text-gray-500">{{ $isSuperAdmin ? 'System Owner' : 'System Administrator' }}</p>
                        </div>
                        <div class="w-10 h-10 bg-emerald-600 rounded-full flex items-center justify-center text-white font-bold">
                            {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
                        </div>
                    </div>
                </div>
            </header>

            <!-- Content -->
            <main id="admin-content" class="flex-1 overflow-y-auto bg-gray-50">
                <div class="mx-auto max-w-7xl px-6 py-8">
                    @yield('content')
                </div>
            </main>
        </div>
    </div>

    @php
        $pageInfoData = $isSuperAdmin
            ? [
                'dashboard' => ['title' => 'Super Admin Dashboard', 'subtitle' => 'System governance and account oversight'],
                'users' => ['title' => 'User Management', 'subtitle' => 'Manage roles, account status, and hierarchy'],
                'reports-analytics' => ['title' => 'Global Reports', 'subtitle' => 'Platform-wide analytics and high-level reporting'],
                'settings' => ['title' => 'System Settings', 'subtitle' => 'Configure system-wide settings and policies'],
            ]
            : [
                'dashboard' => ['title' => 'Admin Dashboard', 'subtitle' => 'Operational overview for assigned agricultural modules'],
                'farmers' => ['title' => 'Farmer Information', 'subtitle' => 'Manage and view all registered farmers'],
                'announcements' => ['title' => 'Announcements', 'subtitle' => 'Create and manage announcements for farmers'],
                'guides' => ['title' => 'Farming Guides', 'subtitle' => 'Create and manage farming guides'],
                'weather' => ['title' => 'Weather Updates', 'subtitle' => 'Manage and update weather information'],
                'market-prices' => ['title' => 'Current Commodity Prices', 'subtitle' => 'Update and manage agricultural market prices'],
                'reports-analytics' => ['title' => 'Reports & Analytics', 'subtitle' => 'View operational reports and analytics'],
                'land-management' => ['title' => 'Land Management', 'subtitle' => 'Land records, service access, and beneficiary distribution'],
                'settings' => ['title' => 'Module Settings', 'subtitle' => 'Configure module preferences and operational settings'],
            ];
    @endphp
    <script>
        // Page titles and subtitles mapping
        const pageInfo = @json($pageInfoData);

        // Load admin page via AJAX
        function loadAdminPage(page, url) {
            const contentArea = document.getElementById('admin-content');
            const contentWrapper = contentArea.querySelector('.mx-auto');
            const pageTitle = document.getElementById('page-title');
            const pageSubtitle = document.getElementById('page-subtitle');

            // Show loading state
            contentWrapper.innerHTML = `
                <div class="flex items-center justify-center h-96">
                    <div class="text-center">
                        <div class="inline-block">
                            <div class="w-12 h-12 border-4 border-emerald-200 border-t-emerald-600 rounded-full animate-spin"></div>
                        </div>
                        <p class="mt-4 text-gray-600 font-semibold">Loading...</p>
                    </div>
                </div>
            `;

            // Update header
            const info = pageInfo[page];
            if (info) {
                pageTitle.textContent = info.title;
                pageSubtitle.textContent = info.subtitle;
            }

            // Fetch content
            fetch(url, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'text/html'
                }
            })
            .then(response => {
                if (!response.ok) throw new Error('Network response was not ok');
                return response.text();
            })
            .then(html => {
                // Extract only the content section from the response
                const parser = new DOMParser();
                const doc = parser.parseFromString(html, 'text/html');
                const content = doc.querySelector('main') || doc.body;
                contentWrapper.innerHTML = content.innerHTML;
                
                // Execute any scripts in the loaded content
                const scripts = content.querySelectorAll('script');
                scripts.forEach(script => {
                    const newScript = document.createElement('script');
                    newScript.textContent = script.textContent;
                    contentWrapper.appendChild(newScript);
                });
            })
            .catch(error => {
                console.error('Error loading page:', error);
                contentWrapper.innerHTML = `
                    <div class="bg-red-50 border-l-4 border-red-500 rounded-lg p-4">
                        <h3 class="text-red-800 font-bold">Error Loading Page</h3>
                        <p class="text-red-700">There was an error loading the page. Please try again.</p>
                    </div>
                `;
            });

            // Update active sidebar link
            document.querySelectorAll('.sidebar-nav-link').forEach(link => {
                link.classList.remove('active');
            });
            document.querySelector(`[data-page="${page}"]`).classList.add('active');

            // Scroll to top
            contentArea.scrollTop = 0;
        }

        // Verify farmer - updates farmer status to verified
        function verifyFarmer(farmerId) {
            if (!confirm('Are you sure you want to verify this farmer?')) {
                return;
            }

            const formData = new FormData();
            formData.append('_method', 'PUT');
            formData.append('_token', document.querySelector('meta[name="csrf-token"]').content);
            formData.append('status', 'verified');

            fetch(`/admin/farmers/${farmerId}/status`, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => {
                if (!response.ok) throw new Error('Network response was not ok');
                return response.json ? response.json() : response.text();
            })
            .then(data => {
                // Show success message
                const contentArea = document.getElementById('admin-content');
                const successDiv = document.createElement('div');
                successDiv.className = 'fixed top-4 right-4 bg-green-50 border-l-4 border-green-500 p-4 rounded-lg shadow-lg z-50';
                successDiv.innerHTML = `
                    <div class="flex items-center">
                        <i class="fas fa-check-circle text-green-600 mr-3"></i>
                        <div>
                            <p class="text-green-800 font-bold">Success!</p>
                            <p class="text-green-700 text-sm">Farmer has been verified successfully.</p>
                        </div>
                    </div>
                `;
                document.body.appendChild(successDiv);
                
                // Auto-remove message after 5 seconds
                setTimeout(() => {
                    successDiv.style.transition = 'opacity 0.5s';
                    successDiv.style.opacity = '0';
                    setTimeout(() => successDiv.remove(), 500);
                }, 5000);

                // Reload the current page to reflect changes
                const currentPage = document.querySelector('.sidebar-nav-link.active')?.getAttribute('data-page') || 'dashboard';
                const currentRoute = currentPage === 'dashboard' 
                    ? '{{ route('admin.dashboard') }}' 
                    : (currentPage === 'farmers' ? '{{ route('admin.farmers.index') }}' : '{{ route('admin.dashboard') }}');
                
                setTimeout(() => {
                    loadAdminPage(currentPage, currentRoute);
                }, 1500);
            })
            .catch(error => {
                console.error('Error verifying farmer:', error);
                const contentArea = document.getElementById('admin-content');
                const errorDiv = document.createElement('div');
                errorDiv.className = 'fixed top-4 right-4 bg-red-50 border-l-4 border-red-500 p-4 rounded-lg shadow-lg z-50';
                errorDiv.innerHTML = `
                    <div class="flex items-center">
                        <i class="fas fa-exclamation-circle text-red-600 mr-3"></i>
                        <div>
                            <p class="text-red-800 font-bold">Error!</p>
                            <p class="text-red-700 text-sm">Failed to verify farmer. Please try again.</p>
                        </div>
                    </div>
                `;
                document.body.appendChild(errorDiv);
                
                setTimeout(() => {
                    errorDiv.style.transition = 'opacity 0.5s';
                    errorDiv.style.opacity = '0';
                    setTimeout(() => errorDiv.remove(), 500);
                }, 5000);
            });
        }

        // Load dashboard on page load
        document.addEventListener('DOMContentLoaded', function() {
            loadAdminPage('dashboard', '{{ route('admin.dashboard') }}');
        });

        // Auto-hide success messages after 5 seconds
        setTimeout(() => {
            const successMsg = document.querySelector('.bg-green-50');
            if (successMsg) {
                successMsg.style.transition = 'opacity 0.5s';
                successMsg.style.opacity = '0';
                setTimeout(() => successMsg.remove(), 500);
            }
        }, 5000);
    </script>
</body>
</html>
