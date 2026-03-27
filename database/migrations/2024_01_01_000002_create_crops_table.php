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
        Schema::create('crops', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('crop_name');
            $table->string('crop_type')->nullable();
            $table->decimal('area_planted', 10, 2)->nullable();
            $table->date('planting_date')->nullable();
            $table->date('expected_harvest_date')->nullable();
            $table->enum('status', ['planning', 'growing', 'ready', 'harvested'])->default('planning');
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('crops');
    }
};
