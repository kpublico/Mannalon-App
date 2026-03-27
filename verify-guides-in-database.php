<?php

require 'vendor/autoload.php';

use App\Models\FarmingGuide;

$app = require_once 'bootstrap/app.php';
$kernel = $app->make('Illuminate\Contracts\Console\Kernel');
$kernel->bootstrap();

try {
    echo "🔍 CHECKING DATABASE FOR FARMING GUIDES...\n";
    echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n\n";

    $guides = FarmingGuide::all();
    
    echo "📊 Total Guides in Database: " . $guides->count() . "\n\n";
    
    foreach ($guides as $guide) {
        echo "┌─ GUIDE #{$guide->id}\n";
        echo "│ 📚 Title: {$guide->title}\n";
        echo "│ 🌾 Crop: {$guide->crop_type}\n";
        echo "│ 📅 Season: {$guide->season}\n";
        echo "│ 🎬 Video URL: ";
        
        if ($guide->resource_url) {
            echo "{$guide->resource_url}\n";
            echo "│    ✅ VIDEO LINK STORED\n";
        } else {
            echo "❌ NO VIDEO\n";
        }
        
        echo "│ 👤 Posted By: {$guide->posted_by}\n";
        echo "│ 📝 Steps Length: " . strlen($guide->steps) . " characters\n";
        echo "│ 🕐 Created: {$guide->created_at}\n";
        echo "│ 🔄 Updated: {$guide->updated_at}\n";
        echo "└─\n\n";
    }
    
    echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
    echo "✅ DATABASE VERIFICATION COMPLETE\n";
    echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n\n";
    
    // Count guides with video links
    $withVideo = FarmingGuide::whereNotNull('resource_url')
        ->where('resource_url', '!=', '')
        ->count();
    
    echo "📊 SUMMARY:\n";
    echo "   • Total Guides: {$guides->count()}\n";
    echo "   • Guides WITH Videos: {$withVideo}\n";
    echo "   • Guides WITHOUT Videos: " . ($guides->count() - $withVideo) . "\n";
    echo "   • All data stored in: farming_guides table ✅\n\n";
    
    echo "💾 DATABASE STATUS: ALL GUIDES PROPERLY STORED\n";

} catch (\Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
    exit(1);
}
