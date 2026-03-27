<?php
require 'vendor/autoload.php';

$app = require 'bootstrap/app.php';
$kernel = $app->make('Illuminate\Contracts\Console\Kernel');
$kernel->bootstrap();

use App\Models\User;
use Illuminate\Support\Facades\Hash;

echo "<h2>Debug Login Information</h2>";

// Check users
echo "<h3>Users in Database:</h3>";
$users = User::all();
foreach ($users as $user) {
    echo "<p><strong>" . $user->email . "</strong> (Role: {$user->role})</p>";
}

// Test password verification
echo "<h3>Password Test:</h3>";
$testEmail = 'farmer@example.com';
$testPassword = 'password123';

$user = User::where('email', $testEmail)->first();

if ($user) {
    $isValid = Hash::check($testPassword, $user->password);
    echo "<p>Email: " . $user->email . "</p>";
    echo "<p>Password Hash: " . substr($user->password, 0, 30) . "...</p>";
    echo "<p>Test Password: '$testPassword'</p>";
    echo "<p>Password Match: " . ($isValid ? '<span style="color: green;">✓ YES</span>' : '<span style="color: red;">✗ NO</span>') . "</p>";
    echo "<p>User Status: {$user->status}</p>";
    echo "<p>User Role: {$user->role}</p>";
} else {
    echo "<p style='color: red;'>User not found!</p>";
}

// Check session configuration
echo "<h3>Session Configuration:</h3>";
echo "<p>SESSION_DRIVER: " . env('SESSION_DRIVER', 'file') . "</p>";
echo "<p>Session Lifetime: " . env('SESSION_LIFETIME', '120') . " minutes</p>";

// Check if storage/framework/sessions exists and is writable
$sessionPath = 'storage/framework/sessions';
if (is_dir($sessionPath)) {
    echo "<p style='color: green;'>✓ Session directory exists and is " . (is_writable($sessionPath) ? 'writable' : 'NOT writable') . "</p>";
} else {
    echo "<p style='color: red;'>✗ Session directory does NOT exist</p>";
}
?>
