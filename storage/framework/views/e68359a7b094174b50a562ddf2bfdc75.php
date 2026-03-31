<main>
<div class="space-y-6">
    <style>
        .farmer-dashboard-grid {
            display: grid;
            grid-template-columns: repeat(12, minmax(0, 1fr));
            gap: 1rem;
        }

        .profile-card {
            grid-column: span 12;
            border: 1px solid #d1fae5;
            border-radius: 0.75rem;
            padding: 1.4rem;
            background: linear-gradient(180deg, #ffffff 0%, #f8fffb 100%);
            box-shadow: 0 2px 6px rgba(16, 185, 129, 0.08);
        }

        .profile-card h4 {
            color: #065f46;
            font-weight: 700;
            font-size: 1.5rem;
            line-height: 1.2;
        }

        .profile-card input,
        .profile-card select,
        .profile-card textarea {
            min-height: 3.4rem;
            padding: 0.85rem 1rem;
            font-size: 1.05rem;
            border-radius: 0.7rem;
        }

        .profile-card textarea {
            min-height: 5.8rem;
        }

        .profile-card .text-xs {
            font-size: 0.9rem;
        }

        .profile-card.wizard-active {
            grid-column: span 12 !important;
        }

        .boundary-toolbar {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 0.55rem;
            margin-bottom: 0.65rem;
        }

        .boundary-btn {
            border: 0;
            border-radius: 0.55rem;
            padding: 0.45rem 0.8rem;
            font-size: 0.85rem;
            font-weight: 600;
            color: #fff;
            cursor: pointer;
            line-height: 1.15;
        }

        .boundary-btn-undo {
            background: #f59e0b;
        }

        .boundary-btn-clear {
            background: #475569;
        }

        .boundary-count-badge {
            font-size: 0.85rem;
            color: #334155;
            background: #ecfdf5;
            border: 1px solid #a7f3d0;
            border-radius: 999px;
            padding: 0.3rem 0.65rem;
        }

        .boundary-layer-control {
            box-shadow: 0 2px 8px rgba(15, 23, 42, 0.15);
            border-radius: 0.5rem;
            overflow: hidden;
        }

        .boundary-layer-control .leaflet-control-layers-toggle {
            width: 34px;
            height: 34px;
            background-size: 18px 18px;
        }

        .boundary-layer-control.leaflet-control-layers-expanded {
            min-width: 270px;
            max-width: 320px;
            padding: 0.45rem 0.55rem;
        }

        .boundary-layer-control .leaflet-control-layers-list {
            margin: 0;
        }

        .boundary-layer-control .leaflet-control-layers-base label {
            display: grid;
            grid-template-columns: 18px 1fr;
            align-items: center;
            column-gap: 0.45rem;
            margin: 0.3rem 0;
            font-size: 0.9rem;
            line-height: 1.2;
            color: #1f2937;
        }

        .boundary-layer-control input[type='radio'] {
            margin: 0;
        }

        .card-order-1 { order: 1; }
        .card-order-2 { order: 2; }
        .card-order-3 { order: 3; }
        .card-order-4 { order: 4; }
        .card-order-5 { order: 5; }
        .card-order-6 { order: 6; }
        .card-order-7 { order: 7; }
        .card-order-8 { order: 8; }
        .card-order-9 { order: 9; }
        .card-order-10 { order: 10; }

        @media (min-width: 1024px) {
            .profile-card {
                grid-column: span 4;
            }

            .profile-card.card-wide {
                grid-column: span 12;
            }
        }
    </style>

    <?php if($errors->any()): ?>
        <div class="bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-lg">
            <p class="font-semibold mb-2">Please fix the following errors:</p>
            <ul class="list-disc pl-6 text-sm space-y-1">
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>

    <?php if(session('success')): ?>
        <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3 rounded-lg"><?php echo e(session('success')); ?></div>
    <?php endif; ?>

    <div class="bg-white rounded-lg shadow-md p-6">
        <h3 class="text-lg font-bold text-gray-900 mb-4">Add Comprehensive Farmer Information</h3>
        <form method="POST" action="<?php echo e(route('admin.farmers.store')); ?>" enctype="multipart/form-data" class="space-y-6" data-category-form="sections">
            <?php echo csrf_field(); ?>

            <div class="farmer-dashboard-grid">

            <section class="profile-card card-order-1">
                <h4 class="font-semibold text-gray-900 mb-3">1. Personal Information - Personal Details</h4>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <input type="text" name="first_name" placeholder="First name" value="<?php echo e(old('first_name')); ?>" class="px-4 py-2 border border-gray-300 rounded-lg" required>
                    <input type="text" name="middle_name" placeholder="Middle name" value="<?php echo e(old('middle_name')); ?>" class="px-4 py-2 border border-gray-300 rounded-lg">
                    <input type="text" name="last_name" placeholder="Last name" value="<?php echo e(old('last_name')); ?>" class="px-4 py-2 border border-gray-300 rounded-lg" required>
                    <select name="gender" class="px-4 py-2 border border-gray-300 rounded-lg">
                        <option value="">Gender</option>
                        <option value="male" <?php if(old('gender') === 'male'): echo 'selected'; endif; ?>>Male</option>
                        <option value="female" <?php if(old('gender') === 'female'): echo 'selected'; endif; ?>>Female</option>
                        <option value="other" <?php if(old('gender') === 'other'): echo 'selected'; endif; ?>>Other</option>
                    </select>
                    <input type="date" name="date_of_birth" value="<?php echo e(old('date_of_birth')); ?>" class="px-4 py-2 border border-gray-300 rounded-lg">
                    <input type="number" name="age" min="1" max="120" placeholder="Age" value="<?php echo e(old('age')); ?>" class="px-4 py-2 border border-gray-300 rounded-lg">
                    <select name="civil_status" class="px-4 py-2 border border-gray-300 rounded-lg">
                        <option value="">Civil status</option>
                        <option value="single" <?php if(old('civil_status') === 'single'): echo 'selected'; endif; ?>>Single</option>
                        <option value="married" <?php if(old('civil_status') === 'married'): echo 'selected'; endif; ?>>Married</option>
                        <option value="divorced" <?php if(old('civil_status') === 'divorced'): echo 'selected'; endif; ?>>Divorced</option>
                        <option value="widowed" <?php if(old('civil_status') === 'widowed'): echo 'selected'; endif; ?>>Widowed</option>
                        <option value="separated" <?php if(old('civil_status') === 'separated'): echo 'selected'; endif; ?>>Separated</option>
                    </select>
                    <input type="text" name="phone" placeholder="Contact number" value="<?php echo e(old('phone')); ?>" class="px-4 py-2 border border-gray-300 rounded-lg">
                    <input type="email" name="email" placeholder="Email (optional)" value="<?php echo e(old('email')); ?>" class="px-4 py-2 border border-gray-300 rounded-lg">
                    <input type="text" name="government_id_type" placeholder="Government ID type" value="<?php echo e(old('government_id_type')); ?>" class="px-4 py-2 border border-gray-300 rounded-lg">
                    <input type="text" name="government_id_number" placeholder="Government ID number" value="<?php echo e(old('government_id_number')); ?>" class="px-4 py-2 border border-gray-300 rounded-lg md:col-span-2">
                </div>
            </section>

            <section class="profile-card card-order-2">
                <h4 class="font-semibold text-gray-900 mb-3">2. Address Information - Primary Location</h4>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <input type="text" name="region" placeholder="Region" value="<?php echo e(old('region')); ?>" class="px-4 py-2 border border-gray-300 rounded-lg">
                    <input type="text" name="province" placeholder="Province" value="<?php echo e(old('province')); ?>" class="px-4 py-2 border border-gray-300 rounded-lg">
                    <input type="text" name="municipality_city" placeholder="Municipality/City" value="<?php echo e(old('municipality_city')); ?>" class="px-4 py-2 border border-gray-300 rounded-lg">
                    <input type="text" name="barangay" placeholder="Barangay" value="<?php echo e(old('barangay')); ?>" class="px-4 py-2 border border-gray-300 rounded-lg">
                    <input type="text" name="sitio_purok" placeholder="Sitio/Purok" value="<?php echo e(old('sitio_purok')); ?>" class="px-4 py-2 border border-gray-300 rounded-lg">
                    <div class="px-4 py-2 bg-emerald-50 border border-emerald-200 rounded-lg text-xs text-emerald-800">
                        GPS coordinates are managed in Farm Information map card.
                    </div>
                </div>
            </section>

            <section class="profile-card card-order-4">
                <h4 class="font-semibold text-gray-900 mb-3">4. Farming Profile - Experience and Roles</h4>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <select name="farmer_type" class="px-4 py-2 border border-gray-300 rounded-lg">
                        <option value="">Type of farmer</option>
                        <option value="owner" <?php if(old('farmer_type') === 'owner'): echo 'selected'; endif; ?>>Owner</option>
                        <option value="tenant" <?php if(old('farmer_type') === 'tenant'): echo 'selected'; endif; ?>>Tenant</option>
                        <option value="farm_worker" <?php if(old('farmer_type') === 'farm_worker'): echo 'selected'; endif; ?>>Farm Worker</option>
                    </select>
                    <input type="number" name="years_in_farming" min="0" max="80" placeholder="Years in farming" value="<?php echo e(old('years_in_farming')); ?>" class="px-4 py-2 border border-gray-300 rounded-lg">
                    <input type="text" name="primary_occupation" placeholder="Primary occupation" value="<?php echo e(old('primary_occupation')); ?>" class="px-4 py-2 border border-gray-300 rounded-lg">
                    <input type="text" name="secondary_occupation" placeholder="Secondary occupation" value="<?php echo e(old('secondary_occupation')); ?>" class="px-4 py-2 border border-gray-300 rounded-lg">
                    <label class="flex items-center gap-2 px-4 py-2 border border-gray-300 rounded-lg">
                        <input type="checkbox" name="is_association_member" value="1" <?php if(old('is_association_member')): echo 'checked'; endif; ?>>
                        <span>Association member</span>
                    </label>
                    <input type="text" name="association_name" placeholder="Association/Cooperative name" value="<?php echo e(old('association_name')); ?>" class="px-4 py-2 border border-gray-300 rounded-lg">
                </div>
            </section>

            <section class="profile-card card-order-5">
                <h4 class="font-semibold text-gray-900 mb-3">5. Farm Information - Land Assets</h4>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <input type="text" name="farm_location" placeholder="Farm location" value="<?php echo e(old('farm_location')); ?>" class="px-4 py-2 border border-gray-300 rounded-lg">
                    <input type="number" step="0.01" min="0" name="farm_size_hectares" placeholder="Farm size (hectares)" value="<?php echo e(old('farm_size_hectares')); ?>" class="px-4 py-2 border border-gray-300 rounded-lg">
                    <select name="land_ownership_type" class="px-4 py-2 border border-gray-300 rounded-lg">
                        <option value="">Land ownership</option>
                        <option value="owned" <?php if(old('land_ownership_type') === 'owned'): echo 'selected'; endif; ?>>Owned</option>
                        <option value="leased" <?php if(old('land_ownership_type') === 'leased'): echo 'selected'; endif; ?>>Leased</option>
                        <option value="shared" <?php if(old('land_ownership_type') === 'shared'): echo 'selected'; endif; ?>>Shared</option>
                    </select>
                    <input type="number" min="0" name="number_of_parcels" placeholder="Number of parcels" value="<?php echo e(old('number_of_parcels')); ?>" class="px-4 py-2 border border-gray-300 rounded-lg">
                    <input type="number" step="0.00000001" name="gps_latitude" placeholder="Farm GPS latitude" value="<?php echo e(old('gps_latitude')); ?>" class="px-4 py-2 border border-gray-300 rounded-lg">
                    <input type="number" step="0.00000001" name="gps_longitude" placeholder="Farm GPS longitude" value="<?php echo e(old('gps_longitude')); ?>" class="px-4 py-2 border border-gray-300 rounded-lg">
                </div>
                <div class="mt-4">
                    <p class="text-sm font-semibold text-gray-800 mb-2">Farm Land Boundary Points (Click map to add corner points)</p>
                    <input type="hidden" id="land_boundary_points" name="land_boundary_points" value="<?php echo e(old('land_boundary_points')); ?>">
                    <div class="boundary-toolbar">
                        <button type="button" id="boundary-undo" class="boundary-btn boundary-btn-undo">Undo Last Point</button>
                        <button type="button" id="boundary-clear" class="boundary-btn boundary-btn-clear">Clear Points</button>
                        <span id="boundary-count" class="boundary-count-badge">0 points</span>
                    </div>
                    <div id="farmer-boundary-map" class="w-full border border-gray-300 rounded-lg" style="height: 460px;"></div>
                </div>
            </section>

            <section class="profile-card card-order-7">
                <h4 class="font-semibold text-gray-900 mb-3">7. Crop and Livestock Information - Current Production</h4>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <textarea name="crop_types" rows="2" placeholder="Type of crops (e.g. Rice, Corn)" class="px-4 py-2 border border-gray-300 rounded-lg"><?php echo e(old('crop_types')); ?></textarea>
                    <textarea name="crop_area_per_type" rows="2" placeholder="Area per crop" class="px-4 py-2 border border-gray-300 rounded-lg"><?php echo e(old('crop_area_per_type')); ?></textarea>
                    <select name="cropping_season" class="px-4 py-2 border border-gray-300 rounded-lg">
                        <option value="">Cropping season</option>
                        <option value="wet" <?php if(old('cropping_season') === 'wet'): echo 'selected'; endif; ?>>Wet</option>
                        <option value="dry" <?php if(old('cropping_season') === 'dry'): echo 'selected'; endif; ?>>Dry</option>
                        <option value="wet_dry" <?php if(old('cropping_season') === 'wet_dry'): echo 'selected'; endif; ?>>Wet/Dry</option>
                    </select>
                    <input type="text" name="yield_per_harvest" placeholder="Yield per harvest" value="<?php echo e(old('yield_per_harvest')); ?>" class="px-4 py-2 border border-gray-300 rounded-lg">
                    <textarea name="livestock_types" rows="2" placeholder="Livestock/Poultry types" class="px-4 py-2 border border-gray-300 rounded-lg"><?php echo e(old('livestock_types')); ?></textarea>
                    <input type="number" min="0" name="livestock_count" placeholder="Number of animals" value="<?php echo e(old('livestock_count')); ?>" class="px-4 py-2 border border-gray-300 rounded-lg">
                </div>
            </section>

            <section class="profile-card card-order-6">
                <h4 class="font-semibold text-gray-900 mb-3">6. Farming Resources and Equipment - Tools and Irrigation</h4>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <textarea name="farm_equipment" rows="2" placeholder="Farm equipment" class="px-4 py-2 border border-gray-300 rounded-lg"><?php echo e(old('farm_equipment')); ?></textarea>
                    <select name="irrigation_type" class="px-4 py-2 border border-gray-300 rounded-lg">
                        <option value="">Irrigation type</option>
                        <option value="rainfed" <?php if(old('irrigation_type') === 'rainfed'): echo 'selected'; endif; ?>>Rainfed</option>
                        <option value="irrigated" <?php if(old('irrigation_type') === 'irrigated'): echo 'selected'; endif; ?>>Irrigated</option>
                        <option value="mixed" <?php if(old('irrigation_type') === 'mixed'): echo 'selected'; endif; ?>>Mixed</option>
                    </select>
                    <input type="text" name="water_source" placeholder="Source of water" value="<?php echo e(old('water_source')); ?>" class="px-4 py-2 border border-gray-300 rounded-lg">
                    <select name="fertilizer_usage" class="px-4 py-2 border border-gray-300 rounded-lg">
                        <option value="">Fertilizer usage</option>
                        <option value="organic" <?php if(old('fertilizer_usage') === 'organic'): echo 'selected'; endif; ?>>Organic</option>
                        <option value="inorganic" <?php if(old('fertilizer_usage') === 'inorganic'): echo 'selected'; endif; ?>>Inorganic</option>
                        <option value="mixed" <?php if(old('fertilizer_usage') === 'mixed'): echo 'selected'; endif; ?>>Mixed</option>
                    </select>
                    <textarea name="pesticide_usage" rows="2" placeholder="Pesticide usage" class="px-4 py-2 border border-gray-300 rounded-lg md:col-span-2"><?php echo e(old('pesticide_usage')); ?></textarea>
                </div>
            </section>

            <section class="profile-card card-order-8">
                <h4 class="font-semibold text-gray-900 mb-3">8. Financial Information - Economic Status</h4>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <input type="number" step="0.01" min="0" name="average_monthly_income" placeholder="Average monthly income" value="<?php echo e(old('average_monthly_income')); ?>" class="px-4 py-2 border border-gray-300 rounded-lg">
                    <input type="number" step="0.01" min="0" name="average_annual_income" placeholder="Average annual income" value="<?php echo e(old('average_annual_income')); ?>" class="px-4 py-2 border border-gray-300 rounded-lg">
                    <select name="income_source" class="px-4 py-2 border border-gray-300 rounded-lg">
                        <option value="">Income source</option>
                        <option value="farm" <?php if(old('income_source') === 'farm'): echo 'selected'; endif; ?>>Farm</option>
                        <option value="non_farm" <?php if(old('income_source') === 'non_farm'): echo 'selected'; endif; ?>>Non-Farm</option>
                        <option value="both" <?php if(old('income_source') === 'both'): echo 'selected'; endif; ?>>Both</option>
                    </select>
                    <label class="flex items-center gap-2 px-4 py-2 border border-gray-300 rounded-lg">
                        <input type="checkbox" name="has_credit_access" value="1" <?php if(old('has_credit_access')): echo 'checked'; endif; ?>>
                        <span>Access to credit/loans</span>
                    </label>
                    <input type="text" name="insurance_coverage" placeholder="Insurance coverage (e.g. PCIC)" value="<?php echo e(old('insurance_coverage')); ?>" class="px-4 py-2 border border-gray-300 rounded-lg md:col-span-2">
                </div>
            </section>

            <section class="profile-card card-order-9">
                <h4 class="font-semibold text-gray-900 mb-3">9. Government Program Participation - Support History</h4>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <label class="flex items-center gap-2 px-4 py-2 border border-gray-300 rounded-lg">
                        <input type="checkbox" name="is_rsbsa_registered" value="1" <?php if(old('is_rsbsa_registered')): echo 'checked'; endif; ?>>
                        <span>Registered in RSBSA</span>
                    </label>
                    <input type="date" name="program_registration_date" value="<?php echo e(old('program_registration_date')); ?>" class="px-4 py-2 border border-gray-300 rounded-lg">
                    <textarea name="programs_availed" rows="2" placeholder="Programs availed (seeds, fertilizer, training, equipment, etc.)" class="px-4 py-2 border border-gray-300 rounded-lg md:col-span-2"><?php echo e(old('programs_availed')); ?></textarea>
                </div>
            </section>

            <section class="profile-card card-order-10 card-wide">
                <h4 class="font-semibold text-gray-900 mb-3">10. Documents and Attachments - Verified Documents</h4>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-gray-700">
                    <div>
                        <label class="block mb-1">Valid ID</label>
                        <input type="file" name="valid_id" accept=".jpg,.jpeg,.png,.pdf" class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                    </div>
                    <div>
                        <label class="block mb-1">Land Title / Lease Agreement</label>
                        <input type="file" name="land_document" accept=".jpg,.jpeg,.png,.pdf" class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                    </div>
                    <div>
                        <label class="block mb-1">Farm Photo</label>
                        <input type="file" name="farm_photo" accept=".jpg,.jpeg,.png,.pdf" class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                    </div>
                    <div>
                        <label class="block mb-1">Barangay Certification</label>
                        <input type="file" name="barangay_certification" accept=".jpg,.jpeg,.png,.pdf" class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                    </div>
                </div>
            </section>

            <section class="profile-card card-order-3">
                <h4 class="font-semibold text-gray-900 mb-3">3. System Information - Account Status</h4>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="px-4 py-2 bg-gray-50 border border-gray-200 rounded-lg text-sm text-gray-600">
                        Farmer ID and Date Registered are auto-generated by the system.
                    </div>
                    <input type="text" name="verified_by" placeholder="Verified by (Admin name)" value="<?php echo e(old('verified_by')); ?>" class="px-4 py-2 border border-gray-300 rounded-lg">
                    <select name="profile_status" class="px-4 py-2 border border-gray-300 rounded-lg">
                        <option value="pending" <?php if(old('profile_status') === 'pending'): echo 'selected'; endif; ?>>Pending</option>
                        <option value="active" <?php if(old('profile_status') === 'active'): echo 'selected'; endif; ?>>Active</option>
                        <option value="inactive" <?php if(old('profile_status') === 'inactive'): echo 'selected'; endif; ?>>Inactive</option>
                        <option value="verified" <?php if(old('profile_status') === 'verified'): echo 'selected'; endif; ?>>Verified</option>
                    </select>
                </div>
            </section>

            </div>

            <button type="submit" class="px-4 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 font-semibold">Save Farmer</button>
        </form>
    </div>

    <div class="bg-white rounded-lg shadow-md p-6">
        <form method="GET" action="<?php echo e(route('admin.farmers.index')); ?>" class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
            <input type="text" name="search" value="<?php echo e($search ?? ''); ?>" placeholder="Search name, contact, location" class="px-4 py-2 border border-gray-300 rounded-lg md:col-span-3">
            <button class="px-4 py-2 bg-emerald-100 text-emerald-700 rounded-lg hover:bg-emerald-200 font-semibold">Search</button>
        </form>

        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 border-b-2 border-gray-200">
                    <tr>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Name</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Contact</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Farm Location</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Land Size</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Status</th>
                        <th class="px-4 py-3 text-center text-sm font-semibold text-gray-700">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <?php $__empty_1 = true; $__currentLoopData = $farmers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $farmer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3 font-semibold text-gray-900"><?php echo e($farmer->name); ?></td>
                            <td class="px-4 py-3 text-gray-600"><?php echo e($farmer->phone ?? 'N/A'); ?></td>
                            <td class="px-4 py-3 text-gray-600"><?php echo e($farmer->farm_location ?? 'N/A'); ?></td>
                            <td class="px-4 py-3 text-gray-600"><?php echo e($farmer->farm_size_hectares !== null ? number_format((float) $farmer->farm_size_hectares, 2) . ' ha' : 'N/A'); ?></td>
                            <td class="px-4 py-3 text-gray-600"><?php echo e(ucfirst($farmer->profile_status ?? 'active')); ?></td>
                            <td class="px-4 py-3">
                                <div class="flex items-center justify-center gap-2">
                                    <a href="<?php echo e(route('admin.farmers.show', $farmer->id)); ?>" class="px-3 py-1 text-xs bg-blue-600 text-white rounded">View</a>
                                    <form method="POST" action="<?php echo e(route('admin.farmers.destroy', $farmer)); ?>" onsubmit="return confirm('Delete this farmer information?')">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button class="px-3 py-1 text-xs bg-red-600 text-white rounded">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="6" class="px-4 py-8 text-center text-gray-500">No farmer information yet.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <div class="mt-4"><?php echo e($farmers->links()); ?></div>
    </div>

<script>
(() => {
    const form = document.querySelector('form[data-category-form="sections"]');
    if (!form) {
        return;
    }

    function resetCategory(container) {
        const controls = container.querySelectorAll('input, select, textarea');
        controls.forEach((control) => {
            if (!control.name) {
                return;
            }

            const type = (control.type || '').toLowerCase();
            if (type === 'hidden' || type === 'button' || type === 'submit' || type === 'reset') {
                return;
            }

            if (type === 'checkbox' || type === 'radio') {
                control.checked = false;
            } else if (control.tagName === 'SELECT') {
                control.selectedIndex = 0;
            } else {
                control.value = '';
            }

            control.dispatchEvent(new Event('input', { bubbles: true }));
            control.dispatchEvent(new Event('change', { bubbles: true }));
        });

        const boundaryHidden = container.querySelector('#land_boundary_points');
        const boundaryClearBtn = container.querySelector('#boundary-clear');
        if (boundaryHidden) {
            boundaryHidden.value = '[]';
        }
        if (boundaryClearBtn) {
            boundaryClearBtn.click();
        }
    }

    const sections = form.querySelectorAll('section');
    sections.forEach((section) => {
        const heading = section.querySelector('h4');
        if (!heading) {
            return;
        }

        const headerRow = document.createElement('div');
        headerRow.className = 'flex items-center justify-between gap-3 mb-3';
        heading.classList.remove('mb-3');
        section.insertBefore(headerRow, heading);
        headerRow.appendChild(heading);

        const answerAgainBtn = document.createElement('button');
        answerAgainBtn.type = 'button';
        answerAgainBtn.className = 'px-3 py-1 text-xs bg-sky-600 text-white rounded hover:bg-sky-700';
        answerAgainBtn.textContent = 'Answer Again';
        answerAgainBtn.addEventListener('click', () => resetCategory(section));
        headerRow.appendChild(answerAgainBtn);
    });
})();
</script>

<script>
(() => {
    const form = document.querySelector('form[data-category-form="sections"]');
    if (!form) {
        return;
    }

    const cards = Array.from(form.querySelectorAll('.profile-card'));
    if (cards.length === 0) {
        return;
    }

    const submitBtn = form.querySelector('button[type="submit"]');
    if (!submitBtn) {
        return;
    }

    let currentStep = 0;

    const progressWrap = document.createElement('div');
    progressWrap.className = 'mb-4';
    progressWrap.innerHTML = `
        <div class="flex items-center justify-between text-xs font-semibold text-emerald-800 mb-2">
            <span id="wizard-step-label">Step 1 of ${cards.length}</span>
            <span id="wizard-step-title"></span>
        </div>
        <div class="w-full h-2 bg-emerald-100 rounded-full overflow-hidden">
            <div id="wizard-progress-bar" class="h-full bg-emerald-600 transition-all duration-300"></div>
        </div>
    `;
    form.insertBefore(progressWrap, form.firstElementChild && form.firstElementChild.nextElementSibling ? form.firstElementChild.nextElementSibling : form.firstElementChild);

    const navWrap = document.createElement('div');
    navWrap.className = 'flex items-center justify-between mt-2';

    const validationMsg = document.createElement('p');
    validationMsg.className = 'mt-2 text-sm text-red-600 hidden';
    validationMsg.textContent = 'Please complete the required fields in this step before saving.';

    const backBtn = document.createElement('button');
    backBtn.type = 'button';
    backBtn.className = 'px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 font-semibold disabled:opacity-50 disabled:cursor-not-allowed';
    backBtn.textContent = 'Back';

    const nextBtn = document.createElement('button');
    nextBtn.type = 'button';
    nextBtn.className = 'px-4 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 font-semibold';
    nextBtn.textContent = 'Next';

    navWrap.appendChild(backBtn);
    navWrap.appendChild(nextBtn);

    submitBtn.parentNode.insertBefore(navWrap, submitBtn);
    submitBtn.parentNode.insertBefore(validationMsg, submitBtn.nextSibling);

    const progressBar = progressWrap.querySelector('#wizard-progress-bar');
    const stepLabel = progressWrap.querySelector('#wizard-step-label');
    const stepTitle = progressWrap.querySelector('#wizard-step-title');

    function updateStepView() {
        cards.forEach((card, index) => {
            card.style.display = index === currentStep ? '' : 'none';
            card.classList.toggle('wizard-active', index === currentStep);
        });

        const currentHeading = cards[currentStep].querySelector('h4');
        const titleText = currentHeading ? currentHeading.textContent.trim() : `Category ${currentStep + 1}`;

        const percent = ((currentStep + 1) / cards.length) * 100;
        progressBar.style.width = `${percent}%`;
        stepLabel.textContent = `Step ${currentStep + 1} of ${cards.length}`;
        stepTitle.textContent = titleText;

        backBtn.disabled = currentStep === 0;

        if (currentStep === cards.length - 1) {
            nextBtn.style.display = 'none';
            submitBtn.style.display = '';
        } else {
            nextBtn.style.display = '';
            submitBtn.style.display = 'none';
        }

        validationMsg.classList.add('hidden');

        const mapEl = document.getElementById('farmer-boundary-map');
        if (mapEl && cards[currentStep].contains(mapEl)) {
            window.dispatchEvent(new Event('resize'));
        }
    }

    backBtn.addEventListener('click', () => {
        if (currentStep > 0) {
            currentStep -= 1;
            updateStepView();
        }
    });

    nextBtn.addEventListener('click', () => {
        if (currentStep < cards.length - 1) {
            currentStep += 1;
            updateStepView();
        }
    });

    form.addEventListener('submit', (event) => {
        const invalidField = form.querySelector(':invalid');
        if (!invalidField) {
            return;
        }

        event.preventDefault();

        const invalidCardIndex = cards.findIndex((card) => card.contains(invalidField));
        if (invalidCardIndex >= 0) {
            currentStep = invalidCardIndex;
            updateStepView();
        }

        validationMsg.classList.remove('hidden');
        invalidField.focus();
    });

    updateStepView();
})();
</script>

<script>
(() => {
    function loadScriptOnce(id, src) {
        return new Promise((resolve, reject) => {
            const existing = document.getElementById(id);
            if (existing) {
                if (existing.dataset.loaded === '1') {
                    resolve();
                    return;
                }
                existing.addEventListener('load', () => resolve(), { once: true });
                existing.addEventListener('error', () => reject(new Error('Failed to load script: ' + src)), { once: true });
                return;
            }

            const script = document.createElement('script');
            script.id = id;
            script.src = src;
            script.async = true;
            script.onload = () => {
                script.dataset.loaded = '1';
                resolve();
            };
            script.onerror = () => reject(new Error('Failed to load script: ' + src));
            document.head.appendChild(script);
        });
    }

    function loadStyleOnce(id, href) {
        if (document.getElementById(id)) {
            return;
        }
        const link = document.createElement('link');
        link.id = id;
        link.rel = 'stylesheet';
        link.href = href;
        document.head.appendChild(link);
    }

    function parsePoints(raw) {
        if (!raw) {
            return [];
        }
        try {
            const parsed = JSON.parse(raw);
            if (!Array.isArray(parsed)) {
                return [];
            }
            return parsed
                .filter(p => p && typeof p.lat !== 'undefined' && typeof p.lng !== 'undefined')
                .map(p => ({ lat: Number(p.lat), lng: Number(p.lng) }))
                .filter(p => !Number.isNaN(p.lat) && !Number.isNaN(p.lng));
        } catch (e) {
            return [];
        }
    }

    const mapEl = document.getElementById('farmer-boundary-map');
    const pointsInput = document.getElementById('land_boundary_points');
    const latInput = document.querySelector('input[name="gps_latitude"]');
    const lngInput = document.querySelector('input[name="gps_longitude"]');
    const countEl = document.getElementById('boundary-count');
    const undoBtn = document.getElementById('boundary-undo');
    const clearBtn = document.getElementById('boundary-clear');
    const googleMapsApiKey = <?php echo json_encode(config('services.google_maps.key'), 15, 512) ?>;

    if (!mapEl || !pointsInput || !latInput || !lngInput || !countEl || !undoBtn || !clearBtn) {
        return;
    }

    function initLeafletBoundaryMap(statusMessage) {
        if (statusMessage) {
            countEl.textContent = statusMessage;
        }

        loadStyleOnce('leaflet-css', 'https://unpkg.com/leaflet@1.9.4/dist/leaflet.css');
        loadScriptOnce('leaflet-js', 'https://unpkg.com/leaflet@1.9.4/dist/leaflet.js')
            .then(() => {
                if (!window.L) {
                    throw new Error('Leaflet failed to initialize.');
                }

                const defaultLat = parseFloat(latInput.value) || 17.6135;
                const defaultLng = parseFloat(lngInput.value) || 121.7269;
                const map = L.map(mapEl).setView([defaultLat, defaultLng], 13);

                const terrainTopographic = L.tileLayer('https://{s}.tile.opentopomap.org/{z}/{x}/{y}.png', {
                    maxZoom: 17,
                    attribution: 'Map data: &copy; OpenStreetMap contributors, SRTM | Map style: &copy; OpenTopoMap'
                });
                const standardStreet = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    maxZoom: 19,
                    attribution: '&copy; OpenStreetMap contributors'
                });
                const satelliteAerial = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
                    maxZoom: 19,
                    maxNativeZoom: 15,
                    attribution: 'Tiles &copy; Esri'
                });
                const specializedAesthetic = L.tileLayer('https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}{r}.png', {
                    maxZoom: 20,
                    attribution: '&copy; OpenStreetMap contributors &copy; CARTO'
                });

                standardStreet.addTo(map);

                const baseLayers = {
                    'Terrain / Topographic': terrainTopographic,
                    'Standard / Street': standardStreet,
                    'Satellite / Aerial': satelliteAerial,
                    'Specialized / Aesthetic': specializedAesthetic,
                };
                const layerControl = L.control.layers(baseLayers, null, { collapsed: true }).addTo(map);
                const layerControlEl = layerControl.getContainer();
                if (layerControlEl) {
                    layerControlEl.classList.add('boundary-layer-control');
                }

                let points = parsePoints(pointsInput.value);
                let markers = [];
                let polygon = null;
                let latEdited = false;
                let lngEdited = false;
                let autoAddTimer = null;

                function zoomToBoundary() {
                    if (points.length === 0) {
                        return;
                    }

                    if (points.length === 1) {
                        map.setView([points[0].lat, points[0].lng], 16);
                        return;
                    }

                    const bounds = L.latLngBounds(points.map((point) => [point.lat, point.lng]));
                    if (bounds.isValid()) {
                        map.fitBounds(bounds.pad(0.2), { maxZoom: 18 });
                    }
                }

                function redraw() {
                    markers.forEach(marker => map.removeLayer(marker));
                    markers = points.map((point, index) => {
                        const marker = L.marker([point.lat, point.lng]).addTo(map);
                        marker.bindTooltip(String(index + 1), { permanent: true, direction: 'top', offset: [0, -10] });
                        return marker;
                    });

                    if (polygon) {
                        map.removeLayer(polygon);
                        polygon = null;
                    }

                    if (points.length >= 3) {
                        polygon = L.polygon(points.map(p => [p.lat, p.lng]), { color: '#059669', weight: 2, fillOpacity: 0.15 }).addTo(map);
                    } else if (points.length >= 2) {
                        polygon = L.polyline(points.map(p => [p.lat, p.lng]), { color: '#059669', weight: 2 }).addTo(map);
                    }

                    pointsInput.value = JSON.stringify(points);
                    countEl.textContent = points.length + ' point' + (points.length === 1 ? '' : 's');

                    const hasLatValue = Number.isFinite(Number(latInput.value));
                    const hasLngValue = Number.isFinite(Number(lngInput.value));
                    if (points.length > 0 && (!hasLatValue || !hasLngValue)) {
                        latInput.value = points[0].lat.toFixed(8);
                        lngInput.value = points[0].lng.toFixed(8);
                    }

                    zoomToBoundary();
                }

                function getInputPoint() {
                    const lat = Number(latInput.value);
                    const lng = Number(lngInput.value);

                    if (!Number.isFinite(lat) || !Number.isFinite(lng)) {
                        return null;
                    }

                    if (lat < -90 || lat > 90 || lng < -180 || lng > 180) {
                        return null;
                    }

                    return { lat, lng };
                }

                function tryAddPointFromInputs() {
                    if (!latEdited || !lngEdited) {
                        return;
                    }

                    const point = getInputPoint();
                    if (!point) {
                        return;
                    }

                    const lastPoint = points.length > 0 ? points[points.length - 1] : null;
                    if (lastPoint && Math.abs(lastPoint.lat - point.lat) < 0.0000001 && Math.abs(lastPoint.lng - point.lng) < 0.0000001) {
                        latEdited = false;
                        lngEdited = false;
                        return;
                    }

                    points.push(point);
                    latEdited = false;
                    lngEdited = false;
                    redraw();
                }

                function scheduleAutoAddFromInputs() {
                    if (autoAddTimer) {
                        clearTimeout(autoAddTimer);
                    }
                    autoAddTimer = setTimeout(() => {
                        tryAddPointFromInputs();
                    }, 300);
                }

                function refreshMapSize() {
                    requestAnimationFrame(() => map.invalidateSize());
                    setTimeout(() => map.invalidateSize(), 80);
                }

                redraw();

                latInput.addEventListener('input', () => {
                    latEdited = true;
                    scheduleAutoAddFromInputs();
                });

                lngInput.addEventListener('input', () => {
                    lngEdited = true;
                    scheduleAutoAddFromInputs();
                });

                latInput.addEventListener('change', tryAddPointFromInputs);
                lngInput.addEventListener('change', tryAddPointFromInputs);
                latInput.addEventListener('keydown', (e) => {
                    if (e.key === 'Enter') {
                        e.preventDefault();
                        tryAddPointFromInputs();
                    }
                });
                lngInput.addEventListener('keydown', (e) => {
                    if (e.key === 'Enter') {
                        e.preventDefault();
                        tryAddPointFromInputs();
                    }
                });

                map.on('click', (e) => {
                    points.push({ lat: e.latlng.lat, lng: e.latlng.lng });
                    redraw();
                });

                undoBtn.addEventListener('click', () => {
                    if (points.length === 0) {
                        return;
                    }
                    points.pop();
                    redraw();
                });

                clearBtn.addEventListener('click', () => {
                    points = [];
                    redraw();
                });

                map.whenReady(refreshMapSize);
                window.addEventListener('resize', refreshMapSize);
                setTimeout(refreshMapSize, 150);
            })
            .catch((leafletError) => {
                countEl.textContent = 'Map failed to load';
                console.error(leafletError);
            });
    }

    if (!googleMapsApiKey) {
        initLeafletBoundaryMap('Using OpenStreetMap (Google Maps API key missing)');
        return;
    }

    loadScriptOnce('google-maps-js', 'https://maps.googleapis.com/maps/api/js?key=' + encodeURIComponent(googleMapsApiKey) + '&v=weekly')
        .then(() => {
            if (!window.google || !window.google.maps) {
                throw new Error('Google Maps failed to initialize.');
            }

            const defaultLat = parseFloat(latInput.value) || 17.6135;
            const defaultLng = parseFloat(lngInput.value) || 121.7269;

            const map = new google.maps.Map(mapEl, {
                center: { lat: defaultLat, lng: defaultLng },
                zoom: 13,
                mapTypeId: 'roadmap',
                mapTypeControl: false,
                streetViewControl: false,
                fullscreenControl: true,
                gestureHandling: 'greedy',
            });

            const layerSelectContainer = document.createElement('div');
            layerSelectContainer.style.background = '#ffffff';
            layerSelectContainer.style.border = '1px solid #d1d5db';
            layerSelectContainer.style.borderRadius = '6px';
            layerSelectContainer.style.padding = '6px 8px';
            layerSelectContainer.style.margin = '10px';
            layerSelectContainer.style.boxShadow = '0 1px 4px rgba(0,0,0,0.2)';

            const layerSelect = document.createElement('select');
            layerSelect.style.fontSize = '12px';
            layerSelect.style.border = '1px solid #d1d5db';
            layerSelect.style.borderRadius = '4px';
            layerSelect.style.padding = '4px 6px';
            [
                { label: 'Terrain / Topographic', value: 'terrain' },
                { label: 'Standard / Street', value: 'roadmap' },
                { label: 'Satellite / Aerial', value: 'satellite' },
                { label: 'Specialized / Aesthetic', value: 'hybrid' },
            ].forEach((item) => {
                const option = document.createElement('option');
                option.value = item.value;
                option.textContent = item.label;
                layerSelect.appendChild(option);
            });
            layerSelect.value = 'roadmap';
            layerSelect.addEventListener('change', () => {
                map.setMapTypeId(layerSelect.value);
            });
            layerSelectContainer.appendChild(layerSelect);
            map.controls[google.maps.ControlPosition.TOP_RIGHT].push(layerSelectContainer);

            let points = parsePoints(pointsInput.value);
            let markers = [];
            let polygon = null;
            let latEdited = false;
            let lngEdited = false;
            let autoAddTimer = null;

            function zoomToBoundary() {
                if (points.length === 0) {
                    return;
                }

                if (points.length === 1) {
                    map.setCenter(points[0]);
                    map.setZoom(16);
                    return;
                }

                const bounds = new google.maps.LatLngBounds();
                points.forEach((point) => bounds.extend(point));
                map.fitBounds(bounds, 60);
                google.maps.event.addListenerOnce(map, 'idle', () => {
                    if (map.getZoom() > 19) {
                        map.setZoom(19);
                    }
                });
            }

            function redraw() {
                markers.forEach(marker => marker.setMap(null));
                markers = points.map((point, index) => {
                    return new google.maps.Marker({
                        position: point,
                        map,
                        label: String(index + 1),
                    });
                });

                if (polygon) {
                    polygon.setMap(null);
                    polygon = null;
                }

                if (points.length >= 3) {
                    polygon = new google.maps.Polygon({
                        paths: points,
                        strokeColor: '#059669',
                        strokeOpacity: 1,
                        strokeWeight: 2,
                        fillColor: '#059669',
                        fillOpacity: 0.15,
                        map,
                    });
                } else if (points.length >= 2) {
                    polygon = new google.maps.Polyline({
                        path: points,
                        strokeColor: '#059669',
                        strokeOpacity: 1,
                        strokeWeight: 2,
                        map,
                    });
                }

                pointsInput.value = JSON.stringify(points);
                countEl.textContent = points.length + ' point' + (points.length === 1 ? '' : 's');

                const hasLatValue = Number.isFinite(Number(latInput.value));
                const hasLngValue = Number.isFinite(Number(lngInput.value));
                if (points.length > 0 && (!hasLatValue || !hasLngValue)) {
                    latInput.value = points[0].lat.toFixed(8);
                    lngInput.value = points[0].lng.toFixed(8);
                }

                zoomToBoundary();
            }

            function getInputPoint() {
                const lat = Number(latInput.value);
                const lng = Number(lngInput.value);

                if (!Number.isFinite(lat) || !Number.isFinite(lng)) {
                    return null;
                }

                if (lat < -90 || lat > 90 || lng < -180 || lng > 180) {
                    return null;
                }

                return { lat, lng };
            }

            function tryAddPointFromInputs() {
                if (!latEdited || !lngEdited) {
                    return;
                }

                const point = getInputPoint();
                if (!point) {
                    return;
                }

                const lastPoint = points.length > 0 ? points[points.length - 1] : null;
                if (lastPoint && Math.abs(lastPoint.lat - point.lat) < 0.0000001 && Math.abs(lastPoint.lng - point.lng) < 0.0000001) {
                    latEdited = false;
                    lngEdited = false;
                    return;
                }

                points.push(point);
                latEdited = false;
                lngEdited = false;
                redraw();
            }

            function scheduleAutoAddFromInputs() {
                if (autoAddTimer) {
                    clearTimeout(autoAddTimer);
                }
                autoAddTimer = setTimeout(() => {
                    tryAddPointFromInputs();
                }, 300);
            }

            function refreshMapSize() {
                requestAnimationFrame(() => google.maps.event.trigger(map, 'resize'));
                setTimeout(() => {
                    google.maps.event.trigger(map, 'resize');
                    zoomToBoundary();
                }, 80);
            }

            redraw();

            latInput.addEventListener('input', () => {
                latEdited = true;
                scheduleAutoAddFromInputs();
            });

            lngInput.addEventListener('input', () => {
                lngEdited = true;
                scheduleAutoAddFromInputs();
            });

            latInput.addEventListener('change', tryAddPointFromInputs);
            lngInput.addEventListener('change', tryAddPointFromInputs);
            latInput.addEventListener('keydown', (e) => {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    tryAddPointFromInputs();
                }
            });
            lngInput.addEventListener('keydown', (e) => {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    tryAddPointFromInputs();
                }
            });

            map.addListener('click', (e) => {
                if (!e.latLng) {
                    return;
                }
                points.push({ lat: e.latLng.lat(), lng: e.latLng.lng() });
                redraw();
            });

            undoBtn.addEventListener('click', () => {
                if (points.length === 0) {
                    return;
                }
                points.pop();
                redraw();
            });

            clearBtn.addEventListener('click', () => {
                points = [];
                redraw();
            });

            window.addEventListener('resize', refreshMapSize);
            document.addEventListener('visibilitychange', () => {
                if (!document.hidden) {
                    refreshMapSize();
                }
            });

            if (typeof ResizeObserver !== 'undefined') {
                const resizeObserver = new ResizeObserver(() => refreshMapSize());
                resizeObserver.observe(mapEl);
            }

            if (typeof IntersectionObserver !== 'undefined') {
                const visibilityObserver = new IntersectionObserver((entries) => {
                    entries.forEach((entry) => {
                        if (entry.isIntersecting) {
                            refreshMapSize();
                        }
                    });
                }, { threshold: 0.05 });
                visibilityObserver.observe(mapEl);
            }

            setTimeout(refreshMapSize, 150);
        })
        .catch((error) => {
            initLeafletBoundaryMap('Using OpenStreetMap fallback');
            console.error(error);
        });
})();
</script>

    </div>
    </main>
<?php /**PATH C:\Users\jayso\Desktop\dev\web\Mannalon-App\resources\views/admin/farmers-content.blade.php ENDPATH**/ ?>