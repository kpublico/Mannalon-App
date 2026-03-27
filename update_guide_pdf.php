<?php
// Quick script to update a guide with the test PDF

require_once 'bootstrap/app.php';
$app = require_once __DIR__ . '/bootstrap/app.php';

try {
    // Update the first guide to have the test PDF
    $guide = \App\Models\FarmingGuide::first();
    if ($guide) {
        $guide->pdf_file = 'farm_guides/test_guide.pdf';
        $guide->save();
        echo "✓ Updated guide: " . $guide->title . "\n";
        echo "✓ PDF file set to: " . $guide->pdf_file . "\n";
    } else {
        echo "✗ No guides found in database\n";
    }
} catch (Exception $e) {
    echo "✗ Error: " . $e->getMessage() . "\n";
}
?>
