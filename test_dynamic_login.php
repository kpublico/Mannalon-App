<?php
require 'vendor/autoload.php';

$app = require 'bootstrap/app.php';
$kernel = $app->make('Illuminate\Contracts\Console\Kernel');
$kernel->bootstrap();

use App\Models\User;
use Illuminate\Support\Facades\Hash;

echo "=== Testing Dynamic Login ===\n\n";

// Test 1: Original test account
echo "Test 1: farmer@example.com / password123\n";
$user = User::where('email', 'farmer@example.com')->first();
if ($user && Hash::check('password123', $user->password)) {
    echo "✓ LOGIN SUCCESSFUL\n";
} else {
    echo "✗ LOGIN FAILED\n";
}

// Test 2: Admin account
echo "\nTest 2: admin@example.com / password123\n";
$user = User::where('email', 'admin@example.com')->first();
if ($user && Hash::check('password123', $user->password)) {
    echo "✓ LOGIN SUCCESSFUL\n";
} else {
    echo "✗ LOGIN FAILED\n";
}

// Test 3: New user account
echo "\nTest 3: maria@example.com / mypassword123\n";
$user = User::where('email', 'maria@example.com')->first();
if ($user && Hash::check('mypassword123', $user->password)) {
    echo "✓ LOGIN SUCCESSFUL\n";
} else {
    echo "✗ LOGIN FAILED\n";
}

// Show all users
echo "\n=== All Users in Database ===\n";
$users = User::all();
foreach ($users as $user) {
    echo "- {$user->email} (Role: {$user->role})\n";
}
?>
