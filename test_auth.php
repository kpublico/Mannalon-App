<?php
require 'vendor/autoload.php';

$app = require 'bootstrap/app.php';
$kernel = $app->make('Illuminate\Contracts\Console\Kernel');
$kernel->bootstrap();

use App\Models\User;
use Illuminate\Support\Facades\Hash;

// Check users
$users = User::all();
echo "=== USERS IN DATABASE ===\n";
foreach ($users as $user) {
    echo "ID: {$user->id}\n";
    echo "Name: {$user->name}\n";
    echo "Email: {$user->email}\n";
    echo "Role: {$user->role}\n";
    echo "Status: {$user->status}\n";
    echo "Password Hash: " . substr($user->password, 0, 20) . "...\n";
    echo "\n";
}

// Test password verification
echo "=== PASSWORD VERIFICATION TEST ===\n";
$testUser = User::where('email', 'farmer@example.com')->first();
if ($testUser) {
    $password = 'password123';
    $isValid = Hash::check($password, $testUser->password);
    echo "User: {$testUser->email}\n";
    echo "Testing password: '$password'\n";
    echo "Password valid: " . ($isValid ? 'YES ✓' : 'NO ✗') . "\n";
} else {
    echo "User not found!\n";
}
?>
