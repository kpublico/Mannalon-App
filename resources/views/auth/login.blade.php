<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - MannalonApp</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #ffffff;
            min-height: 100vh;
        }
        
        .login-card {
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
        }

        input:focus {
            box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1);
        }

        .feature-item {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 16px;
        }

        .checkmark {
            color: #10b981;
            font-size: 20px;
            font-weight: bold;
        }

        .password-toggle {
            cursor: pointer;
            color: #6b7280;
            transition: color 0.2s;
        }

        .password-toggle:hover {
            color: #064e3b;
        }

        .form-input-group {
            position: relative;
        }

        .input-icon {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: #9ca3af;
            font-size: 18px;
        }

        input[type="email"],
        input[type="password"] {
            padding-left: 50px;
            padding-right: 40px;
        }

        .btn-signin {
            background-color: #064e3b;
            transition: all 0.3s ease;
        }

        .btn-signin:hover {
            background-color: #053d31;
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(6, 78, 59, 0.3);
        }

        .btn-signin:active {
            transform: translateY(0);
        }

        .link-hover {
            transition: color 0.2s;
        }

        .link-hover:hover {
            color: #047857;
        }

        @media (max-width: 768px) {
            .login-card {
                margin: 1rem;
            }
        }
    </style>
</head>
<body>
    <div class="min-h-screen flex items-center justify-center px-4 py-8">
        <div class="login-card w-full max-w-4xl rounded-3xl overflow-hidden bg-white">
            <div class="grid grid-cols-1 md:grid-cols-2">
                <!-- LEFT SIDE - BRANDING (Emerald Green) -->
                <div class="bg-emerald-800 text-white p-8 md:p-12 flex flex-col justify-between min-h-96">
                    <!-- Logo and Title -->
                    <div class="flex flex-col items-center md:items-start">
                        <div class="w-20 h-20 md:w-24 md:h-24 rounded-full bg-white bg-opacity-20 flex items-center justify-center mb-6 backdrop-blur-sm border border-white border-opacity-30">
                            <img src="/images/logo.png" alt="MannalonApp Logo" style="width: 50px; height: 50px; object-fit: contain;">
                        </div>
                        <h1 class="text-3xl md:text-4xl font-bold mb-3 text-center md:text-left">
                            Welcome to MannalonApp
                        </h1>
                        <p class="text-emerald-100 text-sm md:text-base leading-relaxed text-center md:text-left">
                            The official digital platform for Filipino Palay farmers to access grains data and farming guides.
                        </p>
                    </div>

                    <!-- Features -->
                    <div class="mt-8 md:mt-12 space-y-4">
                        <div class="feature-item">
                            <span class="checkmark">✓</span>
                            <span class="text-emerald-50">Secure & Encrypted</span>
                        </div>
                        <div class="feature-item">
                            <span class="checkmark">✓</span>
                            <span class="text-emerald-50">24/7 Access</span>
                        </div>
                        <div class="feature-item">
                            <span class="checkmark">✓</span>
                            <span class="text-emerald-50">Fast Processing</span>
                        </div>
                    </div>
                </div>

                <!-- RIGHT SIDE - LOGIN FORM (White) -->
                <div class="p-8 md:p-12 bg-white">
                    <!-- Form Header -->
                    <div class="mb-8">
                        <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-2">Log In</h2>
                        <p class="text-gray-600 text-sm md:text-base">
                            Enter your credentials to access your account
                        </p>
                    </div>

                    <!-- Login Form -->
                    <form method="POST" action="{{ route('login.store') }}" class="space-y-5">
                        @csrf

                        <!-- Email Input -->
                        <div>
                            <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">
                                Email Address
                            </label>
                            <div class="form-input-group">
                                <svg class="input-icon" style="width: 18px; height: 18px; position: absolute; left: 12px; top: 50%; transform: translateY(-50%);" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <rect x="2" y="4" width="20" height="16" rx="2"/>
                                    <path d="m22 7-10 5L2 7"/>
                                </svg>
                                <input
                                    type="email"
                                    id="email"
                                    name="email"
                                    placeholder="you@example.com"
                                    class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:border-emerald-600 focus:outline-none transition"
                                    required
                                >
                            </div>
                        </div>

                        <!-- Password Input -->
                        <div>
                            <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">
                                Password
                            </label>
                            <div class="form-input-group relative">
                                <svg class="input-icon" style="width: 18px; height: 18px; position: absolute; left: 12px; top: 50%; transform: translateY(-50%);" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/>
                                    <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                                </svg>
                                <input
                                    type="password"
                                    id="password"
                                    name="password"
                                    placeholder="••••••••"
                                    class="w-full py-3 border-2 border-gray-300 rounded-lg focus:border-emerald-600 focus:outline-none transition"
                                    style="padding-left: 50px; padding-right: 40px;"
                                    required
                                >
                                <button
                                    type="button"
                                    onclick="togglePassword()"
                                    class="absolute right-3 top-1/2 transform -translate-y-1/2 password-toggle text-gray-600 hover:text-gray-900 flex items-center justify-center w-5 h-5"
                                    tabindex="-1"
                                    style="min-width: 18px; min-height: 18px;"
                                >
                                    <svg id="eyeIcon" style="width: 18px; height: 18px; display: none; position: absolute;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                                        <circle cx="12" cy="12" r="3"/>
                                    </svg>
                                    <svg id="eyeOffIcon" style="width: 18px; height: 18px; position: absolute;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"/>
                                        <line x1="1" y1="1" x2="23" y2="23"/>
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <!-- Forgot Password Link -->
                        <div class="flex justify-end">
                            <a href="#" class="text-sm font-medium text-emerald-600 link-hover hover:text-emerald-700">
                                Forgot password?
                            </a>
                        </div>

                        <!-- Sign In Button -->
                        <button
                            type="submit"
                            class="w-full btn-signin bg-emerald-900 text-white font-bold py-3 px-4 rounded-lg flex items-center justify-center gap-2 mt-6"
                        >
                            <svg style="width: 18px; height: 18px;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M15 3H7a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h8"/>
                                <polyline points="10 12 15 12 12 9"/>
                                <polyline points="15 12 12 15"/>
                            </svg>
                            <span>Sign In</span>
                        </button>

                        <!-- Error Messages -->
                        @if ($errors->any())
                            <div class="bg-red-50 border-l-4 border-red-500 p-4 rounded">
                                <p class="text-red-700 font-semibold text-sm mb-2">Login failed</p>
                                <ul class="text-red-600 text-sm space-y-1">
                                    @foreach ($errors->all() as $error)
                                        <li>• {{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </form>

                    <!-- Footer Links -->
                    <div class="mt-8 space-y-4 border-t border-gray-200 pt-6">
                        <p class="text-center text-gray-700 text-sm">
                            Don't have an account?
                            <a href="{{ route('register') }}" class="font-semibold text-emerald-600 link-hover hover:text-emerald-700">
                                Create Account
                            </a>
                        </p>
                        <div class="text-center">
                            <a href="{{ url('/') }}" class="text-sm text-gray-600 link-hover hover:text-gray-900 flex items-center justify-center gap-1">
                                ← Back to Home
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eyeIcon');
            const eyeOffIcon = document.getElementById('eyeOffIcon');
            const passwordType = passwordInput.getAttribute('type');
            
            if (passwordType === 'password') {
                passwordInput.setAttribute('type', 'text');
                eyeIcon.style.display = 'block';
                eyeOffIcon.style.display = 'none';
            } else {
                passwordInput.setAttribute('type', 'password');
                eyeIcon.style.display = 'none';
                eyeOffIcon.style.display = 'block';
            }
        }

        // Focus effects
        document.addEventListener('DOMContentLoaded', function() {
            const inputs = document.querySelectorAll('input[type="email"], input[type="password"]');
            inputs.forEach(input => {
                input.addEventListener('focus', function() {
                    this.parentElement.querySelector('.input-icon').style.color = '#059669';
                });
                input.addEventListener('blur', function() {
                    this.parentElement.querySelector('.input-icon').style.color = '#9ca3af';
                });
            });
        });
    </script>
</body>
</html>
