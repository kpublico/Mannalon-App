

<?php $__env->startSection('title', 'Farmer Information & Analytics Dashboard'); ?>

<?php $__env->startSection('content'); ?>
<div class="space-y-6">
    <!-- Header -->
    <div style="background: linear-gradient(135deg, #2ecc71 0%, #27ae60 100%); color: white; padding: 2rem; border-radius: 0.5rem; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
        <h1 style="font-size: 2rem; font-weight: bold; margin: 0;">Farmer Information & Analytics Dashboard</h1>
        <p style="margin: 0.5rem 0 0 0; opacity: 0.9;">Select a farmer to view detailed information and analytics</p>
    </div>

    <!-- Farmer Selector Card -->
    <div style="background: white; border: 1px solid #e0e0e0; border-radius: 0.5rem; padding: 1.5rem; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
        <div style="display: flex; flex-direction: column; gap: 1rem;">
            <label style="font-weight: 600; font-size: 1.1rem; color: #333;">
                <i class="fas fa-users" style="margin-right: 0.5rem;"></i>Select a Registered Farmer
            </label>
            
            <form method="GET" action="<?php echo e(route('admin.farmer-info-dashboard')); ?>" id="farmerSelector" style="display: flex; gap: 1rem; align-items: flex-end;">
                <div style="flex: 1;">
                    <select name="farmer_id" id="farmer_id" onchange="document.getElementById('farmerSelector').submit();" style="width: 100%; padding: 0.75rem; border: 1px solid #ccc; border-radius: 0.375rem; font-size: 1rem;">
                        <option value="">-- Choose a Farmer --</option>
                        <?php $__currentLoopData = $allFarmers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $f): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($f->id); ?>" <?php if($selectedFarmerId == $f->id): echo 'selected'; endif; ?>>
                                #<?php echo e($f->id); ?> - <?php echo e($f->first_name); ?> <?php echo e($f->last_name); ?> (<?php echo e($f->municipality_city ?? 'N/A'); ?>)
                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                
                <?php if($selectedFarmerId): ?>
                    <a href="<?php echo e(route('admin.farmer-info-dashboard')); ?>" style="padding: 0.75rem 1.5rem; background: #e74c3c; color: white; border-radius: 0.375rem; text-decoration: none; font-weight: 600;">
                        <i class="fas fa-times"></i> Clear
                    </a>
                <?php endif; ?>
            </form>

            <?php if($allFarmers->isEmpty()): ?>
                <div style="background: #fff3cd; border: 1px solid #ffc107; color: #856404; padding: 1rem; border-radius: 0.375rem; margin-top: 1rem;">
                    <i class="fas fa-info-circle"></i> No farmers registered yet.
                </div>
            <?php endif; ?>
        </div>
    </div>

    <?php if($farmer && !empty($analytics)): ?>
        <!-- Farmer Details Section -->
        <div style="background: white; border: 1px solid #e0e0e0; border-radius: 0.5rem; padding: 1.5rem; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
            <h2 style="font-size: 1.5rem; font-weight: bold; margin: 0 0 1.5rem 0; color: #333;">
                <i class="fas fa-id-card" style="color: #2ecc71; margin-right: 0.5rem;"></i>Farmer Details
            </h2>

            <!-- Personal Information -->
            <div style="margin-bottom: 2rem;">
                <h3 style="font-weight: 600; color: #555; padding-bottom: 0.75rem; border-bottom: 2px solid #2ecc71; margin: 0 0 1rem 0;">
                    <i class="fas fa-user"></i> Personal Information
                </h3>
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 1.25rem;">
                    <div>
                        <label style="font-weight: 600; color: #666; font-size: 0.875rem; text-transform: uppercase;">Farmer Name</label>
                        <input type="text" value="<?php echo e($analytics['full_name']); ?>" readonly style="width: 100%; padding: 0.75rem; border: 1px solid #ddd; border-radius: 0.375rem; background: #f9f9f9; color: #333;">
                    </div>
                    <div>
                        <label style="font-weight: 600; color: #666; font-size: 0.875rem; text-transform: uppercase;">Farmer ID</label>
                        <input type="text" value="#<?php echo e($analytics['farmer_id']); ?>" readonly style="width: 100%; padding: 0.75rem; border: 1px solid #ddd; border-radius: 0.375rem; background: #f9f9f9; color: #333;">
                    </div>
                    <div>
                        <label style="font-weight: 600; color: #666; font-size: 0.875rem; text-transform: uppercase;">Email Address</label>
                        <input type="email" value="<?php echo e($analytics['email']); ?>" readonly style="width: 100%; padding: 0.75rem; border: 1px solid #ddd; border-radius: 0.375rem; background: #f9f9f9; color: #333;">
                    </div>
                    <div>
                        <label style="font-weight: 600; color: #666; font-size: 0.875rem; text-transform: uppercase;">Phone Number</label>
                        <input type="text" value="<?php echo e($analytics['phone']); ?>" readonly style="width: 100%; padding: 0.75rem; border: 1px solid #ddd; border-radius: 0.375rem; background: #f9f9f9; color: #333;">
                    </div>
                    <div>
                        <label style="font-weight: 600; color: #666; font-size: 0.875rem; text-transform: uppercase;">Government ID Type</label>
                        <input type="text" value="<?php echo e($analytics['government_id_type']); ?>" readonly style="width: 100%; padding: 0.75rem; border: 1px solid #ddd; border-radius: 0.375rem; background: #f9f9f9; color: #333;">
                    </div>
                    <div>
                        <label style="font-weight: 600; color: #666; font-size: 0.875rem; text-transform: uppercase;">Government ID Number</label>
                        <input type="text" value="<?php echo e($analytics['government_id_number']); ?>" readonly style="width: 100%; padding: 0.75rem; border: 1px solid #ddd; border-radius: 0.375rem; background: #f9f9f9; color: #333;">
                    </div>
                </div>
            </div>

            <!-- Location Information -->
            <div style="margin-bottom: 2rem;">
                <h3 style="font-weight: 600; color: #555; padding-bottom: 0.75rem; border-bottom: 2px solid #2ecc71; margin: 0 0 1rem 0;">
                    <i class="fas fa-map-marker-alt"></i> Location Information
                </h3>
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 1.25rem;">
                    <div>
                        <label style="font-weight: 600; color: #666; font-size: 0.875rem; text-transform: uppercase;">Location</label>
                        <input type="text" value="<?php echo e($analytics['location']); ?>" readonly style="width: 100%; padding: 0.75rem; border: 1px solid #ddd; border-radius: 0.375rem; background: #f9f9f9; color: #333;">
                    </div>
                    <div>
                        <label style="font-weight: 600; color: #666; font-size: 0.875rem; text-transform: uppercase;">Region</label>
                        <input type="text" value="<?php echo e($farmer->region ?? 'Not provided'); ?>" readonly style="width: 100%; padding: 0.75rem; border: 1px solid #ddd; border-radius: 0.375rem; background: #f9f9f9; color: #333;">
                    </div>
                    <div>
                        <label style="font-weight: 600; color: #666; font-size: 0.875rem; text-transform: uppercase;">Province</label>
                        <input type="text" value="<?php echo e($farmer->province ?? 'Not provided'); ?>" readonly style="width: 100%; padding: 0.75rem; border: 1px solid #ddd; border-radius: 0.375rem; background: #f9f9f9; color: #333;">
                    </div>
                    <div>
                        <label style="font-weight: 600; color: #666; font-size: 0.875rem; text-transform: uppercase;">Barangay</label>
                        <input type="text" value="<?php echo e($farmer->barangay ?? 'Not provided'); ?>" readonly style="width: 100%; padding: 0.75rem; border: 1px solid #ddd; border-radius: 0.375rem; background: #f9f9f9; color: #333;">
                    </div>
                </div>
            </div>

            <!-- Farming Expertise -->
            <div style="margin-bottom: 2rem;">
                <h3 style="font-weight: 600; color: #555; padding-bottom: 0.75rem; border-bottom: 2px solid #2ecc71; margin: 0 0 1rem 0;">
                    <i class="fas fa-leaf"></i> Farming Information
                </h3>
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 1.25rem;">
                    <div>
                        <label style="font-weight: 600; color: #666; font-size: 0.875rem; text-transform: uppercase;">Farmer Type</label>
                        <input type="text" value="<?php echo e($analytics['farmer_type']); ?>" readonly style="width: 100%; padding: 0.75rem; border: 1px solid #ddd; border-radius: 0.375rem; background: #f9f9f9; color: #333;">
                    </div>
                    <div>
                        <label style="font-weight: 600; color: #666; font-size: 0.875rem; text-transform: uppercase;">Years in Farming</label>
                        <input type="text" value="<?php echo e($analytics['years_in_farming']); ?> years" readonly style="width: 100%; padding: 0.75rem; border: 1px solid #ddd; border-radius: 0.375rem; background: #f9f9f9; color: #333;">
                    </div>
                    <div>
                        <label style="font-weight: 600; color: #666; font-size: 0.875rem; text-transform: uppercase;">Farm Size</label>
                        <input type="text" value="<?php echo e($analytics['farm_size_hectares']); ?> hectares" readonly style="width: 100%; padding: 0.75rem; border: 1px solid #ddd; border-radius: 0.375rem; background: #f9f9f9; color: #333;">
                    </div>
                    <div>
                        <label style="font-weight: 600; color: #666; font-size: 0.875rem; text-transform: uppercase;">Land Ownership</label>
                        <input type="text" value="<?php echo e($analytics['land_ownership']); ?>" readonly style="width: 100%; padding: 0.75rem; border: 1px solid #ddd; border-radius: 0.375rem; background: #f9f9f9; color: #333;">
                    </div>
                    <div>
                        <label style="font-weight: 600; color: #666; font-size: 0.875rem; text-transform: uppercase;">Association Member</label>
                        <input type="text" value="<?php echo e($analytics['is_association_member']); ?>" readonly style="width: 100%; padding: 0.75rem; border: 1px solid #ddd; border-radius: 0.375rem; background: #f9f9f9; color: #333;">
                    </div>
                    <div>
                        <label style="font-weight: 600; color: #666; font-size: 0.875rem; text-transform: uppercase;">Association/Cooperative</label>
                        <input type="text" value="<?php echo e($analytics['association_name']); ?>" readonly style="width: 100%; padding: 0.75rem; border: 1px solid #ddd; border-radius: 0.375rem; background: #f9f9f9; color: #333;">
                    </div>
                </div>
            </div>

            <!-- Crops & Livestock -->
            <div style="margin-bottom: 2rem;">
                <h3 style="font-weight: 600; color: #555; padding-bottom: 0.75rem; border-bottom: 2px solid #2ecc71; margin: 0 0 1rem 0;">
                    <i class="fas fa-seedling"></i> Crops & Livestock
                </h3>
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 1.25rem;">
                    <div>
                        <label style="font-weight: 600; color: #666; font-size: 0.875rem; text-transform: uppercase;">Crops Grown</label>
                        <textarea readonly style="width: 100%; padding: 0.75rem; border: 1px solid #ddd; border-radius: 0.375rem; background: #f9f9f9; color: #333; min-height: 80px; font-family: inherit;"><?php echo e($analytics['crops']); ?></textarea>
                    </div>
                    <div>
                        <label style="font-weight: 600; color: #666; font-size: 0.875rem; text-transform: uppercase;">Livestock Raised</label>
                        <textarea readonly style="width: 100%; padding: 0.75rem; border: 1px solid #ddd; border-radius: 0.375rem; background: #f9f9f9; color: #333; min-height: 80px; font-family: inherit;"><?php echo e($analytics['livestock_types']); ?></textarea>
                    </div>
                </div>
            </div>

            <!-- Account Status -->
            <div>
                <h3 style="font-weight: 600; color: #555; padding-bottom: 0.75rem; border-bottom: 2px solid #2ecc71; margin: 0 0 1rem 0;">
                    <i class="fas fa-shield-alt"></i> Account Status
                </h3>
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 1.25rem;">
                    <div>
                        <label style="font-weight: 600; color: #666; font-size: 0.875rem; text-transform: uppercase;">Farmer Profile Status</label>
                        <div style="padding: 0.75rem; border: 1px solid #ddd; border-radius: 0.375rem; background: #f9f9f9; color: #333; font-weight: 600;">
                            <?php if($analytics['status'] === 'active'): ?>
                                <span style="color: #27ae60;"><i class="fas fa-check-circle"></i> Active</span>
                            <?php elseif($analytics['status'] === 'inactive'): ?>
                                <span style="color: #e74c3c;"><i class="fas fa-times-circle"></i> Inactive</span>
                            <?php else: ?>
                                <span style="color: #3498db;"><i class="fas fa-check-double"></i> Verified</span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div>
                        <label style="font-weight: 600; color: #666; font-size: 0.875rem; text-transform: uppercase;">User Account Status</label>
                        <div style="padding: 0.75rem; border: 1px solid #ddd; border-radius: 0.375rem; background: #f9f9f9; color: #333; font-weight: 600;">
                            <?php if($analytics['user_status'] === 'active'): ?>
                                <span style="color: #27ae60;"><i class="fas fa-check-circle"></i> Active</span>
                            <?php else: ?>
                                <span style="color: #e74c3c;"><i class="fas fa-times-circle"></i> Inactive</span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div>
                        <label style="font-weight: 600; color: #666; font-size: 0.875rem; text-transform: uppercase;">Registration Date</label>
                        <input type="text" value="<?php echo e($analytics['registration_date']); ?>" readonly style="width: 100%; padding: 0.75rem; border: 1px solid #ddd; border-radius: 0.375rem; background: #f9f9f9; color: #333;">
                    </div>
                </div>
            </div>
        </div>

        <!-- Reports & Analytics Section -->
        <div style="background: white; border: 1px solid #e0e0e0; border-radius: 0.5rem; padding: 1.5rem; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
            <h2 style="font-size: 1.5rem; font-weight: bold; margin: 0 0 1.5rem 0; color: #333;">
                <i class="fas fa-chart-bar" style="color: #3498db; margin-right: 0.5rem;"></i>Reports & Analytics
            </h2>

            <!-- Comprehensive Summary (Top) -->
            <?php
                $boundaryPointsCount = is_array($farmer->land_boundary_points ?? null) ? count($farmer->land_boundary_points) : 0;

                $summaryGroups = [
                    '1. Personal Information' => [
                        'Farmer ID' => '#' . ($farmer->id ?? 'N/A'),
                        'First Name' => $farmer->first_name ?? 'Not provided',
                        'Middle Name' => $farmer->middle_name ?? 'Not provided',
                        'Last Name' => $farmer->last_name ?? 'Not provided',
                        'Gender' => $farmer->gender ? ucfirst($farmer->gender) : 'Not provided',
                        'Date of Birth' => $farmer->date_of_birth ? \Carbon\Carbon::parse($farmer->date_of_birth)->format('M d, Y') : 'Not provided',
                        'Age' => $farmer->age ?? 'Not provided',
                        'Civil Status' => $farmer->civil_status ? ucfirst($farmer->civil_status) : 'Not provided',
                        'Contact Number' => $farmer->phone ?? 'Not provided',
                        'Email' => $farmer->email ?? 'Not provided',
                        'Government ID Type' => $farmer->government_id_type ?? 'Not provided',
                        'Government ID Number' => $farmer->government_id_number ?? 'Not provided',
                    ],
                    '2. Address Information' => [
                        'Region' => $farmer->region ?? 'Not provided',
                        'Province' => $farmer->province ?? 'Not provided',
                        'Municipality/City' => $farmer->municipality_city ?? 'Not provided',
                        'Barangay' => $farmer->barangay ?? 'Not provided',
                        'Sitio/Purok' => $farmer->sitio_purok ?? 'Not provided',
                        'GPS Latitude' => $farmer->gps_latitude ?? 'Not provided',
                        'GPS Longitude' => $farmer->gps_longitude ?? 'Not provided',
                        'Land Boundary Points' => $boundaryPointsCount > 0 ? $boundaryPointsCount . ' point(s)' : 'No boundary points recorded',
                    ],
                    '3. System Information' => [
                        'User Account Status' => $analytics['user_status'] === 'active' ? 'Active' : 'Inactive',
                        'Farmer Profile Status' => ucfirst($analytics['status'] ?? 'active'),
                        'Registration Date' => $analytics['registration_date'] ?? 'Not available',
                        'Registered By Admin ID' => $farmer->registered_by ?? 'Not recorded',
                    ],
                    '4. Farming Profile' => [
                        'Farmer Type' => $farmer->farmer_type ? ucfirst(str_replace('_', ' ', $farmer->farmer_type)) : 'Not provided',
                        'Years in Farming' => $farmer->years_in_farming !== null ? $farmer->years_in_farming . ' year(s)' : 'Not provided',
                        'Primary Occupation' => $farmer->primary_occupation ?? 'Not provided',
                        'Secondary Occupation' => $farmer->secondary_occupation ?? 'Not provided',
                        'Association Member' => $farmer->is_association_member ? 'Yes' : 'No',
                        'Association Name' => $farmer->association_name ?? 'Not provided',
                    ],
                    '5. Farm Information' => [
                        'Farm Location' => $farmer->farm_location ?? 'Not provided',
                        'Farm Size (hectares)' => $farmer->farm_size_hectares ?? 'Not provided',
                        'Land Ownership Type' => $farmer->land_ownership_type ? ucfirst($farmer->land_ownership_type) : 'Not provided',
                        'Number of Parcels' => $farmer->number_of_parcels ?? 'Not provided',
                    ],
                    '6. Resources and Equipment' => [
                        'Farm Equipment' => $farmer->farm_equipment ?? 'Not provided',
                        'Irrigation Type' => $farmer->irrigation_type ? ucfirst($farmer->irrigation_type) : 'Not provided',
                        'Water Source' => $farmer->water_source ?? 'Not provided',
                        'Fertilizer Usage' => $farmer->fertilizer_usage ? ucfirst($farmer->fertilizer_usage) : 'Not provided',
                        'Pesticide Usage' => $farmer->pesticide_usage ?? 'Not provided',
                    ],
                    '7. Crop and Livestock Information' => [
                        'Crop Types' => $farmer->crop_types ?? 'Not provided',
                        'Crop Area per Type' => $farmer->crop_area_per_type ?? 'Not provided',
                        'Cropping Season' => $farmer->cropping_season ? ucfirst(str_replace('_', '/', $farmer->cropping_season)) : 'Not provided',
                        'Yield per Harvest' => $farmer->yield_per_harvest ?? 'Not provided',
                        'Livestock Types' => $farmer->livestock_types ?? 'Not provided',
                        'Livestock Count' => $farmer->livestock_count ?? 'Not provided',
                    ],
                    '8. Financial Information' => [
                        'Average Monthly Income' => $farmer->average_monthly_income !== null ? number_format((float) $farmer->average_monthly_income, 2) : 'Not provided',
                        'Average Annual Income' => $farmer->average_annual_income !== null ? number_format((float) $farmer->average_annual_income, 2) : 'Not provided',
                        'Income Source' => $farmer->income_source ? ucfirst(str_replace('_', '-', $farmer->income_source)) : 'Not provided',
                        'Access to Credit/Loans' => $farmer->has_credit_access ? 'Yes' : 'No',
                        'Insurance Coverage' => $farmer->insurance_coverage ?? 'Not provided',
                    ],
                    '9. Government Program Participation' => [
                        'RSBSA Registered' => $farmer->is_rsbsa_registered ? 'Yes' : 'No',
                        'Programs Availed' => $farmer->programs_availed ?? 'Not provided',
                        'Program Registration Date' => $farmer->program_registration_date ? \Carbon\Carbon::parse($farmer->program_registration_date)->format('M d, Y') : 'Not provided',
                    ],
                    '10. Documents and Attachments' => [
                        'Valid ID' => !empty($farmer->valid_id_path) ? 'Uploaded' : 'Not uploaded',
                        'Land Document' => !empty($farmer->land_document_path) ? 'Uploaded' : 'Not uploaded',
                        'Farm Photo' => !empty($farmer->farm_photos_path) ? 'Uploaded' : 'Not uploaded',
                        'Barangay Certification' => !empty($farmer->barangay_certification_path) ? 'Uploaded' : 'Not uploaded',
                    ],
                ];
            ?>

            <div style="margin-bottom: 2rem;">
                <h3 style="font-weight: 600; color: #555; margin: 0 0 1rem 0;">Comprehensive Profile Summary</h3>
                <p style="margin: 0 0 1rem 0; color: #6b7280; font-size: 0.95rem;">This report reflects all summary fields entered in Farmer Information.</p>

                <?php $__currentLoopData = $summaryGroups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $groupTitle => $groupRows): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div style="border: 1px solid #e5e7eb; border-radius: 0.5rem; overflow: hidden; margin-bottom: 1rem;">
                        <div style="background: #f3fdf8; color: #065f46; font-weight: 700; padding: 0.75rem 1rem; border-bottom: 1px solid #d1fae5;">
                            <?php echo e($groupTitle); ?>

                        </div>
                        <table style="width: 100%; border-collapse: collapse;">
                            <?php $__currentLoopData = $groupRows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fieldLabel => $fieldValue): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td style="padding: 0.7rem 0.9rem; border-bottom: 1px solid #f1f5f9; background: #fbfdfc; font-weight: 600; color: #4b5563; width: 32%; vertical-align: top;">
                                        <?php echo e($fieldLabel); ?>

                                    </td>
                                    <td style="padding: 0.7rem 0.9rem; border-bottom: 1px solid #f1f5f9; color: #1f2937; white-space: pre-wrap;">
                                        <?php echo e($fieldValue ?: 'Not provided'); ?>

                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </table>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            <!-- Summary Cards -->
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem; margin-bottom: 2rem;">
                <!-- Total Crops Card -->
                <div style="background: linear-gradient(135deg, #2ecc71 0%, #27ae60 100%); color: white; padding: 1.5rem; border-radius: 0.5rem; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <div>
                            <p style="margin: 0; opacity: 0.9; font-size: 0.875rem; font-weight: 600; text-transform: uppercase;">Total Crops</p>
                            <p style="margin: 0.5rem 0 0 0; font-size: 2.5rem; font-weight: bold;"><?php echo e($analytics['total_crops']); ?></p>
                        </div>
                        <i class="fas fa-leaf" style="font-size: 2.5rem; opacity: 0.3;"></i>
                    </div>
                    <p style="margin: 1rem 0 0 0; font-size: 0.875rem; opacity: 0.9;">Crops currently cultivated</p>
                </div>

                <!-- Total Livestock Card -->
                <div style="background: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%); color: white; padding: 1.5rem; border-radius: 0.5rem; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <div>
                            <p style="margin: 0; opacity: 0.9; font-size: 0.875rem; font-weight: 600; text-transform: uppercase;">Total Livestock</p>
                            <p style="margin: 0.5rem 0 0 0; font-size: 2.5rem; font-weight: bold;"><?php echo e($analytics['total_livestock']); ?></p>
                        </div>
                        <i class="fas fa-horse" style="font-size: 2.5rem; opacity: 0.3;"></i>
                    </div>
                    <p style="margin: 1rem 0 0 0; font-size: 0.875rem; opacity: 0.9;">Types of livestock raised</p>
                </div>

                <!-- Farm Size Card -->
                <div style="background: linear-gradient(135deg, #3498db 0%, #2980b9 100%); color: white; padding: 1.5rem; border-radius: 0.5rem; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <div>
                            <p style="margin: 0; opacity: 0.9; font-size: 0.875rem; font-weight: 600; text-transform: uppercase;">Farm Size</p>
                            <p style="margin: 0.5rem 0 0 0; font-size: 2.5rem; font-weight: bold;"><?php echo e($analytics['farm_size_hectares']); ?></p>
                        </div>
                        <i class="fas fa-tractor" style="font-size: 2.5rem; opacity: 0.3;"></i>
                    </div>
                    <p style="margin: 1rem 0 0 0; font-size: 0.875rem; opacity: 0.9;">Hectares under cultivation</p>
                </div>

                <!-- Experience Card -->
                <div style="background: linear-gradient(135deg, #f39c12 0%, #e67e22 100%); color: white; padding: 1.5rem; border-radius: 0.5rem; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <div>
                            <p style="margin: 0; opacity: 0.9; font-size: 0.875rem; font-weight: 600; text-transform: uppercase;">Experience</p>
                            <p style="margin: 0.5rem 0 0 0; font-size: 2.5rem; font-weight: bold;"><?php echo e($analytics['years_in_farming']); ?></p>
                        </div>
                        <i class="fas fa-history" style="font-size: 2.5rem; opacity: 0.3;"></i>
                    </div>
                    <p style="margin: 1rem 0 0 0; font-size: 0.875rem; opacity: 0.9;">Years in farming</p>
                </div>
            </div>

            <!-- Action Buttons -->
            <div style="margin-top: 2rem; display: flex; gap: 1rem; flex-wrap: wrap;">
                <a href="<?php echo e(route('admin.farmers.show', $farmer->id)); ?>" style="padding: 0.75rem 1.5rem; background: #3498db; color: white; text-decoration: none; border-radius: 0.375rem; font-weight: 600;">
                    <i class="fas fa-edit"></i> Edit Farmer Information
                </a>
                <a href="<?php echo e(route('admin.farmers.index')); ?>" style="padding: 0.75rem 1.5rem; background: #95a5a6; color: white; text-decoration: none; border-radius: 0.375rem; font-weight: 600;">
                    <i class="fas fa-arrow-left"></i> Back to Farmers List
                </a>
            </div>
        </div>
    <?php elseif($selectedFarmerId && !$farmer): ?>
        <div style="background: #f8d7da; border: 1px solid #f5c6cb; color: #721c24; padding: 1rem; border-radius: 0.375rem;">
            <i class="fas fa-exclamation-circle"></i> Farmer not found.
        </div>
    <?php else: ?>
        <div style="background: #d1ecf1; border: 1px solid #bee5eb; color: #0c5460; padding: 2rem; border-radius: 0.375rem; text-align: center;">
            <i class="fas fa-hand-point-up" style="font-size: 2rem; margin-bottom: 1rem; display: block;"></i>
            <p style="margin: 0; font-weight: 600;">Select a farmer from the dropdown above to view their detailed information and analytics.</p>
        </div>
    <?php endif; ?>
</div>

<style>
    .space-y-6 > * + * {
        margin-top: 1.5rem;
    }
</style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Mannalon_App\resources\views\admin\farmer-information-dashboard.blade.php ENDPATH**/ ?>