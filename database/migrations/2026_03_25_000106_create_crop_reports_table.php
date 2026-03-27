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
        Schema::create('crop_reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('farmer_profile_id')->constrained('farmer_profiles')->cascadeOnDelete();
            $table->foreignId('reported_by_user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('reviewed_by_admin_user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('crop_name', 120);
            $table->string('season', 60)->nullable();
            $table->decimal('area_hectares', 10, 2)->nullable();
            $table->date('planting_date')->nullable();
            $table->date('expected_harvest_date')->nullable();
            $table->date('actual_harvest_date')->nullable();
            $table->decimal('estimated_yield_kg', 12, 2)->nullable();
            $table->decimal('actual_yield_kg', 12, 2)->nullable();
            $table->enum('status', ['draft', 'submitted', 'approved', 'rejected'])->default('draft');
            $table->text('remarks')->nullable();
            $table->dateTime('submitted_at')->nullable();
            $table->dateTime('reviewed_at')->nullable();
            $table->timestamps();

            $table->index(['farmer_profile_id', 'status']);
            $table->index(['reported_by_user_id', 'planting_date']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('crop_reports');
    }
};
