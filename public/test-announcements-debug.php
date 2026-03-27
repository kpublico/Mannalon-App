<?php
// Test endpoint to debug announcements
require 'bootstrap/app.php';

// Create kernel
$kernel = app(\Illuminate\Contracts\Http\Kernel::class);

// Test Announcement query
echo "<h2>Announcement Test</h2>";
echo "<pre>";

// Direct DB query
$pdo = DB::getPdo();
$result = $pdo->query("SELECT COUNT(*) as count FROM announcements");
$row = $result->fetch(PDO::FETCH_ASSOC);
echo "Announcements in DB: " . ($row['count'] ?? 0) . "\n\n";

// Eloquent query
$announcements = \App\Models\Announcement::all();
echo "Announcements via Eloquent: " . $announcements->count() . "\n";

// Show each one
foreach ($announcements as $ann) {
    echo "  - ID: {$ann->id}, Title: {$ann->title}, Category: {$ann->category}\n";
}

echo "\n=== View Test ===\n";
// Try to render the view
try {
    $annPage = \App\Models\Announcement::paginate(10);
    echo "Pagination total: " . $annPage->total() . "\n";
    echo "Pagination count: " . $annPage->count() . "\n";
    
    // Try rendering
    ob_start();
    $view = view('admin.announcements-content', [
        'announcements' => $annPage,
        'category' => '',
        'search' => '',
    ])->render();
    $html = ob_get_clean();
    
    // Check for content
    if (strpos($html, 'No announcements yet') !== false) {
        echo "⚠️  View shows 'No announcements yet'\n";
    } elseif (strpos($html, '<tr') !== false) {
        $rows = substr_count($html, '<tr');
        echo "✓ View contains $rows table rows\n";
    }
    
    // Count table data cells
    $cells = substr_count($html,  '<td');
    echo "✓ Found $cells table cells\n";
    
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}

echo "</pre>";

// Show actual HTML
echo "<h2>Rendered HTML</h2>";
echo "<pre>" . htmlspecialchars($html) . "</pre>";
