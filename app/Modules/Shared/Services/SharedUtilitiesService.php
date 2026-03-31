<?php

namespace App\Modules\Shared\Services;

use App\Modules\Shared\Models\CommunicationPermission;
use App\Modules\Shared\Models\Beneficiary;
use App\Modules\Shared\Models\ServiceAccessLog;
use App\Modules\Auth\Models\User;
use Exception;

class SharedUtilitiesService
{
    /**
     * Check communication permission
     */
    public function checkMessagePermission(User $sender, User $recipient): bool
    {
        $permission = CommunicationPermission::where('from_user_id', $sender->id)
            ->where('to_user_id', $recipient->id)
            ->first();

        return $permission ? $permission->can_message : false;
    }

    /**
     * Grant communication permission
     */
    public function grantPermission(User $from, User $to, string $permissionType = 'message'): CommunicationPermission
    {
        try {
            return CommunicationPermission::updateOrCreate(
                [
                    'from_user_id' => $from->id,
                    'to_user_id' => $to->id,
                    'permission_type' => $permissionType,
                ],
                ['granted_at' => now()]
            );
        } catch (Exception $e) {
            throw new Exception('Permission grant failed: ' . $e->getMessage());
        }
    }

    /**
     * Create beneficiary
     */
    public function createBeneficiary(array $data): Beneficiary
    {
        try {
            return Beneficiary::create([
                'farmer_id' => $data['farmer_id'],
                'program_id' => $data['program_id'] ?? null,
                'beneficiary_status' => $data['status'] ?? 'active',
                'notes' => $data['notes'] ?? null,
            ]);
        } catch (Exception $e) {
            throw new Exception('Beneficiary creation failed: ' . $e->getMessage());
        }
    }

    /**
     * Log service access
     */
    public function logAccess(User $user, string $service = 'system', string $action = 'access'): ServiceAccessLog
    {
        try {
            return ServiceAccessLog::updateOrCreate(
                [
                    'user_id' => $user->id,
                    'service_name' => $service,
                ],
                [
                    'action' => $action,
                    'access_timestamp' => now(),
                ]
            );
        } catch (Exception $e) {
            throw new Exception('Service access logging failed: ' . $e->getMessage());
        }
    }

    /**
     * Get communication stats
     */
    public function getCommunicationStats(): array
    {
        return [
            'totalPermissions' => CommunicationPermission::count(),
            'activeBeneficiaries' => Beneficiary::where('beneficiary_status', 'active')->count(),
            'accessLogEntries' => ServiceAccessLog::count(),
        ];
    }
}
