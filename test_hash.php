<?php
require 'vendor/autoload.php';

$app = require 'bootstrap/app.php';
$kernel = $app->make('Illuminate\Contracts\Console\Kernel');
$kernel->bootstrap();

use App\Models\User;
use Illuminate\Support\Facades\Hash;

$password = 'password123';
$hash = Hash::make($password);

echo "Creating new hash for 'password123':\n";
echo "Hash: " . $hash . "\n\n";

// Now test it
echo "Testing verification:\n";
echo "Result: " . (Hash::check($password, $hash) ? 'PASS ✓' : 'FAIL ✗') . "\n\n";

// Now test with existing users
echo "Testing existing users:\n";
$users = User::all();
foreach ($users as $user) {
    echo "\nUser: {$user->email}\n";
    echo "Stored Hash: " . substr($user->password, 0, 40) . "...\n";
    $result = Hash::check('password123', $user->password);
    echo "Password verification: " . ($result ? 'PASS ✓' : 'FAIL ✗') . "\n";
}
?>
