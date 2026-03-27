<?php
require 'vendor/autoload.php';

$app = require 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

// Disable foreign key checks
DB::statement('SET FOREIGN_KEY_CHECKS=0;');

// Clear existing users
User::truncate();

// Re-enable foreign key checks
DB::statement('SET FOREIGN_KEY_CHECKS=1;');

// Create test farmer
User::create([
    'name' => 'Juan Dela Cruz',
    'email' => 'farmer@example.com',
    'password' => Hash::make('password123'),
    'role' => 'farmer',
    'status' => 'active',
    'sex' => 'male',
    'phone' => '09123456789',
    'city' => 'Tuguegarao City',
    'state' => 'Cagayan',
    'barangay' => 'Mabolo',
    'house_number' => '123',
    'zone_purok' => 'Zone 1',
    'address' => '123 Main Street'
]);

// Create test admin
User::create([
    'name' => 'Admin User',
    'email' => 'admin@example.com',
    'password' => Hash::make('password123'),
    'role' => 'admin',
    'status' => 'active',
    'sex' => 'male',
    'phone' => '09111111111',
    'city' => 'Tuguegarao City',
    'state' => 'Cagayan',
    'barangay' => 'Centro',
    'house_number' => '456',
    'zone_purok' => 'Admin Zone',
    'address' => '456 Admin Street'
]);

echo "Test users created successfully!";
?>
