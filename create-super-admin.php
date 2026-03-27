<?php
require 'vendor/autoload.php';
$app = require 'bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

echo "=== Recreating Super Admin User ===\n\n";

try {
    // Create super admin
    $superAdmin = \App\Models\User::create([
        'name' => 'Super Administrator',
        'email' => 'superadmin@mannalon.test',
        'password' => \Illuminate\Support\Facades\Hash::make('password'),
        'role' => 'super_admin',
        'status' => 'active',
    ]);
    
    echo "✓ SUPER ADMIN Created!\n\n";
    echo "LOGIN CREDENTIALS:\n";
    echo "Email: superadmin@mannalon.test\n";
    echo "Password: password\n";
    echo "Role: Super Admin (Full System Access)\n\n";
    
    // Verify
    $check = \App\Models\User::where('role', 'super_admin')->first();
    if ($check) {
        echo "✓ Verified: Super Admin exists in database\n";
        echo "  ID: {$check->id}\n";
        echo "  Name: {$check->name}\n";
        echo "  Role: {$check->role}\n";
    }
    
} catch (\Exception $e) {
    echo "ERROR: " . $e->getMessage() . "\n";
}
?>
