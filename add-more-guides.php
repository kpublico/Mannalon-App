<?php

require 'vendor/autoload.php';

use Illuminate\Foundation\Application;
use App\Models\FarmingGuide;
use App\Models\User;

$app = require_once 'bootstrap/app.php';
$kernel = $app->make('Illuminate\Contracts\Console\Kernel');
$kernel->bootstrap();

try {
    $admin = User::where('email', 'admin@mannalon.test')->first();
    
    if (!$admin) {
        echo "❌ Admin not found!\n";
        exit(1);
    }

    // Create more test guides
    $guides = [
        [
            'title' => '🌽 How to Plant Corn - Beginner\'s Guide',
            'crop_type' => 'Corn (Maize)',
            'season' => 'Dry Season',
            'steps' => "Step 1: Select quality corn seeds
Step 2: Prepare field by plowing and harrowing
Step 3: Plant seeds 5cm deep, 60cm row spacing
Step 4: Water when soil is dry
Step 5: Apply fertilizer at V4 stage
Step 6: Remove weeds regularly
Step 7: Monitor for armyworms
Step 8: Harvest when corn cob turns brown",
            'resource_url' => 'https://www.youtube.com/watch?v=maisplanting2024'
        ],
        [
            'title' => '🥬 Organic Vegetable Growing Techniques',
            'crop_type' => 'Vegetables',
            'season' => 'Year-Round',
            'steps' => "Step 1: Prepare compost-rich soil
Step 2: Plant seeds in raised beds
Step 3: Water consistently 
Step 4: Apply organic pest control
Step 5: Mulch around plants
Step 6: Harvest when ready
Step 7: Rotate crops yearly",
            'resource_url' => null  // No video for this one
        ],
        [
            'title' => '🐝 Integrated Pest Management for Farms',
            'crop_type' => 'General',
            'season' => 'Year-Round',
            'steps' => "Step 1: Scout fields regularly for pests
Step 2: Identify pest type and severity
Step 3: Use cultural practices first
Step 4: Apply biological controls
Step 5: Use pesticides only when necessary
Step 6: Keep records of treatments
Step 7: Train farm workers on safety",
            'resource_url' => 'https://www.youtube.com/watch?v=pestmanagement2024'
        ],
    ];

    foreach ($guides as $guideData) {
        FarmingGuide::create(array_merge($guideData, [
            'posted_by' => $admin->id,
        ]));
    }

    $count = FarmingGuide::count();
    echo "✅ Additional Guides Created!\n";
    echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
    echo "📊 Total Farming Guides: {$count}\n";
    echo "   ✅ 1st Guide: Palay with YouTube link\n";
    echo "   ✅ 2nd Guide: Corn with YouTube link\n";
    echo "   ✅ 3rd Guide: Vegetables (NO VIDEO LINK)\n";
    echo "   ✅ 4th Guide: Pest Management with link\n";
    echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
    echo "\n✨ Ready for Testing:\n";
    echo "   1. Login as farmer@mannalon.test / password\n";
    echo "   2. Go to Farming Guides & Video Tutorials\n";
    echo "   3. You'll see guides with 'Watch Video' buttons\n";
    echo "   4. Guides without videos show 'No Video' button\n";
    echo "   5. Click 'Watch Video' to open YouTube in new tab\n";

} catch (\Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
    exit(1);
}
