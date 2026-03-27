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
        Schema::create('farmer_groups', function (Blueprint $table) {
            $table->id();
            $table->foreignId('admin_user_id')->constrained('users')->cascadeOnDelete();
            $table->string('group_name', 120);
            $table->string('region', 120)->nullable();
            $table->string('province', 120)->nullable();
            $table->string('municipality', 120)->nullable();
            $table->string('barangay', 120)->nullable();
            $table->text('description')->nullable();
            $table->timestamps();

            $table->unique(['admin_user_id', 'group_name']);
            $table->index('municipality');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('farmer_groups');
    }
};
