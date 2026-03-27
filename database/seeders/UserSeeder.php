<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call(RoleSeeder::class);

        User::updateOrCreate([
            'email' => 'superadmin@example.com',
        ], [
            'name' => 'Super Admin',
            'password' => Hash::make('password123'),
            'role' => 'super_admin',
            'status' => 'active',
            'sex' => 'male',
            'phone' => '09999999999',
            'city' => 'Tuguegarao City',
            'state' => 'Cagayan',
            'barangay' => 'Centro',
            'house_number' => '1',
            'zone_purok' => 'Main',
            'address' => 'Provincial Agriculture Office',
        ]);

        // Create test farmer user
        User::updateOrCreate([
            'email' => 'farmer@example.com',
        ], [
            'name' => 'Juan Dela Cruz',
            'password' => Hash::make('password123'),
            'role' => 'farmer',
            'status' => 'active',
            'sex' => 'male',
            'phone' => '09123456789',
            'city' => 'Tuguegarao City',
            'state' => 'Cagayan',
            'barangay' => 'Mabolo',
            'house_number' => '123',
            'zone_purok' => 'Zone 1',
            'address' => '123 Main Street'
        ]);

        // Create test admin user
        User::updateOrCreate([
            'email' => 'admin@example.com',
        ], [
            'name' => 'Admin User',
            'password' => Hash::make('password123'),
            'role' => 'admin',
            'status' => 'active',
            'sex' => 'male',
            'phone' => '09111111111',
            'city' => 'Tuguegarao City',
            'state' => 'Cagayan',
            'barangay' => 'Centro',
            'house_number' => '456',
            'zone_purok' => 'Admin Zone',
            'address' => '456 Admin Street'
        ]);
    }
}
