<?php
// Check database

$hostDB = "localhost";
$userDB = "root";
$passDB = "";
$nameDB = "mannalon_app";

try {
    $conn = new PDO("mysql:host=$hostDB;dbname=$nameDB", $userDB, $passDB);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Get first guide
    $stmt = $conn->prepare("SELECT id, title, resource_url, pdf_file FROM farming_guides LIMIT 1");
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($result) {
        echo "Guide Found:\n";
        echo "ID: " . $result['id'] . "\n";
        echo "Title: " . $result['title'] . "\n";
        echo "Video URL: " . ($result['resource_url'] ?? 'None') . "\n";
        echo "PDF File: " . ($result['pdf_file'] ?? 'None') . "\n";
    } else {
        echo "No guides found\n";
    }
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
?>
