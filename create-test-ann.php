<?php
require 'vendor/autoload.php';
$app = require 'bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

echo "=== Creating Test Data ===\n\n";

try {
    // First create an admin user
    $admin = \App\Models\User::create([
        'name' => 'Admin User',
        'email' => 'admin@mannalon.test',
        'password' => \Illuminate\Support\Facades\Hash::make('password'),
        'role' => 'admin',
        'status' => 'active',
    ]);
    echo "✓ Admin user created (ID: {$admin->id})\n\n";
    
    // Now create announcement
    $ann = \App\Models\Announcement::create([
        'title' => '🌾 Welcome! Announcements are Working!',
        'content' => 'If you see this, announcements are now working correctly for farmers. Admin posts are visible here!',
        'category' => 'General',
        'audience_scope' => 'all',
        'is_published' => true,
        'expiry_date' => \Carbon\Carbon::now()->addMonth(),
        'posted_by' => $admin->id,
    ]);
    
    echo "✓ SUCCESS! Test announcement created:\n\n";
    echo "ID: {$ann->id}\n";
    echo "Title: {$ann->title}\n";
    echo "Published: YES ✓\n";
    echo "Visible to: ALL Farmers ✓\n\n";
    echo "=== Next Steps ===\n";
    echo "1. Login as a farmer user\n";
    echo "2. Visit: http://localhost/farmer/announcements\n";
    echo "3. You should see the announcement!\n\n";
    echo "✓ To create more announcements:\n";
    echo "  - Login as admin\n";
    echo "  - Go to: http://localhost/admin/announcements\n";
    echo "  - Click 'Post Announcement'\n";
    echo "  - Make sure 'Publish immediately' checkbox is CHECKED ✓\n";
    
} catch (\Exception $e) {
    echo "ERROR: " . $e->getMessage() . "\n";
    if ($e instanceof \Illuminate\Database\QueryException) {
        echo "SQL: " . $e->getSql() . "\n";
    }
}
?>
