<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account - Mannalon App</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f9f8f6;
            min-height: 100vh;
            padding: 20px;
        }

        @media (min-width: 768px) {
            body {
                padding: 40px 20px;
            }
        }

        .form-card {
            border-left: 4px solid #10b981;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            background: #ffffff;
            border-radius: 12px;
            padding: 20px;
            transition: box-shadow 0.3s ease;
        }

        @media (min-width: 768px) {
            .form-card {
                padding: 28px;
            }
        }

        .form-card:hover {
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.15);
        }

        .form-group {
            margin-bottom: 16px;
        }

        @media (min-width: 768px) {
            .form-group {
                margin-bottom: 20px;
            }
        }

        .form-group label {
            display: block;
            color: #374151;
            font-size: 0.85rem;
            font-weight: 600;
            margin-bottom: 6px;
            letter-spacing: 0.3px;
        }

        @media (min-width: 768px) {
            .form-group label {
                font-size: 0.95rem;
                margin-bottom: 8px;
            }
        }

        input[type="text"],
        input[type="email"],
        input[type="password"],
        select {
            color: #1f2937;
            font-size: 1rem;
            font-weight: 500;
            width: 100%;
        }

        input::placeholder {
            color: #9ca3af;
            font-weight: 400;
        }

        .password-toggle-btn {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            cursor: pointer;
            padding: 6px 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #9ca3af;
            transition: color 0.2s ease;
            min-width: 44px;
            min-height: 44px;
            -webkit-appearance: none;
        }

        .password-toggle-btn:hover {
            color: #10b981;
        }

        .password-toggle-btn:active {
            color: #059669;
        }

        .password-toggle-btn svg {
            width: 18px;
            height: 18px;
            stroke-width: 2;
        }

        @media (min-width: 768px) {
            .password-toggle-btn svg {
                width: 20px;
                height: 20px;
            }
        }

        .form-container {
            width: 100%;
            max-width: 400px;
            margin: 0 auto;
        }

        @media (min-width: 1024px) {
            .form-container {
                max-width: 900px;
            }
        }

        .main-heading {
            text-align: center;
            margin-bottom: 30px;
        }

        @media (min-width: 768px) {
            .main-heading {
                margin-bottom: 50px;
            }
        }

        .main-heading h1 {
            color: #1f2937;
            font-size: 1.75rem;
            font-weight: 800;
            margin-bottom: 8px;
            letter-spacing: -0.5px;
        }

        @media (min-width: 768px) {
            .main-heading h1 {
                font-size: 2.5rem;
                margin-bottom: 10px;
            }
        }

        .main-heading p {
            color: #6b7280;
            font-size: 0.95rem;
            font-weight: 500;
        }

        @media (min-width: 768px) {
            .main-heading p {
                font-size: 1.1rem;
            }
        }

        .top-icon {
            width: 70px;
            height: 70px;
            margin: 0 auto 20px;
            background-color: #10b981;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 38px;
            box-shadow: 0 4px 15px rgba(16, 185, 129, 0.3);
        }

        @media (min-width: 768px) {
            .top-icon {
                width: 80px;
                height: 80px;
                margin: 0 auto 30px;
                font-size: 45px;
            }
        }

        .section-header {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 20px;
            color: #059669;
            font-size: 1.1rem;
            font-weight: 700;
            padding-bottom: 10px;
            border-bottom: 2px solid #f0fdf4;
            flex-wrap: wrap;
        }

        @media (min-width: 768px) {
            .section-header {
                gap: 12px;
                margin-bottom: 25px;
                font-size: 1.3rem;
            }
        }

        .section-header span:first-child {
            font-size: 24px;
        }

        @media (min-width: 768px) {
            .section-header span:first-child {
                font-size: 28px;
            }
        }

        input:focus, select:focus {
            border-color: #10b981 !important;
            box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1) !important;
            outline: none;
        }

        .btn-submit {
            background-color: #10b981;
            transition: all 0.3s ease;
            font-size: 16px;
            font-weight: 600;
            padding: 12px 20px;
            border-radius: 10px;
            color: white;
            width: 100%;
            border: none;
            cursor: pointer;
            min-height: 44px;
            -webkit-appearance: none;
        }

        @media (min-width: 768px) {
            .btn-submit {
                font-size: 18px;
                padding: 14px 20px;
            }
        }

        .btn-submit:hover {
            background-color: #059669;
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(16, 185, 129, 0.3);
        }

        .btn-submit:active {
            transform: translateY(0);
        }

        .footer-links {
            text-align: center;
            margin-top: 24px;
            display: flex;
            flex-direction: column;
            gap: 12px;
            font-size: 0.9rem;
        }

        @media (min-width: 768px) {
            .footer-links {
                margin-top: 30px;
                gap: 15px;
                font-size: 1rem;
            }
        }

        .footer-links a {
            color: #10b981;
            transition: color 0.2s;
            text-decoration: none;
            font-weight: 600;
        }

        .footer-links a:hover {
            color: #059669;
            text-decoration: underline;
        }

        .section-icon {
            width: 20px;
            height: 20px;
            flex-shrink: 0;
        }

        @media (min-width: 768px) {
            .section-icon {
                width: 24px;
                height: 24px;
            }
        }

        .gender-icon {
            width: 20px;
            height: 20px;
        }

        /* Responsive grid utilities */
        .grid-responsive {
            display: grid;
            grid-template-columns: 1fr;
            gap: 12px;
        }

        @media (min-width: 640px) {
            .grid-responsive {
                grid-template-columns: repeat(2, 1fr);
                gap: 16px;
            }
        }

        .grid-responsive-full {
            display: grid;
            grid-template-columns: 1fr;
            gap: 12px;
        }

        @media (min-width: 640px) {
            .grid-responsive-full {
                grid-template-columns: 1fr;
                gap: 16px;
            }
        }

        /* Touch-friendly spacing for mobile */
        @media (max-width: 640px) {
            input[type="text"],
            input[type="email"],
            input[type="password"],
            select,
            label {
                font-size: 16px;
            }

            .form-card {
                margin-bottom: 16px;
            }
        }

        /* Flexbox for gender selection that's responsive */
        .gender-options {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
        }

        @media (min-width: 768px) {
            .gender-options {
                gap: 16px;
            }
        }

        .gender-options label {
            user-select: none;
        }

        /* Terms section */
        .terms-section {
            padding: 16px;
        }

        @media (min-width: 768px) {
            .terms-section {
                padding: 20px;
            }
        }

        .terms-section input[type="checkbox"] {
            width: 20px;
            height: 20px;
            min-width: 20px;
            cursor: pointer;
        }

        .terms-section label {
            font-size: 0.85rem;
        }

        @media (min-width: 768px) {
            .terms-section label {
                font-size: 0.9rem;
            }
        }

        /* Error and Success Alerts */
        .error-alert {
            background-color: #fef2f2;
            border-left-color: #dc2626;
            border-left-width: 4px;
            border-radius: 0.5rem;
            padding: 1rem;
            margin-bottom: 1.5rem;
        }

        .error-alert h3 {
            color: #991b1b;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .error-alert ul {
            color: #7f1d1d;
            font-size: 0.875rem;
        }

        .error-alert li {
            margin-bottom: 0.25rem;
        }
    </style>
</head>
<body>
    <div class="flex items-center justify-center min-h-screen">
        <div class="form-container">
            <!-- Main Heading -->
            <div class="main-heading">
                <div class="top-icon">
                    <svg viewBox="0 0 60 60" style="width: 60px; height: 60px;">
                        <!-- Green circular background -->
                        <circle cx="30" cy="30" r="28" fill="#10b981"/>
                        <!-- User icon -->
                        <circle cx="30" cy="20" r="5" fill="#ffffff"/>
                        <path d="M 18 36 Q 18 33 24 31 Q 30 29 36 31 Q 42 33 42 36" fill="#ffffff"/>
                        <!-- Plus button -->
                        <circle cx="44" cy="44" r="8" fill="#ffffff"/>
                        <line x1="44" y1="40" x2="44" y2="48" stroke="#10b981" stroke-width="2" stroke-linecap="round"/>
                        <line x1="40" y1="44" x2="48" y2="44" stroke="#10b981" stroke-width="2" stroke-linecap="round"/>
                    </svg>
                </div>
                <h1>Create Your Account</h1>
                <p>Join our farming community and manage your farm efficiently</p>
            </div>

            <!-- Alert Messages -->
            <?php if($errors->any()): ?>
                <div class="bg-red-50 border-l-4 border-red-500 p-4 rounded-lg mb-6">
                    <div class="flex items-start">
                        <svg class="w-5 h-5 text-red-500 mt-0.5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4v.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <div>
                            <h3 class="text-red-800 font-semibold mb-2">Registration Error</h3>
                            <ul class="text-red-700 text-sm space-y-1 list-disc list-inside">
                                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li><?php echo e($error); ?></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Registration Form -->
            <form method="POST" action="<?php echo e(route('register.store')); ?>" class="space-y-6">
                <?php echo csrf_field(); ?>

                <!-- SECTION 1: Personal Information -->
                <div class="form-card">
                    <!-- Section Header -->
                    <div class="section-header">
                        <svg class="section-icon" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 12C14.21 12 16 10.21 16 8C16 5.79 14.21 4 12 4C9.79 4 8 5.79 8 8C8 10.21 9.79 12 12 12ZM12 14C9.67 14 5 15.17 5 17.5V20H19V17.5C19 15.17 14.33 14 12 14Z" fill="#10b981"/>
                        </svg>
                        <span>Personal Information</span>
                    </div>

                    <!-- First Name and Last Name -->
                    <div class="grid-responsive">
                        <div class="form-group">
                            <label for="first_name">First Name *</label>
                            <input
                                type="text"
                                id="first_name"
                                name="first_name"
                                placeholder="Juan"
                                class="w-full px-4 py-2.5 border-2 border-gray-300 rounded-lg transition"
                                value="<?php echo e(old('first_name')); ?>"
                                required
                            >
                            <?php $__errorArgs = ['first_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-red-600 text-sm mt-2 block"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        <div class="form-group">
                            <label for="last_name">Last Name *</label>
                            <input
                                type="text"
                                id="last_name"
                                name="last_name"
                                placeholder="Dela Cruz"
                                class="w-full px-4 py-2.5 border-2 border-gray-300 rounded-lg transition"
                                value="<?php echo e(old('last_name')); ?>"
                                required
                            >
                            <?php $__errorArgs = ['last_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-red-600 text-sm mt-2 block"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>

                    <!-- Phone and Email -->
                    <div class="grid-responsive">
                        <div class="form-group">
                            <label for="phone">Phone Number</label>
                            <input
                                type="text"
                                id="phone"
                                name="phone"
                                placeholder="09XXXXXXXXX"
                                class="w-full px-4 py-2.5 border-2 border-gray-300 rounded-lg transition"
                                value="<?php echo e(old('phone')); ?>"
                            >
                            <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-red-600 text-sm mt-2 block"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        <div class="form-group">
                            <label for="email">Email Address *</label>
                            <input
                                type="email"
                                id="email"
                                name="email"
                                placeholder="you@example.com"
                                class="w-full px-4 py-2.5 border-2 border-gray-300 rounded-lg transition"
                                value="<?php echo e(old('email')); ?>"
                                required
                            >
                            <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-red-600 text-sm mt-2 block"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>

                    <!-- Sex Selection -->
                    <div class="form-group">
                        <label>Sex *</label>
                        <div class="gender-options">
                            <label class="flex items-center cursor-pointer p-3 border-2 border-gray-300 rounded-lg hover:border-emerald-500 transition has-[:checked]:border-emerald-500 has-[:checked]:bg-emerald-50">
                                <input type="radio" name="sex" value="male" class="w-5 h-5 text-emerald-600 cursor-pointer" <?php echo e(old('sex') === 'male' ? 'checked' : ''); ?>>
                                <span class="ml-2 flex items-center gap-2 text-gray-700 font-medium text-sm md:text-base">
                                    <svg class="w-5 h-5 text-emerald-600" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 12C14.21 12 16 10.21 16 8C16 5.79 14.21 4 12 4C9.79 4 8 5.79 8 8C8 10.21 9.79 12 12 12ZM12 14C9.67 14 5 15.17 5 17.5V20H19V17.5C19 15.17 14.33 14 12 14Z"/>
                                    </svg>
                                    Male
                                </span>
                            </label>
                            <label class="flex items-center cursor-pointer p-3 border-2 border-gray-300 rounded-lg hover:border-pink-500 transition has-[:checked]:border-pink-500 has-[:checked]:bg-pink-50">
                                <input type="radio" name="sex" value="female" class="w-5 h-5 text-emerald-600 cursor-pointer" <?php echo e(old('sex') === 'female' ? 'checked' : ''); ?>>
                                <span class="ml-2 flex items-center gap-2 text-gray-700 font-medium text-sm md:text-base">
                                    <svg class="w-5 h-5 text-pink-600" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 12C14.21 12 16 10.21 16 8C16 5.79 14.21 4 12 4C9.79 4 8 5.79 8 8C8 10.21 9.79 12 12 12ZM12 14C9.67 14 5 15.17 5 17.5V20H19V17.5C19 15.17 14.33 14 12 14Z"/>
                                    </svg>
                                    Female
                                </span>
                            </label>
                        </div>
                        <?php $__errorArgs = ['sex'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-red-600 text-sm mt-2 block"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>

                <!-- SECTION 2: Address Information (Cagayan) -->
                <div class="form-card" x-data="addressForm()" x-init="init()">
                    <!-- Section Header -->
                    <div class="section-header">
                        <svg class="section-icon" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 2C6.48 2 2 6.48 2 12c0 7 10 12 10 12s10-5 10-12c0-5.52-4.48-10-10-10zm0 15c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5z" fill="#10b981"/>
                        </svg>
                        <span>Address Information (Cagayan Province)</span>
                    </div>

                    <div class="grid-responsive">
                        <div class="form-group">
                            <label for="house_number">House Number</label>
                            <input
                                type="text"
                                id="house_number"
                                name="house_number"
                                placeholder="e.g., 123"
                                class="w-full px-4 py-2.5 border-2 border-gray-300 rounded-lg transition focus:border-emerald-500 focus:outline-none"
                                value="<?php echo e(old('house_number')); ?>"
                            >
                            <?php $__errorArgs = ['house_number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-red-600 text-sm mt-2 block"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div class="form-group">
                            <label for="zone_purok">Zone/Purok</label>
                            <input
                                type="text"
                                id="zone_purok"
                                name="zone_purok"
                                placeholder="e.g., Purok 1, Zone A"
                                class="w-full px-4 py-2.5 border-2 border-gray-300 rounded-lg transition focus:border-emerald-500 focus:outline-none"
                                value="<?php echo e(old('zone_purok')); ?>"
                            >
                            <?php $__errorArgs = ['zone_purok'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-red-600 text-sm mt-2 block"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="address">Street Address</label>
                        <input
                            type="text"
                            id="address"
                            name="address"
                            placeholder="e.g., Maharlika Avenue, Bonifacio Street"
                            class="w-full px-4 py-2.5 border-2 border-gray-300 rounded-lg transition focus:border-emerald-500 focus:outline-none"
                            value="<?php echo e(old('address')); ?>"
                        >
                        <?php $__errorArgs = ['address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-red-600 text-sm mt-2 block"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div class="grid-responsive">
                        <div class="form-group">
                            <label for="municipality">City/Municipality *</label>
                            <select
                                id="municipality"
                                name="city"
                                x-model="selectedMunicipality"
                                @change="updateBarangays(); selectedBarangay = '';"
                                class="w-full px-4 py-2.5 border-2 border-gray-300 rounded-lg transition focus:border-emerald-500 focus:outline-none"
                                required
                            >
                                <option value="">Select municipality/city</option>
                                <option value="Aparri" <?php echo e(old('city') === 'Aparri' ? 'selected' : ''); ?>>Aparri</option>
                                <option value="Ballesteros" <?php echo e(old('city') === 'Ballesteros' ? 'selected' : ''); ?>>Ballesteros</option>
                                <option value="Buguey" <?php echo e(old('city') === 'Buguey' ? 'selected' : ''); ?>>Buguey</option>
                                <option value="Camalaniugan" <?php echo e(old('city') === 'Camalaniugan' ? 'selected' : ''); ?>>Camalaniugan</option>
                                <option value="Claveria" <?php echo e(old('city') === 'Claveria' ? 'selected' : ''); ?>>Claveria</option>
                                <option value="Enrile" <?php echo e(old('city') === 'Enrile' ? 'selected' : ''); ?>>Enrile</option>
                                <option value="Gattaran" <?php echo e(old('city') === 'Gattaran' ? 'selected' : ''); ?>>Gattaran</option>
                                <option value="Iguig" <?php echo e(old('city') === 'Iguig' ? 'selected' : ''); ?>>Iguig</option>
                                <option value="Lal-lo" <?php echo e(old('city') === 'Lal-lo' ? 'selected' : ''); ?>>Lal-lo</option>
                                <option value="Pamplona" <?php echo e(old('city') === 'Pamplona' ? 'selected' : ''); ?>>Pamplona</option>
                                <option value="Penablanca" <?php echo e(old('city') === 'Penablanca' ? 'selected' : ''); ?>>Penablanca</option>
                                <option value="Piat" <?php echo e(old('city') === 'Piat' ? 'selected' : ''); ?>>Piat</option>
                                <option value="Sanchez-Mira" <?php echo e(old('city') === 'Sanchez-Mira' ? 'selected' : ''); ?>>Sanchez-Mira</option>
                                <option value="Santa Ana" <?php echo e(old('city') === 'Santa Ana' ? 'selected' : ''); ?>>Santa Ana</option>
                                <option value="Solano" <?php echo e(old('city') === 'Solano' ? 'selected' : ''); ?>>Solano</option>
                                <option value="Tuguegarao City" <?php echo e(old('city') === 'Tuguegarao City' ? 'selected' : ''); ?>>Tuguegarao City</option>
                            </select>
                            <?php $__errorArgs = ['city'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-red-600 text-sm mt-2 block"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div class="form-group">
                            <label for="barangay">Barangay *</label>
                            <select
                                id="barangay"
                                name="barangay"
                                x-model="selectedBarangay"
                                @change="selectedBarangay = $el.value"
                                class="w-full px-4 py-2.5 border-2 border-gray-300 rounded-lg transition focus:border-emerald-500 focus:outline-none"
                                required
                            >
                                <option value="">Select barangay</option>
                            </select>
                            <?php $__errorArgs = ['barangay'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-red-600 text-sm mt-2 block"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>

                    <!-- Hidden Province Field -->
                    <input
                        type="hidden"
                        id="state"
                        name="state"
                        value="Cagayan"
                    >
                </div>

                <!-- SECTION 3: Account Credentials -->
                <div class="form-card">
                    <!-- Section Header -->
                    <div class="section-header">
                        <svg class="section-icon" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M18 8h-1V6c0-2.76-2.24-5-5-5s-5 2.24-5 5v2H6c-1.1 0-2 .9-2 2v10c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V10c0-1.1-.9-2-2-2zm-6 9c-1.1 0-2-.9-2-2s.9-2 2-2 2 .9 2 2-.9 2-2 2zm3.1-9H8.9V6c0-1.71 1.39-3.1 3.1-3.1 1.71 0 3.1 1.39 3.1 3.1v2z" fill="#10b981"/>
                        </svg>
                        <span>Account Credentials</span>
                    </div>

                    <div class="grid-responsive">
                        <!-- Password Input -->
                        <div class="form-group">
                            <label for="password">Password *</label>
                            <div class="relative">
                                <input
                                    type="password"
                                    id="password"
                                    name="password"
                                    placeholder="••••••••"
                                    class="w-full px-4 py-2.5 border-2 border-gray-300 rounded-lg transition pr-10"
                                    required
                                >
                                <button
                                    type="button"
                                    onclick="togglePassword('password')"
                                    class="password-toggle-btn"
                                    tabindex="-1"
                                >
                                    <svg class="eye-icon hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                    <svg class="eye-slash-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-2.391m5.005-2.905A3.001 3.001 0 1015 9c0-1.105-.92-2-2.05-2.05"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.88 9.88a3 3 0 1.06 1.06M3 3l18 18"></path>
                                    </svg>
                                </button>
                            </div>
                            <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-red-600 text-sm mt-2 block"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <!-- Confirm Password Input -->
                        <div class="form-group">
                            <label for="password_confirmation">Confirm Password *</label>
                            <div class="relative">
                                <input
                                    type="password"
                                    id="password_confirmation"
                                    name="password_confirmation"
                                    placeholder="••••••••"
                                    class="w-full px-4 py-2.5 border-2 border-gray-300 rounded-lg transition pr-10"
                                    required
                                >
                                <button
                                    type="button"
                                    onclick="togglePassword('password_confirmation')"
                                    class="password-toggle-btn"
                                    tabindex="-1"
                                >
                                    <svg class="eye-icon hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                    <svg class="eye-slash-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-2.391m5.005-2.905A3.001 3.001 0 1015 9c0-1.105-.92-2-2.05-2.05"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.88 9.88a3 3 0 1.06 1.06M3 3l18 18"></path>
                                    </svg>
                                </button>
                            </div>
                            <?php $__errorArgs = ['password_confirmation'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-red-600 text-sm mt-2 block"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>
                </div>

                <!-- Terms & Conditions -->
                <div class="terms-section p-4 rounded-xl border-l-4 <?php $__errorArgs = ['terms'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> bg-red-50 border-red-600 <?php else: ?> bg-emerald-50 border-emerald-600 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                    <div class="flex items-start gap-3">
                        <input type="checkbox" id="terms" name="terms" class="w-5 h-5 text-emerald-600 rounded cursor-pointer mt-1" <?php if(old('terms')): ?> checked <?php endif; ?>>
                        <label for="terms" class="text-sm <?php $__errorArgs = ['terms'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> text-red-700 <?php else: ?> text-gray-700 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                            I agree to the <span class="font-semibold <?php $__errorArgs = ['terms'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> text-red-700 <?php else: ?> text-emerald-700 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> cursor-pointer hover:underline">Terms of Service</span> and <span class="font-semibold <?php $__errorArgs = ['terms'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> text-red-700 <?php else: ?> text-emerald-700 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> cursor-pointer hover:underline">Privacy Policy</span>
                        </label>
                    </div>
                    <?php $__errorArgs = ['terms'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-red-600 text-sm mt-2 block"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <!-- Submit Button -->
                <button
                    type="submit"
                    class="btn-submit"
                >
                    Create Account
                </button>

                <!-- Footer Links -->
                <div class="footer-links">
                    <div class="text-gray-700">
                        Already have an account?
                        <a href="<?php echo e(route('login')); ?>">Log In</a>
                    </div>
                    <div>
                        <a href="<?php echo e(url('/')); ?>">← Back to Home</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        function addressForm() {
            return {
                selectedMunicipality: '',
                selectedBarangay: '',
                
                barangaysByCity: {
                    'Aparri': ['Calanasan', 'Macanaya', 'Namuac', 'San Vicente', 'Tabaco'],
                    'Ballesteros': ['Balagan', 'Balili', 'Bangnera', 'Capintalan', 'Capol'],
                    'Buguey': ['Bagacay', 'Baggao', 'Balanag', 'Banabang', 'Buguey Proper'],
                    'Camalaniugan': ['Aglao', 'Aliwis', 'Bambang', 'Bangcal', 'Carangian'],
                    'Claveria': ['Casili', 'Duran', 'Malibago', 'Pattug', 'San Vicente'],
                    'Enrile': ['Bao', 'Dananao', 'Rosario', 'Tabuk', 'Victoria'],
                    'Gattaran': ['Acab', 'Banugao', 'Caruan', 'Dinglayan', 'Luyang'],
                    'Iguig': ['Aglao', 'Ampalong', 'Baasan', 'Bamban', 'Banganan'],
                    'Lal-lo': ['Adayat', 'Ag-agrusan', 'Cabagan', 'Daffing', 'Dungdung'],
                    'Pamplona': ['Abucay', 'Bagtacan', 'Bangnera', 'Bangon', 'Bugallon'],
                    'Penablanca': ['Abutin', 'Amarang', 'Amasing', 'Amilongan', 'Anao-ao'],
                    'Piat': ['Abang', 'Abalayan', 'Abat', 'Abella', 'Able'],
                    'Sanchez-Mira': ['Abagatanan', 'Abangan', 'Abanilla', 'Abasi', 'Abatan'],
                    'Santa Ana': ['Actub', 'Afunan', 'Cabuaan', 'Dagdag', 'Dammug'],
                    'Solano': ['Abangan', 'Abuán', 'Acab', 'Acapan', 'Acpang'],
                    'Tuguegarao City': ['Bagumbayan', 'San Jacinto', 'Camalaniugan', 'Ugac Sur', 'Paming', 'Cataggaman', 'Minanga', 'Parang']
                },

                init() {
                    // Initialize with old values if they exist
                    this.selectedMunicipality = '<?php echo e(old('city') ?? ''); ?>';
                    this.selectedBarangay = '<?php echo e(old('barangay') ?? ''); ?>';
                    // Populate barangays if municipality is pre-selected
                    setTimeout(() => {
                        if (this.selectedMunicipality) {
                            this.updateBarangays();
                        }
                    }, 100);
                },

                updateBarangays() {
                    const barangaySelect = document.getElementById('barangay');
                    if (!barangaySelect) return;
                    
                    // Clear all options except the first one
                    barangaySelect.innerHTML = '<option value="">Select barangay</option>';
                    
                    // Get the barangays for the selected municipality
                    const barangays = this.barangaysByCity[this.selectedMunicipality];
                    
                    if (barangays && Array.isArray(barangays)) {
                        // Add each barangay as an option
                        barangays.forEach(barangay => {
                            const option = document.createElement('option');
                            option.value = barangay;
                            option.textContent = barangay;
                            barangaySelect.appendChild(option);
                        });
                    }
                    
                    // Restore the selected barangay if it exists
                    if (this.selectedBarangay && barangays && barangays.includes(this.selectedBarangay)) {
                        barangaySelect.value = this.selectedBarangay;
                    }
                }
            }
        }

        function togglePassword(fieldId) {
            const input = document.getElementById(fieldId);
            const btn = event.target.closest('.password-toggle-btn');
            const eyeIcon = btn.querySelector('.eye-icon');
            const eyeSlashIcon = btn.querySelector('.eye-slash-icon');
            
            if (input.getAttribute('type') === 'password') {
                // Show password
                input.setAttribute('type', 'text');
                eyeIcon.classList.remove('hidden');
                eyeSlashIcon.classList.add('hidden');
            } else {
                // Hide password
                input.setAttribute('type', 'password');
                eyeIcon.classList.add('hidden');
                eyeSlashIcon.classList.remove('hidden');
            }
        }
    </script>
</body>
</html>

<?php /**PATH C:\Users\jayso\Desktop\dev\web\Mannalon-App\resources\views/auth/register.blade.php ENDPATH**/ ?>