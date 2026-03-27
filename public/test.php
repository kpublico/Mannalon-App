<?php
try {
    $app = require __DIR__ . '/../bootstrap/app.php';
    echo "App loaded successfully!";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
    echo "\nFile: " . $e->getFile();
    echo "\nLine: " . $e->getLine();
}
