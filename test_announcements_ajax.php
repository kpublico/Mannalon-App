#!/usr/bin/env php
<?php
// Test admin announcements endpoint
require __DIR__.'/vendor/autoload.php';
$app = require __DIR__.'/bootstrap/app.php';
$kernel = $app->make(\Illuminate\Contracts\Http\Kernel::class);

// Create a test request
$request = \Illuminate\Http\Request::create('/admin/announcements', 'GET', [], [], [], [
    'HTTP_X_REQUESTED_WITH' => 'XMLHttpRequest',
    'HTTP_ACCEPT' => 'text/html',
]);

// Set auth user manually (simulate admin login)
$admin = \App\Models\User::where('role', 'admin')->first() ?? \App\Models\User::where('role', 'super_admin')->first();
if ($admin) {
    auth()->setUser($admin);
    echo "\n=== Testing with admin user: {$admin->name} ({$admin->role}) ===\n";
} else {
    echo "\n=== No admin user found ===\n";
    exit(1);
}

// Try to get announcements directly
echo "\n=== Direct announcement query ===\n";
$announcements = \App\Models\Announcement::query()->orderByDesc('created_at')->paginate(10);
echo "Total: {$announcements->total()}\n";
echo "Count: {$announcements->count()}\n";

if ($announcements->total() > 0) {
    foreach ($announcements as $ann) {
        echo "- {$ann->title} ({$ann->category})\n";
    }
} else {
    echo "No announcements found\n";
}

// Now test the rendered view
echo "\n=== Rendering admin.announcements-content view ===\n";
try {
    $html = view('admin.announcements-content', [
        'announcements' => $announcements,
        'category' => '',
        'search' => '',
    ])->render();
    
    // Check if table rows are present
    if (preg_match('/@forelse/i', $html)) {
        echo "WARNING: View still contains Blade directives - not fully rendered\n";
    }
    
    $tableRows = substr_count($html, '<tr');
    echo "Table rows in HTML: $tableRows\n";
    
    if (strpos($html, 'No announcements yet') !== false) {
        echo "ERROR: View shows 'No announcements yet' message\n";
    } elseif (preg_match('/>\d+<\/td>/', $html)) {
        echo "SUCCESS: View appears to contain announcement data\n";
    }
    
    // Show first 500 chars of table
    if (preg_match('/<table[^>]*>.*?<\/table>/s', $html, $matches)) {
        echo "\n=== Table preview (first 1000 chars) ===\n";
        echo substr($matches[0], 0, 1000) . "...\n";
    }
    
} catch(\Exception $e) {
    echo "ERROR rendering view: {$e->getMessage()}\n";
    echo $e->getTraceAsString() . "\n";
}

echo "\n";
?>
