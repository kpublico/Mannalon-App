<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (!Schema::hasColumn('farmers', 'land_boundary_points')) {
            Schema::table('farmers', function (Blueprint $table): void {
                $table->json('land_boundary_points')->nullable()->after('gps_longitude');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('farmers', 'land_boundary_points')) {
            Schema::table('farmers', function (Blueprint $table): void {
                $table->dropColumn('land_boundary_points');
            });
        }
    }
};
