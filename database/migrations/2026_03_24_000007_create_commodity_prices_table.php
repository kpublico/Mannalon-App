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
        Schema::create('commodity_prices', function (Blueprint $table) {
            $table->id();
            $table->string('commodity', 120);
            $table->decimal('price_per_kilo', 10, 2);
            $table->date('date_updated');
            $table->string('source_market', 120)->nullable();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();

            $table->index('commodity');
            $table->index('date_updated');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commodity_prices');
    }
};
