<?php
// Debug announcements
require __DIR__.'/../bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

echo "<h2>Announcement Debug</h2>";

$announcements = \App\Models\Announcement::all();

echo "<p>Total announcements: " . $announcements->count() . "</p>";

foreach ($announcements as $ann) {
    echo "<hr>";
    echo "<strong>ID:</strong> {$ann->id}<br>";
    echo "<strong>Title:</strong> {$ann->title}<br>";
    echo "<strong>Content:</strong> " . substr($ann->content, 0, 50) . "...<br>";
    echo "<strong>Category:</strong> {$ann->category}<br>";
    echo "<strong>Published:</strong> " . ($ann->is_published ? '<span style="color:green">YES</span>' : '<span style="color:red">NO</span>') . "<br>";
    echo "<strong>Audience Scope:</strong> {$ann->audience_scope}<br>";
    echo "<strong>Target Group ID:</strong> " . ($ann->target_group_id ?? 'NULL') . "<br>";
    echo "<strong>Starts At:</strong> " . ($ann->starts_at ?? 'NULL') . "<br>";
    echo "<strong>Ends At:</strong> " . ($ann->ends_at ?? 'NULL') . "<br>";
    echo "<strong>Expiry Date:</strong> " . ($ann->expiry_date ?? 'NULL') . "<br>";
    echo "<strong>Posted By:</strong> {$ann->posted_by}<br>";
    echo "<strong>Created:</strong> {$ann->created_at}<br>";
}

echo "<hr>";
echo "<h3>Test - Check if announcement meets farmer visibility criteria:</h3>";

$ann = \App\Models\Announcement::first();
if ($ann) {
    echo "<p><strong>Checking announcement ID {$ann->id}:</strong></p>";
    
    // Check 1: Published?
    $check1 = $ann->is_published === true || $ann->is_published === 1;
    echo "✓ Published? " . ($check1 ? '<span style="color:green">YES</span>' : '<span style="color:red">NO - NOT VISIBLE</span>') . "<br>";
    
    // Check 2: Audience scope
    $check2 = $ann->audience_scope === 'all' || $ann->audience_scope === null;
    echo "✓ Audience is 'all' (or NULL)? " . ($check2 ? '<span style="color:green">YES</span>' : '<span style="color:orange">NO - Check target group</span>') . "<br>";
    
    // Check 3: Start date
    $check3 = $ann->starts_at === null || \Carbon\Carbon::parse($ann->starts_at)->isPast();
    echo "✓ Start date OK? " . ($check3 ? '<span style="color:green">YES</span>' : '<span style="color:red">NO - Future start date</span>') . "<br>";
    
    // Check 4: End date
    $check4 = $ann->ends_at === null || \Carbon\Carbon::parse($ann->ends_at)->isFuture();
    echo "✓ End date OK? " . ($check4 ? '<span style="color:green">YES</span>' : '<span style="color:red">NO - Expired</span>') . "<br>";
    
    // Check 5: Expiry date
    $check5 = $ann->expiry_date === null || \Carbon\Carbon::parse($ann->expiry_date)->isFuture();
    echo "✓ Expiry date OK? " . ($check5 ? '<span style="color:green">YES</span>' : '<span style="color:red">NO - Expired</span>') . "<br>";
    
    echo "<br><strong>Final Result:</strong> ";
    if ($check1 && $check2 && $check3 && $check4 && $check5) {
        echo '<span style="color:green; font-size:16px">✓ SHOULD BE VISIBLE TO FARMERS</span>';
    } else {
        echo '<span style="color:red; font-size:16px">✗ NOT VISIBLE TO FARMERS - See above for reasons</span>';
    }
}
?>
