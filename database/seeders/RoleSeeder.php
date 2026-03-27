<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')->upsert([
            ['code' => 'SUPER_ADMIN', 'name' => 'Super Admin', 'hierarchy_level' => 100, 'created_at' => now(), 'updated_at' => now()],
            ['code' => 'ADMIN', 'name' => 'Admin/LGU Staff', 'hierarchy_level' => 80, 'created_at' => now(), 'updated_at' => now()],
            ['code' => 'COORDINATOR', 'name' => 'Coordinator', 'hierarchy_level' => 60, 'created_at' => now(), 'updated_at' => now()],
            ['code' => 'FARMER', 'name' => 'Farmer', 'hierarchy_level' => 10, 'created_at' => now(), 'updated_at' => now()],
        ], ['code'], ['name', 'hierarchy_level', 'updated_at']);
    }
}
