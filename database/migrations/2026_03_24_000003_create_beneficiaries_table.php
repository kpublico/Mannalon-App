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
        Schema::create('beneficiaries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('farmer_id')->constrained('farmers')->cascadeOnDelete();
            $table->string('service_type');
            $table->string('program_name')->nullable();
            $table->decimal('aid_amount', 12, 2)->nullable();
            $table->enum('ayuda_status', ['pending', 'claimed'])->default('pending');
            $table->date('distributed_at')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->index(['service_type', 'ayuda_status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('beneficiaries');
    }
};
