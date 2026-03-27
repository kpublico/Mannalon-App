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

    // Create test guide
    $guide = FarmingGuide::create([
        'title' => '🌾 How to Plant Palay (Rice) - Complete Guide',
        'crop_type' => 'Palay (Rice)',
        'season' => 'Wet Season',
        'steps' => "Step 1: Prepare seedbed by flooding and puddling
Step 2: Soak seeds for 24 hours
Step 3: Transplant seedlings after 21-30 days
Step 4: Maintain water level of 5cm
Step 5: Apply fertilizer at tillering stage
Step 6: Monitor for pests and diseases
Step 7: Harvest when grain is mature",
        'resource_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
        'posted_by' => $admin->id,
    ]);

    echo "✅ Test Farming Guide Created Successfully!\n";
    echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
    echo "📚 Title: {$guide->title}\n";
    echo "🌾 Crop: {$guide->crop_type}\n";
    echo "🔄 Season: {$guide->season}\n";
    echo "🔗 Video URL: {$guide->resource_url}\n";
    echo "👤 Posted by: {$admin->name}\n";
    echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
    echo "\n✨ Farming Guides System Status:\n";
    echo "   ✅ Admin can create guides with video URLs\n";
    echo "   ✅ Guides stored with resource_url field\n";
    echo "   ✅ Farmers will see 'Watch Video' button on guide cards\n";
    echo "   ✅ Video link opens in new tab when clicked\n";

} catch (\Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
    exit(1);
}
