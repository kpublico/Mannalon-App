<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h2>Debug Information</h2>";

// Check if bootstrap/app.php exists
echo "<p><strong>Bootstrap file exists:</strong> ";
if (file_exists(__DIR__ . '/../bootstrap/app.php')) {
    echo "✓ YES</p>";
    
    // Try to require it
    try {
        $app = require __DIR__ . '/../bootstrap/app.php';
        echo "<p><strong>App loaded:</strong> ✓ YES</p>";
        echo "<p>App class: " . get_class($app) . "</p>";
    } catch (\Exception $e) {
        echo "✗ ERROR: " . $e->getMessage() . "</p>";
    }
} else {
    echo "✗ NO</p>";
}

// Check vendor/autoload.php
echo "<p><strong>Vendor autoload exists:</strong> ";
if (file_exists(__DIR__ . '/../vendor/autoload.php')) {
    echo "✓ YES</p>";
} else {
    echo "✗ NO</p>";
}

// Check routes
echo "<p><strong>Routes file exists:</strong> ";
if (file_exists(__DIR__ . '/../routes/web.php')) {
    echo "✓ YES</p>";
} else {
    echo "✗ NO</p>";
}
?>
