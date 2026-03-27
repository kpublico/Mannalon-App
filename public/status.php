<?php
require 'vendor/autoload.php';
$app = require 'bootstrap/app.php';
$kernel = $app->make(\Illuminate\Contracts\Http\Kernel::class);
$kernel->bootstrap();

echo "<h1>Mannalon App Status</h1>";
echo "<pre>";

// Check database connection
try {
    DB::connection()->getPdo();
    echo "✓ Database connected\n";
} catch (Exception $e) {
    echo "✗ Database connection failed: " . $e->getMessage() . "\n";
}

// Check announcements
$count = \App\Models\Announcement::count();
echo "✓ Announcements in database: $count\n";

// Check admin users
$admins = \App\Models\User::whereIn('role', ['admin', 'super_admin'])->count();
echo "✓ Admin users: $admins\n";

// List all announcements
echo "\nAll Announcements:\n";
foreach (\App\Models\Announcement::all() as $ann) {
    echo "  - ID {$ann->id}: {$ann->title} ({$ann->category})\n";
    echo "    Published: " . ($ann->is_published ? 'Yes' : 'No') . ", Expiry: " . ($ann->expiry_date ? $ann->expiry_date->format('Y-m-d') : 'Never') . "\n";
}

echo "\n✓ Application status: OK\n";
echo "</pre>";
?>
