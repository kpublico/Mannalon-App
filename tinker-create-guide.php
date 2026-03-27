use App\Models\FarmingGuide;
use App\Models\User;

// Get admin user
$admin = User::where('email', 'admin@mannalon.test')->first();

if (!$admin) {
    echo "Admin not found!\n";
    exit;
}

// Create test guide
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
    'resource_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
    'posted_by' => $admin->id,
]);

echo "✅ Guide Created!\n";
echo "Title: {$guide->title}\n";
echo "Video: {$guide->resource_url}\n";
