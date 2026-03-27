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
        Schema::create('livestock', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('animal_type');
            $table->string('breed')->nullable();
            $table->unsignedInteger('quantity')->default(1);
            $table->unsignedInteger('age_months')->nullable();
            $table->enum('health_status', ['healthy', 'sick', 'recovering'])->default('healthy');
            $table->date('purchase_date')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('livestock');
    }
};
