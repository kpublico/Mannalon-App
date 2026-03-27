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
        Schema::table('farming_guides', function (Blueprint $table) {
            // Add PDF file field for downloadable guides
            $table->string('pdf_file', 255)->nullable()->after('resource_url');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('farming_guides', function (Blueprint $table) {
            $table->dropColumn('pdf_file');
        });
    }
};
