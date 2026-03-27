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
        Schema::create('farmer_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->unique()->constrained('users')->cascadeOnDelete();
            $table->foreignId('farmer_group_id')->constrained('farmer_groups')->cascadeOnDelete();
            $table->foreignId('legacy_farmer_id')->nullable()->constrained('farmers')->nullOnDelete();
            $table->string('farmer_code', 60)->nullable()->unique();
            $table->date('birth_date')->nullable();
            $table->string('farm_name', 150)->nullable();
            $table->string('farm_location', 255)->nullable();
            $table->decimal('farm_size_hectares', 10, 2)->nullable();
            $table->date('registration_date')->nullable();
            $table->timestamps();

            $table->index('farmer_group_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('farmer_profiles');
    }
};
