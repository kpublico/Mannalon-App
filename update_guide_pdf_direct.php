<?php
// Direct database update to add test PDF

$hostDB = "localhost";
$userDB = "root";
$passDB = "";
$nameDB = "mannalon_app";

try {
    $conn = new PDO("mysql:host=$hostDB;dbname=$nameDB", $userDB, $passDB);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Update first guide with PDF
    $stmt = $conn->prepare("UPDATE farming_guides SET pdf_file = ? WHERE id = 1");
    $stmt->execute(["farm_guides/test_guide.pdf"]);
    
    // Get the title to confirm
    $stmt = $conn->prepare("SELECT id, title, pdf_file FROM farming_guides WHERE id = 1");
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($result) {
        echo "✅ Guide Updated!\n";
        echo "ID: " . $result['id'] . "\n";
        echo "Title: " . $result['title'] . "\n";
        echo "PDF: " . $result['pdf_file'] . "\n";
    }
    
} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
}
?>
