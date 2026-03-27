<?php
require 'vendor/autoload.php';

$app = require 'bootstrap/app.php';
$kernel = $app->make('Illuminate\Contracts\Console\Kernel');
$kernel->bootstrap();

use App\Models\User;

$users = User::all();
echo "Total users: " . count($users) . "\n";
foreach ($users as $user) {
    echo "- {$user->name} ({$user->email}) - {$user->role}\n";
}
?>
