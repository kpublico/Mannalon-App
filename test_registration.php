<?php
require 'vendor/autoload.php';

$app = require 'bootstrap/app.php';
$kernel = $app->make('Illuminate\Contracts\Console\Kernel');
$kernel->bootstrap();

use App\Models\User;
use Illuminate\Support\Facades\Hash;

// Create a new test user through registration
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
echo "Email: " . $newUser->email . "\n";
echo "Password: mypassword123\n";
echo "Role: " . $newUser->role . "\n\n";

// Verify the password works
echo "Testing password verification:\n";
$isValid = Hash::check('mypassword123', $newUser->password);
echo "Password verification: " . ($isValid ? 'PASS ✓' : 'FAIL ✗') . "\n\n";

// Show all users
echo "All users in database:\n";
$users = User::all();
foreach ($users as $user) {
    echo "- {$user->email} (Role: {$user->role})\n";
}
?>
