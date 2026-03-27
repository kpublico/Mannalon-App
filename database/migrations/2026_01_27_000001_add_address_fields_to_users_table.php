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
        Schema::table('users', function (Blueprint $table) {
            // Add gender column if not exists
            if (!Schema::hasColumn('users', 'gender')) {
                $table->enum('gender', ['male', 'female'])->nullable()->after('role');
            }
            
            // Add house_number column if not exists
            if (!Schema::hasColumn('users', 'house_number')) {
                $table->string('house_number')->nullable()->after('address');
            }
            
            // Add zone_purok column if not exists
            if (!Schema::hasColumn('users', 'zone_purok')) {
                $table->string('zone_purok')->nullable()->after('house_number');
            }
            
            // Add barangay column if not exists
            if (!Schema::hasColumn('users', 'barangay')) {
                $table->string('barangay')->nullable()->after('zone_purok');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'gender')) {
                $table->dropColumn('gender');
            }
            if (Schema::hasColumn('users', 'house_number')) {
                $table->dropColumn('house_number');
            }
            if (Schema::hasColumn('users', 'zone_purok')) {
                $table->dropColumn('zone_purok');
            }
            if (Schema::hasColumn('users', 'barangay')) {
                $table->dropColumn('barangay');
            }
        });
    }
};
