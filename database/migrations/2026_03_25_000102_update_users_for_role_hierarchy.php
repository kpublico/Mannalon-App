<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::table('roles')->insertOrIgnore([
            [
                'code' => 'SUPER_ADMIN',
                'name' => 'Super Admin',
                'hierarchy_level' => 100,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => 'ADMIN',
                'name' => 'Admin/LGU Staff',
                'hierarchy_level' => 80,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => 'FARMER',
                'name' => 'Farmer',
                'hierarchy_level' => 10,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => 'COORDINATOR',
                'name' => 'Coordinator',
                'hierarchy_level' => 60,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        DB::statement("ALTER TABLE users MODIFY role ENUM('farmer','admin','super_admin','coordinator') DEFAULT 'farmer'");

        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'role_id')) {
                $table->foreignId('role_id')->nullable()->after('role')->constrained('roles')->nullOnDelete();
            }
        });

        DB::statement(
            "UPDATE users u
            SET u.role_id = (
                SELECT r.id
                FROM roles r
                WHERE r.code = CASE u.role
                    WHEN 'super_admin' THEN 'SUPER_ADMIN'
                    WHEN 'admin' THEN 'ADMIN'
                    WHEN 'coordinator' THEN 'COORDINATOR'
                    ELSE 'FARMER'
                END
                LIMIT 1
            )
            WHERE u.role_id IS NULL"
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'role_id')) {
                $table->dropConstrainedForeignId('role_id');
            }
        });

        DB::statement("UPDATE users SET role = 'admin' WHERE role = 'super_admin'");
        DB::statement("UPDATE users SET role = 'admin' WHERE role = 'coordinator'");
        DB::statement("ALTER TABLE users MODIFY role ENUM('farmer','admin') DEFAULT 'farmer'");
    }
};
