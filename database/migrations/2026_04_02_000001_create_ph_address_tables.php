<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ph_regions', function (Blueprint $table) {
            $table->id();
            $table->string('code', 9)->unique();
            $table->string('name');
            $table->string('region_id', 2)->index();
        });

        Schema::create('ph_provinces', function (Blueprint $table) {
            $table->id();
            $table->string('code', 9)->unique();
            $table->string('name');
            $table->string('region_id', 2)->index();
            $table->string('province_id', 4)->index();
        });

        Schema::create('ph_cities', function (Blueprint $table) {
            $table->id();
            $table->string('code', 9)->unique();
            $table->string('name');
            $table->string('region_id', 2)->index();
            $table->string('province_id', 4)->index();
            $table->string('city_id', 6)->index();
        });

        Schema::create('ph_barangays', function (Blueprint $table) {
            $table->id();
            $table->string('code', 9)->unique();
            $table->string('name');
            $table->string('region_id', 2)->index();
            $table->string('province_id', 4)->index();
            $table->string('city_id', 6)->index();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ph_barangays');
        Schema::dropIfExists('ph_cities');
        Schema::dropIfExists('ph_provinces');
        Schema::dropIfExists('ph_regions');
    }
};
