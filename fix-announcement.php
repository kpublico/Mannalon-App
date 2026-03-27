<?php
require __DIR__.'/../bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

// Update the old announcement
$announcement = \App\Models\Announcement::first();

if ($announcement) {
    $announcement->update([
        'is_published' => true,
        'audience_scope' => 'all',
        'target_group_id' => null,
        'expiry_date' => \Carbon\Carbon::now()->addMonth()->toDateString(),
    ]);
    
    echo "✓ Announcement Updated:\n";
    echo "  - ID: {$announcement->id}\n";
    echo "  - Title: {$announcement->title}\n";
    echo "  - Published: " . ($announcement->is_published ? 'YES' : 'NO') . "\n";
    echo "  - Audience Scope: {$announcement->audience_scope}\n";
    echo "  - Expiry Date: {$announcement->expiry_date}\n";
    echo "\n✓ This announcement should now be VISIBLE to all farmers!\n";
} else {
    echo "No announcements found in database\n";
}
?>
