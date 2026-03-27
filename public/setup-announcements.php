<?php
// Direct SQL update - simple approach
$conn = new mysqli("localhost", "root", "", "mannalon_app");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Update existing announcement
$sql = "UPDATE announcements SET 
    is_published = 1, 
    audience_scope = 'all', 
    target_group_id = NULL, 
    expiry_date = DATE_ADD(NOW(), INTERVAL 30 DAY)
WHERE id = 1";

if ($conn->query($sql) === TRUE) {
    echo "✓ Announcement #1 updated successfully!\n\n";
    
    // Show the updated record
    $result = $conn->query("SELECT * FROM announcements WHERE id = 1");
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo "Current State:\n";
        echo "- Title: " . $row['title'] . "\n";
        echo "- Published: " . ($row['is_published'] ? 'YES' : 'NO') . "\n";
        echo "- Audience Scope: " . $row['audience_scope'] . "\n";
        echo "- Expiry Date: " . $row['expiry_date'] . "\n";
    }
} else {
    echo "Error updating announcement: " . $conn->error;
}

// Insert a new test announcement if needed
$sql2 = "INSERT INTO announcements (title, content, category, audience_scope, target_group_id, is_published, posted_by, expiry_date, created_at, updated_at)
VALUES (
    'Test Announcement - Should Show!', 
    'This is a test announcement that should be visible to all farmers.',
    'General',
    'all',
    NULL,
    1,
    2,
    DATE_ADD(NOW(), INTERVAL 30 DAY),
    NOW(),
    NOW()
)";

if ($conn->query($sql2) === TRUE) {
    echo "\n✓ New test announcement created!\n";
    echo "  - ID: " . $conn->insert_id . "\n";
    echo "  - Status: Published\n";
    echo "  - Audience: All Farmers\n";
} else {
    echo "Error creating announcement: " . $conn->error;
}

$conn->close();
echo "\n✓ Done! Both announcements should now be visible to farmers.\n";
echo "  Visit: /farmer/announcements\n";
?>
