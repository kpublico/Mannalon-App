<?php

namespace App\Modules\Auth\Services;

use App\Modules\Auth\Models\User;
use Illuminate\Support\Facades\Hash;
use Exception;

class AuthService
{
    /**
     * Register a new user
     */
    public function register(array $data): User
    {
        try {
            return User::create([
                'name' => $data['first_name'] . ' ' . $data['last_name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'role' => $data['role'] ?? 'farmer',
                'status' => 'active',
                'phone' => $data['phone'] ?? null,
                'address' => $data['address'] ?? null,
                'city' => $data['city'] ?? null,
                'state' => $data['state'] ?? null,
                'sex' => $data['sex'] ?? null,
            ]);
        } catch (Exception $e) {
            throw new Exception('User registration failed: ' . $e->getMessage());
        }
    }

    /**
     * Authenticate user
     */
    public function authenticate(string $email, string $password): ?User
    {
        $user = User::where('email', $email)->first();

        if (!$user || !Hash::check($password, $user->password)) {
            return null;
        }

        if ($user->status !== 'active') {
            throw new Exception('Account is inactive');
        }

        return $user;
    }

    /**
     * Update user password
     */
    public function updatePassword(User $user, string $newPassword): bool
    {
        try {
            $user->update(['password' => Hash::make($newPassword)]);
            return true;
        } catch (Exception $e) {
            throw new Exception('Password update failed: ' . $e->getMessage());
        }
    }

    /**
     * Change user status
     */
    public function changeStatus(User $user, string $status): bool
    {
        try {
            $user->update(['status' => $status]);
            return true;
        } catch (Exception $e) {
            throw new Exception('Status change failed: ' . $e->getMessage());
        }
    }
}
