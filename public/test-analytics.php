<?php
// Test analytics view rendering
require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

try {
    $response = $kernel->handle(
        $request = Illuminate\Http\Request::create('/admin/analytics', 'GET', [], [], [], ['HTTP_X_REQUESTED_WITH' => 'XMLHttpRequest'])
    );
    
    echo "Status: " . $response->getStatusCode() . "\n";
    echo "Content Length: " . strlen($response->getContent()) . "\n";
    echo "First 500 chars:\n";
    echo substr($response->getContent(), 0, 500);
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
    echo "File: " . $e->getFile() . "\n";
    echo "Line: " . $e->getLine() . "\n";
}
