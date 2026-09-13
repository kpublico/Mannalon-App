<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations - Seed initial communication permissions
     */
    public function up(): void
    {
        $permissions = [
            // Farmer communications
            [
                'sender_role' => 'farmer',
                'recipient_role' => 'admin',
                'is_enabled' => true,
                'communication_method' => 'direct',
                'description' => 'Farmer can send direct messages to admin',
            ],
            [
                'sender_role' => 'farmer',
                'recipient_role' => 'coordinator',
                'is_enabled' => true,
                'communication_method' => 'direct',
                'description' => 'Farmer can send direct messages to coordinator',
            ],
            [
                'sender_role' => 'farmer',
                'recipient_role' => 'farmer',
                'is_enabled' => true,
                'communication_method' => 'direct',
                'description' => 'Farmers can communicate with each other',
            ],

            // Admin communications
            [
                'sender_role' => 'admin',
                'recipient_role' => 'farmer',
                'is_enabled' => true,
                'communication_method' => 'direct',
                'description' => 'Admin can send direct messages to farmer',
            ],
            [
                'sender_role' => 'admin',
                'recipient_role' => 'farmer',
                'is_enabled' => true,
                'communication_method' => 'broadcast',
                'description' => 'Admin can broadcast announcements to farmers',
            ],
            [
                'sender_role' => 'admin',
                'recipient_role' => 'admin',
                'is_enabled' => true,
                'communication_method' => 'direct',
                'description' => 'Admins can communicate with each other',
            ],
            [
                'sender_role' => 'admin',
                'recipient_role' => 'super_admin',
                'is_enabled' => true,
                'communication_method' => 'direct',
                'description' => 'Admin can report to super admin',
            ],
            [
                'sender_role' => 'admin',
                'recipient_role' => 'coordinator',
                'is_enabled' => true,
                'communication_method' => 'direct',
                'description' => 'Admin can coordinate with coordinator',
            ],

            // Super Admin communications
            [
                'sender_role' => 'super_admin',
                'recipient_role' => 'admin',
                'is_enabled' => true,
                'communication_method' => 'direct',
                'description' => 'Super admin can send directives to admin',
            ],
            [
                'sender_role' => 'super_admin',
                'recipient_role' => 'admin',
                'is_enabled' => true,
                'communication_method' => 'broadcast',
                'description' => 'Super admin can broadcast to all admins',
            ],
            [
                'sender_role' => 'super_admin',
                'recipient_role' => 'super_admin',
                'is_enabled' => true,
                'communication_method' => 'direct',
                'description' => 'Super admins can communicate with each other',
            ],
            [
                'sender_role' => 'super_admin',
                'recipient_role' => 'farmer',
                'is_enabled' => true,
                'communication_method' => 'announcement',
                'description' => 'Super admin can send system announcements to farmers',
            ],

            // Coordinator communications
            [
                'sender_role' => 'coordinator',
                'recipient_role' => 'farmer',
                'is_enabled' => true,
                'communication_method' => 'direct',
                'description' => 'Coordinator can assist farmers',
            ],
            [
                'sender_role' => 'coordinator',
                'recipient_role' => 'admin',
                'is_enabled' => true,
                'communication_method' => 'direct',
                'description' => 'Coordinator can report to admin',
            ],
            [
                'sender_role' => 'coordinator',
                'recipient_role' => 'coordinator',
                'is_enabled' => true,
                'communication_method' => 'direct',
                'description' => 'Coordinators can share information',
            ],
        ];

        $table = 'communication_permissions';
        foreach ($permissions as $permission) {
            \Illuminate\Support\Facades\DB::table($table)->insert(array_merge($permission, [
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Just delete all permissions if we need to roll back
        \Illuminate\Support\Facades\DB::table('communication_permissions')->truncate();
    }
};
