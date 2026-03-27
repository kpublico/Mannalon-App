<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    /**
     * Show the login form
     */
    public function showLogin(): View
    {
        return view('auth.login');
    }

    /**
     * Handle login logic
     */
    public function login(Request $request): RedirectResponse
    {
        // Validate input
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $validated = $validator->validated();

        // Find user by email
        $user = User::where('email', $validated['email'])->first();

        // Check if user exists and password is correct
        if ($user && Hash::check($validated['password'], $user->password)) {
            // Check if user account is active
            if ($user->status !== 'active') {
                return back()->withErrors(['email' => 'Your account has been deactivated.'])->withInput();
            }

            // Use Laravel's built-in authentication
            Auth::login($user);

            // Redirect based on user role
            if (in_array($user->role, ['admin', 'super_admin'], true)) {
                return redirect()->route('admin.dashboard')->with('success', 'Login successful!');
            } else {
                return redirect()->route('farmer.home')->with('success', 'Login successful!');
            }
        }

        // Login failed
        return back()->withErrors(['email' => 'Invalid email or password.'])->withInput();
    }

    /**
     * Show the registration form
     */
    public function showRegister(): View
    {
        return view('auth.register');
    }

    /**
     * Handle registration logic
     */
    public function register(Request $request): RedirectResponse
    {
        // Validate input
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required',
            'sex' => 'required|in:male,female',
            'state' => 'required|string|max:100',
            'city' => 'required|string|max:100',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'house_number' => 'nullable|string|max:50',
            'zone_purok' => 'nullable|string|max:100',
            'barangay' => 'nullable|string|max:100'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $validated = $validator->validated();

        // Create new user with default 'farmer' role
        try {
            $user = User::create([
                'name' => $validated['first_name'] . ' ' . $validated['last_name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
                'role' => 'farmer', // Default role for all public registrations
                'status' => 'active',
                'sex' => $validated['sex'],
                'phone' => $validated['phone'] ?? null,
                'house_number' => $validated['house_number'] ?? null,
                'zone_purok' => $validated['zone_purok'] ?? null,
                'address' => $validated['address'] ?? null,
                'city' => $validated['city'],
                'state' => $validated['state'],
                'barangay' => $validated['barangay'] ?? null,
            ]);

            // Don't set session - redirect to login page instead
            return redirect()->route('login')->with('success', 'Registration successful! Please log in with your credentials.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Registration failed. Please try again.'])->withInput();
        }
    }

    /**
     * Handle logout
     */
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Logged out successfully!');
    }
}
