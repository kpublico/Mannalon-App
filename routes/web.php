<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminLandManagementController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\MessagingController;
use App\Http\Controllers\LocationController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Test route
Route::get('/test', function () {
    return 'Mannalon App is running!';
});

Route::get('/', function () {
    return view('welcome');
});

// Public Location API (used by registration and public forms)
Route::prefix('api/locations')->name('api.locations.')->group(function () {
    Route::get('/regions', [LocationController::class, 'regions'])->name('regions');
    Route::get('/provinces', [LocationController::class, 'provinces'])->name('provinces');
    Route::get('/cities', [LocationController::class, 'cities'])->name('cities');
    Route::get('/barangays', [LocationController::class, 'barangays'])->name('barangays');
});

// Auth Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.store');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.store');

// Protected Dashboard Routes (Require Authentication)
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::middleware('checkFarmer')->group(function () {
        // Farmer Dashboard Routes
        Route::get('/farmer/home', [DashboardController::class, 'farmerHome'])->name('farmer.home');

        Route::get('/farmer/announcements', [DashboardController::class, 'farmerAnnouncements'])->name('farmer.announcements');

        Route::get('/farmer/guides', [DashboardController::class, 'farmerGuides'])->name('farmer.guides');

        Route::get('/farmer/weather', [DashboardController::class, 'farmerWeather'])->name('farmer.weather');

        Route::get('/farmer/market-prices', [DashboardController::class, 'farmerMarketPrices'])->name('farmer.market-prices');

        Route::get('/farmer/information', [DashboardController::class, 'farmerInformation'])->name('farmer.information');

        Route::get('/farmer/about', function () {
            return view('farmer.about');
        })->name('farmer.about');

        Route::get('/farmer/profile', function () {
            return view('farmer.profile');
        })->name('farmer.profile');

        Route::put('/farmer/profile/password', [DashboardController::class, 'updatePassword'])->name('farmer.profile.password');

        // Crops routes
        Route::get('/crops', [DashboardController::class, 'crops'])->name('crops.index');
        Route::get('/crops/create', [DashboardController::class, 'createCrop'])->name('crops.create');
        Route::post('/crops', [DashboardController::class, 'storeCrop'])->name('crops.store');
        Route::get('/crops/{id}/edit', [DashboardController::class, 'editCrop'])->name('crops.edit');
        Route::put('/crops/{id}', [DashboardController::class, 'updateCrop'])->name('crops.update');
        Route::delete('/crops/{id}', [DashboardController::class, 'deleteCrop'])->name('crops.destroy');

        // Livestock routes
        Route::get('/livestock', [DashboardController::class, 'livestock'])->name('livestock.index');
        Route::get('/livestock/create', [DashboardController::class, 'createLivestock'])->name('livestock.create');
        Route::post('/livestock', [DashboardController::class, 'storeLivestock'])->name('livestock.store');
        Route::get('/livestock/{id}/edit', [DashboardController::class, 'editLivestock'])->name('livestock.edit');
        Route::put('/livestock/{id}', [DashboardController::class, 'updateLivestock'])->name('livestock.update');
        Route::delete('/livestock/{id}', [DashboardController::class, 'deleteLivestock'])->name('livestock.destroy');

        // Other farmer routes
        Route::get('/dashboard/weather', [DashboardController::class, 'weather'])->name('weather.index');
        Route::get('/dashboard/market-prices', [DashboardController::class, 'marketPrices'])->name('market-prices.index');
        Route::get('/profile', [DashboardController::class, 'profile'])->name('profile');
        Route::put('/profile', [DashboardController::class, 'updateProfile'])->name('profile.update');
    });

    // AI Chat Routes
    Route::post('/api/chat', [ChatController::class, 'sendMessage'])->name('chat.send');

    Route::middleware('checkAdmin')->group(function () {
        // Admin Routes
        Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
        
        // Farmer Management
        Route::get('/admin/farmers', [AdminController::class, 'farmers'])->name('admin.farmers.index');
        Route::post('/admin/farmers', [AdminController::class, 'farmersStore'])->name('admin.farmers.store');
        Route::put('/admin/farmers/{farmer}', [AdminController::class, 'farmersUpdate'])->name('admin.farmers.update');
        Route::delete('/admin/farmers/{farmer}', [AdminController::class, 'farmersDestroy'])->name('admin.farmers.destroy');
        Route::get('/admin/farmers/{id}', [AdminController::class, 'farmerDetails'])->name('admin.farmers.show');
        Route::put('/admin/farmers/{id}/status', [AdminController::class, 'updateFarmerStatus'])->name('admin.farmers.status');
        
        // Location API Endpoints
        Route::get('/admin/api/locations/regions', [AdminController::class, 'getRegions'])->name('admin.api.locations.regions');
        Route::get('/admin/api/locations/provinces', [AdminController::class, 'getProvincesByRegion'])->name('admin.api.locations.provinces');
        Route::get('/admin/api/locations/municipalities', [AdminController::class, 'getMunicipalitiesByProvince'])->name('admin.api.locations.municipalities');
        Route::get('/admin/api/locations/barangays', [AdminController::class, 'getBarangaysByMunicipality'])->name('admin.api.locations.barangays');
        Route::get('/admin/api/locations/sitios', [AdminController::class, 'getSitiosByBarangay'])->name('admin.api.locations.sitios');
        
        // Content Management (Announcements, Guides, Weather, Market Prices)
        Route::get('/admin/announcements', [AdminController::class, 'announcementsIndex'])->name('admin.announcements.index');
        Route::get('/admin/announcements/create', [AdminController::class, 'announcementsCreate'])->name('admin.announcements.create');
        Route::post('/admin/announcements', [AdminController::class, 'announcementsStore'])->name('admin.announcements.store');
        Route::get('/admin/announcements/{id}/edit', [AdminController::class, 'announcementsEdit'])->name('admin.announcements.edit');
        Route::put('/admin/announcements/{id}', [AdminController::class, 'announcementsUpdate'])->name('admin.announcements.update');
        Route::delete('/admin/announcements/{id}', [AdminController::class, 'announcementsDestroy'])->name('admin.announcements.destroy');
        
        Route::get('/admin/guides', [AdminController::class, 'guidesIndex'])->name('admin.guides.index');
        Route::get('/admin/guides/create', [AdminController::class, 'guidesCreate'])->name('admin.guides.create');
        Route::post('/admin/guides', [AdminController::class, 'guidesStore'])->name('admin.guides.store');
        Route::get('/admin/guides/{id}/edit', [AdminController::class, 'guidesEdit'])->name('admin.guides.edit');
        Route::put('/admin/guides/{id}', [AdminController::class, 'guidesUpdate'])->name('admin.guides.update');
        Route::delete('/admin/guides/{id}', [AdminController::class, 'guidesDestroy'])->name('admin.guides.destroy');
        
        Route::get('/admin/weather', [AdminController::class, 'weatherIndex'])->name('admin.weather.index');
        Route::post('/admin/weather', [AdminController::class, 'weatherStore'])->name('admin.weather.store');
        Route::get('/admin/market-prices', [AdminController::class, 'marketPricesIndex'])->name('admin.market-prices.index');
        Route::get('/admin/market-prices/edit', [AdminController::class, 'marketPricesEdit'])->name('admin.market-prices.edit');
        Route::put('/admin/market-prices', [AdminController::class, 'marketPricesUpdate'])->name('admin.market-prices.update');
        Route::put('/admin/market-prices/{commodityPrice}', [AdminController::class, 'marketPriceRowUpdate'])->name('admin.market-prices.row.update');
        Route::delete('/admin/market-prices/{commodityPrice}', [AdminController::class, 'marketPriceRowDestroy'])->name('admin.market-prices.row.destroy');
        
        // Crops & Livestock
        Route::get('/admin/crops', [AdminController::class, 'crops'])->name('admin.crops.index');
        Route::get('/admin/livestock', [AdminController::class, 'livestock'])->name('admin.livestock.index');
        
        // Analytics & Reports
        Route::get('/admin/analytics', [AdminController::class, 'analytics'])->name('admin.analytics');
        Route::get('/admin/reports-analytics', [AdminController::class, 'reportsAnalytics'])->name('admin.reports-analytics');
        Route::get('/admin/reports-analytics/export-csv', [AdminController::class, 'exportReportsCsv'])->name('admin.reports-analytics.export-csv');
        Route::get('/admin/reports-analytics/export-pdf', [AdminController::class, 'exportReportsPdf'])->name('admin.reports-analytics.export-pdf');
        
        Route::middleware('checkSuperAdmin')->group(function () {
            // User Management (Super Admin only)
            Route::get('/admin/users', [AdminController::class, 'usersIndex'])->name('admin.users.index');
            Route::post('/admin/users/create', [AdminController::class, 'usersCreate'])->name('admin.users.create');
            Route::put('/admin/users/{id}', [AdminController::class, 'usersUpdate'])->name('admin.users.update');
            Route::delete('/admin/users/{id}', [AdminController::class, 'usersDestroy'])->name('admin.users.destroy');
        });
        
        // Settings
        Route::get('/admin/settings', [AdminController::class, 'settings'])->name('admin.settings');

        // Land Management & Beneficiary Distribution
        Route::get('/admin/land-management', [AdminLandManagementController::class, 'index'])->name('admin.land.index');
        Route::post('/admin/land-management/farmers', [AdminLandManagementController::class, 'storeFarmer'])->name('admin.land.farmers.store');
        Route::post('/admin/land-management/farm-details', [AdminLandManagementController::class, 'storeFarmDetail'])->name('admin.land.farm-details.store');
        Route::put('/admin/land-management/profile', [AdminLandManagementController::class, 'updateProfile'])->name('admin.land.profile.update');
        Route::post('/admin/land-management/beneficiaries', [AdminLandManagementController::class, 'storeBeneficiary'])->name('admin.land.beneficiaries.store');
        Route::put('/admin/land-management/beneficiaries/{beneficiary}', [AdminLandManagementController::class, 'updateBeneficiary'])->name('admin.land.beneficiaries.update');
        Route::delete('/admin/land-management/beneficiaries/{beneficiary}', [AdminLandManagementController::class, 'destroyBeneficiary'])->name('admin.land.beneficiaries.destroy');
        Route::patch('/admin/land-management/ayuda/{beneficiary}/toggle', [AdminLandManagementController::class, 'toggleAyudaStatus'])->name('admin.land.ayuda.toggle');
    });

    // Messaging & Communication Routes (Available to all authenticated users)
    Route::group(['prefix' => 'messages', 'as' => 'messages.'], function () {
        Route::get('/', [MessagingController::class, 'inbox'])->name('inbox');
        Route::get('/compose', [MessagingController::class, 'compose'])->name('compose');
        Route::post('/send', [MessagingController::class, 'store'])->name('store');
        Route::get('/{message}', [MessagingController::class, 'show'])->name('show');
        Route::put('/{message}/read', [MessagingController::class, 'markAsRead'])->name('read');
        Route::put('/{message}/archive', [MessagingController::class, 'archive'])->name('archive');
        Route::delete('/{message}', [MessagingController::class, 'delete'])->name('delete');

        // Notifications
        Route::get('/notifications/list', [MessagingController::class, 'notifications'])->name('notifications');
        Route::put('/notifications/{notification}/dismiss', [MessagingController::class, 'dismissNotification'])->name('notifications.dismiss');

        // Conversation Threads
        Route::group(['prefix' => 'threads', 'as' => 'threads.'], function () {
            Route::get('/', [MessagingController::class, 'threads'])->name('index');
            Route::post('/start', [MessagingController::class, 'startConversation'])->name('start');
            Route::get('/{thread}', [MessagingController::class, 'showThread'])->name('show');
            Route::post('/{thread}/reply', [MessagingController::class, 'replyThread'])->name('reply');
        });

        // API Endpoints for statistics
        Route::get('/api/statistics', [MessagingController::class, 'getStatistics'])->name('statistics');
    });
});

