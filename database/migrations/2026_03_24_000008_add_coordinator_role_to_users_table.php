<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement("ALTER TABLE users MODIFY role ENUM('farmer', 'admin', 'coordinator') NOT NULL DEFAULT 'farmer'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("UPDATE users SET role = 'farmer' WHERE role = 'coordinator'");
        DB::statement("ALTER TABLE users MODIFY role ENUM('farmer', 'admin') NOT NULL DEFAULT 'farmer'");
    }
};
