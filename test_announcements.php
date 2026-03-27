<?php
// Test script to debug announcements view
require 'bootstrap/app.php';

$app = require_once 'bootstrap/app.php';
$kernel = $app->make(\Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

// Get announcements
$announcements = \App\Models\Announcement::orderByDesc('created_at')->paginate(10);

echo "Total announcements: " . $announcements->total() . "\n";
echo "Current page items: " . $announcements->count() . "\n\n";

if ($announcements->total() > 0) {
    foreach ($announcements as $announcement) {
        echo "ID: {$announcement->id}\n";
        echo "Title: {$announcement->title}\n";
        echo "Category: {$announcement->category}\n";
        echo "Expiry: {$announcement->expiry_date}\n";
        echo "Published: {$announcement->is_published}\n\n";
    }
} else {
    echo "No announcements found!\n";
}
