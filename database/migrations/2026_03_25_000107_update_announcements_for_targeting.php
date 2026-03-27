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
        Schema::table('announcements', function (Blueprint $table) {
            // Check if columns don't already exist
            if (!Schema::hasColumn('announcements', 'audience_scope')) {
                $table->enum('audience_scope', ['all', 'specific_group'])->default('all')->after('content');
            }
            if (!Schema::hasColumn('announcements', 'target_group_id')) {
                $table->foreignId('target_group_id')->nullable()->after('audience_scope')->constrained('farmer_groups')->nullOnDelete();
            }
            if (!Schema::hasColumn('announcements', 'is_published')) {
                $table->boolean('is_published')->default(true)->after('target_group_id');
            }
            if (!Schema::hasColumn('announcements', 'starts_at')) {
                $table->dateTime('starts_at')->nullable()->after('is_published');
            }
            if (!Schema::hasColumn('announcements', 'ends_at')) {
                $table->dateTime('ends_at')->nullable()->after('starts_at');
            }

            // Create index if it doesn't exist
            if (!Schema::hasIndex('announcements', 'idx_ann_scope_publish')) {
                $table->index(['audience_scope', 'is_published'], 'idx_ann_scope_publish');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('announcements', function (Blueprint $table) {
            $table->dropIndex('idx_ann_scope_publish');
            $table->dropConstrainedForeignId('target_group_id');
            $table->dropColumn(['audience_scope', 'is_published', 'starts_at', 'ends_at']);
        });
    }
};
