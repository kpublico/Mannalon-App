<?php
require 'vendor/autoload.php';
$app = require 'bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

echo "=== Creating Farmer Test User ===\n\n";

try {
    $farmer = \App\Models\User::create([
        'name' => 'Test Farmer',
        'email' => 'farmer@mannalon.test',
        'password' => \Illuminate\Support\Facades\Hash::make('password'),
        'role' => 'farmer',
        'status' => 'active',
        'phone' => '09123456789',
        'address' => 'Test Farm, Laguna',
    ]);
    
    echo "✓ Farmer user created!\n\n";
    echo "LOGIN CREDENTIALS:\n";
    echo "Email: farmer@mannalon.test\n";
    echo "Password: password\n\n";
    echo "=== Test Instructions ===\n";
    echo "1. Visit: http://localhost/login\n";
    echo "2. Login with farmer credentials above\n";
    echo "3. Click 'Announcements' in the menu\n";
    echo "4. You should see: '🌾 Welcome! Announcements are Working!'\n\n";
    echo "✓ If you see the announcement, it's working!\n";
    
} catch (\Exception $e) {
    echo "ERROR: " . $e->getMessage() . "\n";
}
?>
