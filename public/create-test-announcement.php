<?php
// Use Laravel directly to create announcement
require __DIR__.'/bootstrap/app.php';

try {
    $app = require __DIR__.'/bootstrap/app.php';
    $kernel = $app->make(\Illuminate\Contracts\Console\Kernel::class);
    $kernel->bootstrap();
    
    echo "=== Announcement Setup ===\n\n";
    
    // Delete old announcements
    \App\Models\Announcement::truncate();
    
    // Create new test announcement
    $ann = \App\Models\Announcement::create([
        'title' => '🌾 Welcome to Mannalon Announcements!',
        'content' => 'This is a test announcement. Admin announcements will now display here for all farmers!',
        'category' => 'General',
        'audience_scope' => 'all',
        'target_group_id' => null,
        'is_published' => true,
        'expiry_date' => \Carbon\Carbon::now()->addMonth(),
        'posted_by' => 2, // admin user
    ]);
    
    echo "✓ Test Announcement Created!\n\n";
    echo "Details:\n";
    echo "- ID: {$ann->id}\n";
    echo "- Title: {$ann->title}\n";
    echo "- Published: " . ($ann->is_published ? 'YES ✓' : 'NO ✗') . "\n";
    echo "- Audience: {$ann->audience_scope}\n";
    echo "- Category: {$ann->category}\n";
    echo "- Expiry: {$ann->expiry_date}\n\n";
    
    echo "✓ Announcement is ready to display to farmers!\n";
    echo "  Visit: http://localhost/farmer/announcements\n";
    
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
    echo $e->getFile() . ":" . $e->getLine() . "\n";
}
?>
