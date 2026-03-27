<?php
// Direct test of the announcementsIndex method
require 'bootstrap/app.php';

// Get a user who is admin
$admin = \App\Models\User::where('role', 'admin')->orWhere('role', 'super_admin')->first();

if (!$admin) {
    echo "No admin user found!";
    exit;
}

// Simulate auth
auth()->setUser($admin);
echo "Testing as: {$admin->name} ({$admin->role})\n\n";

// Create fake request
$request = new \Illuminate\Http\Request();
$request->query->set('category', '');
$request->query->set('search', '');
$request->server->set('HTTP_X_REQUESTED_WITH', 'XMLHttpRequest');

// Call the controller method directly
$controller = new \App\Http\Controllers\AdminController();

try {
    $view = $controller->announcementsIndex($request);
    
    // Get view name and data
    $viewName = $view->getView();
    $viewData = $view->getData();
    
    echo "View Name: $viewName\n";
    echo "View Data Keys: " . implode(', ', array_keys($viewData)) . "\n\n";
    
    // Check announcements
    $announcements = $viewData['announcements'] ?? null;
    if ($announcements) {
        echo "Announcements Object Type: " . get_class($announcements) . "\n";
        echo "Total: " . $announcements->total() . "\n";
        echo "Count: " . $announcements->count() . "\n";
        
        if ($announcements->count() > 0) {
            echo "\nAnnouncements:\n";
            foreach ($announcements as $ann) {
                echo "  - {$ann->title} ({$ann->category})\n";
            }
        } else {
            echo "No announcements in collection\n";
        }
    } else {
        echo "Announcements is NULL\n";
    }
    
    // Try rendering
    echo "\n\nRendering view...\n";
    $html = $view->render();
    
    // Check what's in the HTML
    if (strpos($html, 'ANNOUNCEMENT PORTAL LOADED') !== false) {
        echo "✓ Yellow marker found\n";
        // Extract the total count from the marker
        if (preg_match('/Total Items: (\d+)/', $html, $matches)) {
            echo "  Reported count: " . $matches[1] . "\n";
        }
    } else {
        echo "✗ Yellow marker NOT found\n";
    }
    
    if (strpos($html, 'No announcements yet') !== false) {
        echo "⚠ 'No announcements yet' message found\n";
    }
    
    // Count table rows
    $rows = substr_count($html, '<tr');
    echo "Table rows: $rows\n";
    
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
    echo $e->getTraceAsString();
}
