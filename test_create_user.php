<?php
require 'vendor/autoload.php';

$app = require 'bootstrap/app.php';
$kernel = $app->make('Illuminate\Contracts\Console\Kernel');
$kernel->bootstrap();

use App\Models\User;
use Illuminate\Support\Facades\Hash;

try {
    // Create a new test user
    $newUser = User::create([
        'name' => 'Maria Santos',
        'email' => 'maria@example.com',
        'password' => Hash::make('mypassword123'),
        'role' => 'farmer',
        'status' => 'active',
        'sex' => 'female',
        'phone' => '09987654321',
        'city' => 'Tuguegarao City',
        'state' => 'Cagayan',
        'barangay' => 'Centro',
        'house_number' => '789',
        'zone_purok' => 'Zone 5',
        'address' => '789 Farm Road'
    ]);
    
    echo "✓ New user created successfully!\n";
    echo "ID: " . $newUser->id . "\n";
    echo "Email: " . $newUser->email . "\n";
    
} catch (\Exception $e) {
    echo "✗ Error creating user:\n";
    echo "Message: " . $e->getMessage() . "\n";
    echo "Code: " . $e->getCode() . "\n";
}

// Now show all users
echo "\nAll users currently in database:\n";
$users = User::all();
echo "Total: " . count($users) . "\n";
foreach ($users as $user) {
    echo "- ID {$user->id}: {$user->email} ({$user->role})\n";
}
?>
