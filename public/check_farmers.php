<?php
// Quick diagnostic script to confirm farmer count mismatch
require 'index.php';

$farmerUsers = \App\Models\User::where('role', 'farmer')->count();
$farmerRecords = \App\Models\Farmer::count();

echo "Farmer Users (role='farmer'): $farmerUsers\n";
echo "Farmer Records (farmers table): $farmerRecords\n";
echo "\nFarmer Users:\n";
\App\Models\User::where('role', 'farmer')->pluck('name', 'id')->each(function($name, $id) {
    echo "  ID $id: $name\n";
});
