<?php
// Test script to create a farming guide with video URL
require 'bootstrap/app.php';

$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\FarmingGuide;
use App\Models\User;

try {
    // Get admin user by email
    $admin = User::where('email', 'admin@mannalon.test')->first();
    
    if (!$admin) {
        echo "❌ Admin user not found! Create admin first.\n";
        exit(1);
    }

    // Create a test farming guide with video URL
    $guide = FarmingGuide::create([
        'title' => '🌾 How to Plant Palay (Rice) - Complete Guide',
        'crop_type' => 'Palay (Rice)',
        'season' => 'Wet Season',
        'steps' => "1. Prepare seedbed by flooding and puddling the soil
2. Soak seeds in water for 24 hours
3. Spread seeds evenly on seedbed
4. Maintain water level of 2-5cm
5. After 21-30 days, transplant seedlings to main field
6. Transplant 3-4 seedlings per hill, 20cm apart
7. Maintain water level of 5cm during growth
8. Apply fertilizer at tillering stage
9. Monitor for pests and diseases
10. Harvest when grain is mature (golden color)
11. Dry paddy to 14% moisture content
12. Thresh and clean the grains",
        'resource_url' => 'https://www.youtube.com/watch?v=qwerty123456',
        'posted_by' => $admin->id,
    ]);

    echo "✅ Test Guide Created Successfully!\n";
    echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
    echo "📚 Title: {$guide->title}\n";
    echo "🌾 Crop: {$guide->crop_type}\n";
    echo "🔄 Season: {$guide->season}\n";
    echo "👤 Posted by: {$admin->name}\n";
    echo "🔗 Video URL: {$guide->resource_url}\n";
    echo "📅 Created: {$guide->created_at->format('M d, Y H:i:s')}\n";
    echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
    echo "\n✅ Farming Guides System is WORKING!\n";
    echo "   - Admin can create guides with video URLs\n";
    echo "   - Farmers should see the guide with 'Watch Video' button\n";

} catch (\Exception $e) {
    echo "❌ Error: {$e->getMessage()}\n";
    exit(1);
}
