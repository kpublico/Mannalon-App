

<?php $__env->startSection('title', 'My Farmer Information'); ?>
<?php $__env->startSection('page-title', 'My Farmer Information'); ?>
<?php $__env->startSection('page-subtitle', 'View your comprehensive farm and personal information'); ?>

<?php $__env->startSection('content'); ?>
<div class="space-y-6">
    <!-- Header Banner -->
    <div class="bg-gradient-to-r from-emerald-600 to-emerald-800 rounded-2xl p-8 text-white shadow-lg">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-3xl font-bold mb-2"><?php echo e(auth()->user()->name ?? 'Farmer'); ?>'s Complete Information</h2>
                <p class="text-emerald-100">This is all the information associated with your farmer profile.</p>
            </div>
            <div class="text-right">
                <?php if($farmer): ?>
                    <span class="inline-block bg-emerald-500 text-white px-4 py-2 rounded-lg text-sm font-semibold">
                        <i class="fas fa-check-circle mr-2"></i>Profile Complete
                    </span>
                <?php else: ?>
                    <span class="inline-block bg-amber-500 text-white px-4 py-2 rounded-lg text-sm font-semibold">
                        <i class="fas fa-exclamation-circle mr-2"></i>No Profile Data
                    </span>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <?php if(!$farmer): ?>
    <div class="bg-amber-50 border border-amber-200 rounded-lg p-6 text-center">
        <i class="fas fa-info-circle text-amber-600 text-2xl mb-3"></i>
        <p class="text-amber-800 font-semibold">No Farmer Information Found</p>
        <p class="text-amber-700 text-sm mt-2">Your comprehensive farmer profile has not been created yet. Please contact the administrator to register your farm details.</p>
    </div>
    <?php else: ?>
    <!-- Category 1: Personal Information -->
    <details class="bg-white rounded-lg border border-gray-200 shadow-sm overflow-hidden group" open>
        <summary class="cursor-pointer p-6 font-semibold text-lg text-gray-800 bg-gray-50 hover:bg-gray-100 flex items-center justify-between">
            <span><i class="fas fa-id-card text-emerald-600 mr-3"></i>1. Personal Information</span>
            <i class="fas fa-chevron-down text-gray-400 group-open:rotate-180 transition"></i>
        </summary>
        <div class="p-6 border-t border-gray-200">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="text-xs font-semibold text-gray-600 uppercase">Full Name</label>
                    <p class="text-gray-800 font-medium"><?php echo e($farmer->name ?? 'Not provided'); ?></p>
                </div>
                <div>
                    <label class="text-xs font-semibold text-gray-600 uppercase">First Name</label>
                    <p class="text-gray-800 font-medium"><?php echo e($farmer->first_name ?? 'Not provided'); ?></p>
                </div>
                <div>
                    <label class="text-xs font-semibold text-gray-600 uppercase">Middle Name</label>
                    <p class="text-gray-800 font-medium"><?php echo e($farmer->middle_name ?? 'Not provided'); ?></p>
                </div>
                <div>
                    <label class="text-xs font-semibold text-gray-600 uppercase">Last Name</label>
                    <p class="text-gray-800 font-medium"><?php echo e($farmer->last_name ?? 'Not provided'); ?></p>
                </div>
                <div>
                    <label class="text-xs font-semibold text-gray-600 uppercase">Gender</label>
                    <p class="text-gray-800 font-medium"><?php echo e($farmer->gender ?? 'Not provided'); ?></p>
                </div>
                <div>
                    <label class="text-xs font-semibold text-gray-600 uppercase">Date of Birth</label>
                    <p class="text-gray-800 font-medium"><?php echo e($farmer->date_of_birth ? $farmer->date_of_birth->format('M d, Y') : 'Not provided'); ?></p>
                </div>
                <div>
                    <label class="text-xs font-semibold text-gray-600 uppercase">Age</label>
                    <p class="text-gray-800 font-medium"><?php echo e($farmer->age ?? 'Not provided'); ?> years</p>
                </div>
                <div>
                    <label class="text-xs font-semibold text-gray-600 uppercase">Civil Status</label>
                    <p class="text-gray-800 font-medium"><?php echo e($farmer->civil_status ?? 'Not provided'); ?></p>
                </div>
                <div>
                    <label class="text-xs font-semibold text-gray-600 uppercase">Government ID Type</label>
                    <p class="text-gray-800 font-medium"><?php echo e($farmer->government_id_type ?? 'Not provided'); ?></p>
                </div>
                <div>
                    <label class="text-xs font-semibold text-gray-600 uppercase">Government ID Number</label>
                    <p class="text-gray-800 font-medium"><?php echo e($farmer->government_id_number ?? 'Not provided'); ?></p>
                </div>
                <div>
                    <label class="text-xs font-semibold text-gray-600 uppercase">Email</label>
                    <p class="text-gray-800 font-medium"><?php echo e($farmer->email ?? auth()->user()->email); ?></p>
                </div>
                <div>
                    <label class="text-xs font-semibold text-gray-600 uppercase">Phone</label>
                    <p class="text-gray-800 font-medium"><?php echo e($farmer->phone ?? 'Not provided'); ?></p>
                </div>
            </div>
        </div>
    </details>

    <!-- Category 2: Address Information -->
    <details class="bg-white rounded-lg border border-gray-200 shadow-sm overflow-hidden group">
        <summary class="cursor-pointer p-6 font-semibold text-lg text-gray-800 bg-gray-50 hover:bg-gray-100 flex items-center justify-between">
            <span><i class="fas fa-map-marker-alt text-emerald-600 mr-3"></i>2. Address Information</span>
            <i class="fas fa-chevron-down text-gray-400 group-open:rotate-180 transition"></i>
        </summary>
        <div class="p-6 border-t border-gray-200">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="text-xs font-semibold text-gray-600 uppercase">Region</label>
                    <p class="text-gray-800 font-medium"><?php echo e($farmer->region ?? 'Not provided'); ?></p>
                </div>
                <div>
                    <label class="text-xs font-semibold text-gray-600 uppercase">Province</label>
                    <p class="text-gray-800 font-medium"><?php echo e($farmer->province ?? 'Not provided'); ?></p>
                </div>
                <div>
                    <label class="text-xs font-semibold text-gray-600 uppercase">Municipality/City</label>
                    <p class="text-gray-800 font-medium"><?php echo e($farmer->municipality_city ?? 'Not provided'); ?></p>
                </div>
                <div>
                    <label class="text-xs font-semibold text-gray-600 uppercase">Barangay</label>
                    <p class="text-gray-800 font-medium"><?php echo e($farmer->barangay ?? 'Not provided'); ?></p>
                </div>
                <div>
                    <label class="text-xs font-semibold text-gray-600 uppercase">Sitio/Purok</label>
                    <p class="text-gray-800 font-medium"><?php echo e($farmer->sitio_purok ?? 'Not provided'); ?></p>
                </div>
                <div>
                    <label class="text-xs font-semibold text-gray-600 uppercase">Farm Location</label>
                    <p class="text-gray-800 font-medium"><?php echo e($farmer->farm_location ?? 'Not provided'); ?></p>
                </div>
            </div>
        </div>
    </details>

    <!-- Category 3: Farming Profile -->
    <details class="bg-white rounded-lg border border-gray-200 shadow-sm overflow-hidden group">
        <summary class="cursor-pointer p-6 font-semibold text-lg text-gray-800 bg-gray-50 hover:bg-gray-100 flex items-center justify-between">
            <span><i class="fas fa-leaf text-emerald-600 mr-3"></i>3. Farming Profile</span>
            <i class="fas fa-chevron-down text-gray-400 group-open:rotate-180 transition"></i>
        </summary>
        <div class="p-6 border-t border-gray-200">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="text-xs font-semibold text-gray-600 uppercase">Farmer Type</label>
                    <p class="text-gray-800 font-medium"><?php echo e($farmer->farmer_type ?? 'Not provided'); ?></p>
                </div>
                <div>
                    <label class="text-xs font-semibold text-gray-600 uppercase">Years in Farming</label>
                    <p class="text-gray-800 font-medium"><?php echo e($farmer->years_in_farming ?? 'Not provided'); ?> years</p>
                </div>
                <div>
                    <label class="text-xs font-semibold text-gray-600 uppercase">Primary Occupation</label>
                    <p class="text-gray-800 font-medium"><?php echo e($farmer->primary_occupation ?? 'Not provided'); ?></p>
                </div>
                <div>
                    <label class="text-xs font-semibold text-gray-600 uppercase">Secondary Occupation</label>
                    <p class="text-gray-800 font-medium"><?php echo e($farmer->secondary_occupation ?? 'Not provided'); ?></p>
                </div>
                <div>
                    <label class="text-xs font-semibold text-gray-600 uppercase">Association Member</label>
                    <p class="text-gray-800 font-medium">
                        <?php if($farmer->is_association_member): ?>
                            <span class="px-2 py-1 bg-emerald-100 text-emerald-800 rounded text-xs font-semibold">Yes</span>
                        <?php else: ?>
                            <span class="px-2 py-1 bg-gray-100 text-gray-800 rounded text-xs font-semibold">No</span>
                        <?php endif; ?>
                    </p>
                </div>
                <div>
                    <label class="text-xs font-semibold text-gray-600 uppercase">Association Name</label>
                    <p class="text-gray-800 font-medium"><?php echo e($farmer->association_name ?? 'Not provided'); ?></p>
                </div>
            </div>
        </div>
    </details>

    <!-- Category 4: Farm Information -->
    <details class="bg-white rounded-lg border border-gray-200 shadow-sm overflow-hidden group">
        <summary class="cursor-pointer p-6 font-semibold text-lg text-gray-800 bg-gray-50 hover:bg-gray-100 flex items-center justify-between">
            <span><i class="fas fa-tractor text-emerald-600 mr-3"></i>4. Farm Information</span>
            <i class="fas fa-chevron-down text-gray-400 group-open:rotate-180 transition"></i>
        </summary>
        <div class="p-6 border-t border-gray-200">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="text-xs font-semibold text-gray-600 uppercase">Farm Size (hectares)</label>
                    <p class="text-gray-800 font-medium"><?php echo e($farmer->farm_size_hectares ?? 'Not provided'); ?> ha</p>
                </div>
                <div>
                    <label class="text-xs font-semibold text-gray-600 uppercase">Land Ownership Type</label>
                    <p class="text-gray-800 font-medium"><?php echo e($farmer->land_ownership_type ?? 'Not provided'); ?></p>
                </div>
                <div>
                    <label class="text-xs font-semibold text-gray-600 uppercase">Number of Parcels</label>
                    <p class="text-gray-800 font-medium"><?php echo e($farmer->number_of_parcels ?? 'Not provided'); ?></p>
                </div>
                <div>
                    <label class="text-xs font-semibold text-gray-600 uppercase">GPS Coordinates</label>
                    <p class="text-gray-800 font-medium">
                        <?php echo e($farmer->gps_latitude ?? 'N/A'); ?>, <?php echo e($farmer->gps_longitude ?? 'N/A'); ?>

                    </p>
                </div>
            </div>
            <?php if($farmer->land_boundary_points): ?>
            <div class="mt-4 pt-4 border-t border-gray-200">
                <label class="text-xs font-semibold text-gray-600 uppercase">Land Boundary Points</label>
                <p class="text-gray-700 text-sm font-mono bg-gray-50 p-3 rounded mt-2 break-words">
                    <?php echo e($farmer->land_boundary_points); ?>

                </p>
            </div>
            <?php endif; ?>
        </div>
    </details>

    <!-- Category 5: Crops & Livestock -->
    <details class="bg-white rounded-lg border border-gray-200 shadow-sm overflow-hidden group">
        <summary class="cursor-pointer p-6 font-semibold text-lg text-gray-800 bg-gray-50 hover:bg-gray-100 flex items-center justify-between">
            <span><i class="fas fa-seedling text-emerald-600 mr-3"></i>5. Crops & Livestock</span>
            <i class="fas fa-chevron-down text-gray-400 group-open:rotate-180 transition"></i>
        </summary>
        <div class="p-6 border-t border-gray-200">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="text-xs font-semibold text-gray-600 uppercase">Crop Types</label>
                    <p class="text-gray-800 font-medium"><?php echo e($farmer->crop_types ?? 'Not provided'); ?></p>
                </div>
                <div>
                    <label class="text-xs font-semibold text-gray-600 uppercase">Crop Area per Type</label>
                    <p class="text-gray-800 font-medium"><?php echo e($farmer->crop_area_per_type ?? 'Not provided'); ?></p>
                </div>
                <div>
                    <label class="text-xs font-semibold text-gray-600 uppercase">Cropping Season</label>
                    <p class="text-gray-800 font-medium"><?php echo e($farmer->cropping_season ?? 'Not provided'); ?></p>
                </div>
                <div>
                    <label class="text-xs font-semibold text-gray-600 uppercase">Yield per Harvest</label>
                    <p class="text-gray-800 font-medium"><?php echo e($farmer->yield_per_harvest ?? 'Not provided'); ?></p>
                </div>
                <div>
                    <label class="text-xs font-semibold text-gray-600 uppercase">Livestock Types</label>
                    <p class="text-gray-800 font-medium"><?php echo e($farmer->livestock_types ?? 'Not provided'); ?></p>
                </div>
                <div>
                    <label class="text-xs font-semibold text-gray-600 uppercase">Livestock Count</label>
                    <p class="text-gray-800 font-medium"><?php echo e($farmer->livestock_count ?? 'Not provided'); ?> animals</p>
                </div>
            </div>
        </div>
    </details>

    <!-- Category 6: Resources & Equipment -->
    <details class="bg-white rounded-lg border border-gray-200 shadow-sm overflow-hidden group">
        <summary class="cursor-pointer p-6 font-semibold text-lg text-gray-800 bg-gray-50 hover:bg-gray-100 flex items-center justify-between">
            <span><i class="fas fa-tools text-emerald-600 mr-3"></i>6. Resources & Equipment</span>
            <i class="fas fa-chevron-down text-gray-400 group-open:rotate-180 transition"></i>
        </summary>
        <div class="p-6 border-t border-gray-200">
            <div class="space-y-4">
                <div>
                    <label class="text-xs font-semibold text-gray-600 uppercase">Farm Equipment</label>
                    <p class="text-gray-800 font-medium"><?php echo e($farmer->farm_equipment ?? 'Not provided'); ?></p>
                </div>
                <div>
                    <label class="text-xs font-semibold text-gray-600 uppercase">Irrigation Type</label>
                    <p class="text-gray-800 font-medium"><?php echo e($farmer->irrigation_type ?? 'Not provided'); ?></p>
                </div>
                <div>
                    <label class="text-xs font-semibold text-gray-600 uppercase">Water Source</label>
                    <p class="text-gray-800 font-medium"><?php echo e($farmer->water_source ?? 'Not provided'); ?></p>
                </div>
                <div>
                    <label class="text-xs font-semibold text-gray-600 uppercase">Fertilizer Usage</label>
                    <p class="text-gray-800 font-medium"><?php echo e($farmer->fertilizer_usage ?? 'Not provided'); ?></p>
                </div>
                <div>
                    <label class="text-xs font-semibold text-gray-600 uppercase">Pesticide Usage</label>
                    <p class="text-gray-800 font-medium"><?php echo e($farmer->pesticide_usage ?? 'Not provided'); ?></p>
                </div>
            </div>
        </div>
    </details>

    <!-- Category 7: Financial Information -->
    <details class="bg-white rounded-lg border border-gray-200 shadow-sm overflow-hidden group">
        <summary class="cursor-pointer p-6 font-semibold text-lg text-gray-800 bg-gray-50 hover:bg-gray-100 flex items-center justify-between">
            <span><i class="fas fa-money-bill-wave text-emerald-600 mr-3"></i>7. Financial Information</span>
            <i class="fas fa-chevron-down text-gray-400 group-open:rotate-180 transition"></i>
        </summary>
        <div class="p-6 border-t border-gray-200">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="text-xs font-semibold text-gray-600 uppercase">Average Monthly Income</label>
                    <p class="text-gray-800 font-medium">₱<?php echo e(number_format($farmer->average_monthly_income ?? 0, 2)); ?></p>
                </div>
                <div>
                    <label class="text-xs font-semibold text-gray-600 uppercase">Average Annual Income</label>
                    <p class="text-gray-800 font-medium">₱<?php echo e(number_format($farmer->average_annual_income ?? 0, 2)); ?></p>
                </div>
                <div>
                    <label class="text-xs font-semibold text-gray-600 uppercase">Income Source</label>
                    <p class="text-gray-800 font-medium"><?php echo e($farmer->income_source ?? 'Not provided'); ?></p>
                </div>
                <div>
                    <label class="text-xs font-semibold text-gray-600 uppercase">Has Credit Access</label>
                    <p class="text-gray-800 font-medium">
                        <?php if($farmer->has_credit_access): ?>
                            <span class="px-2 py-1 bg-emerald-100 text-emerald-800 rounded text-xs font-semibold">Yes</span>
                        <?php else: ?>
                            <span class="px-2 py-1 bg-gray-100 text-gray-800 rounded text-xs font-semibold">No</span>
                        <?php endif; ?>
                    </p>
                </div>
                <div>
                    <label class="text-xs font-semibold text-gray-600 uppercase">Insurance Coverage</label>
                    <p class="text-gray-800 font-medium"><?php echo e($farmer->insurance_coverage ?? 'Not provided'); ?></p>
                </div>
            </div>
        </div>
    </details>

    <!-- Category 8: Government Programs -->
    <details class="bg-white rounded-lg border border-gray-200 shadow-sm overflow-hidden group">
        <summary class="cursor-pointer p-6 font-semibold text-lg text-gray-800 bg-gray-50 hover:bg-gray-100 flex items-center justify-between">
            <span><i class="fas fa-landmark text-emerald-600 mr-3"></i>8. Government Programs</span>
            <i class="fas fa-chevron-down text-gray-400 group-open:rotate-180 transition"></i>
        </summary>
        <div class="p-6 border-t border-gray-200">
            <div class="space-y-4">
                <div>
                    <label class="text-xs font-semibold text-gray-600 uppercase">RSBSA Registered</label>
                    <p class="text-gray-800 font-medium">
                        <?php if($farmer->is_rsbsa_registered): ?>
                            <span class="px-2 py-1 bg-emerald-100 text-emerald-800 rounded text-xs font-semibold">Yes</span>
                        <?php else: ?>
                            <span class="px-2 py-1 bg-gray-100 text-gray-800 rounded text-xs font-semibold">No</span>
                        <?php endif; ?>
                    </p>
                </div>
                <div>
                    <label class="text-xs font-semibold text-gray-600 uppercase">Programs Availed</label>
                    <p class="text-gray-800 font-medium"><?php echo e($farmer->programs_availed ?? 'Not provided'); ?></p>
                </div>
                <div>
                    <label class="text-xs font-semibold text-gray-600 uppercase">Program Registration Date</label>
                    <p class="text-gray-800 font-medium">
                        <?php echo e($farmer->program_registration_date ? $farmer->program_registration_date->format('M d, Y') : 'Not provided'); ?>

                    </p>
                </div>
            </div>
        </div>
    </details>

    <!-- Category 9: Documents -->
    <details class="bg-white rounded-lg border border-gray-200 shadow-sm overflow-hidden group">
        <summary class="cursor-pointer p-6 font-semibold text-lg text-gray-800 bg-gray-50 hover:bg-gray-100 flex items-center justify-between">
            <span><i class="fas fa-file-upload text-emerald-600 mr-3"></i>9. Documents</span>
            <i class="fas fa-chevron-down text-gray-400 group-open:rotate-180 transition"></i>
        </summary>
        <div class="p-6 border-t border-gray-200">
            <div class="space-y-4">
                <div>
                    <label class="text-xs font-semibold text-gray-600 uppercase">Valid ID</label>
                    <?php if($farmer->valid_id_path): ?>
                        <p class="text-emerald-700 font-medium"><i class="fas fa-check-circle mr-1"></i>Document uploaded</p>
                    <?php else: ?>
                        <p class="text-gray-600 font-medium">Not provided</p>
                    <?php endif; ?>
                </div>
                <div>
                    <label class="text-xs font-semibold text-gray-600 uppercase">Land Document</label>
                    <?php if($farmer->land_document_path): ?>
                        <p class="text-emerald-700 font-medium"><i class="fas fa-check-circle mr-1"></i>Document uploaded</p>
                    <?php else: ?>
                        <p class="text-gray-600 font-medium">Not provided</p>
                    <?php endif; ?>
                </div>
                <div>
                    <label class="text-xs font-semibold text-gray-600 uppercase">Farm Photos</label>
                    <?php if($farmer->farm_photos_path): ?>
                        <p class="text-emerald-700 font-medium"><i class="fas fa-check-circle mr-1"></i>Photos uploaded</p>
                    <?php else: ?>
                        <p class="text-gray-600 font-medium">Not provided</p>
                    <?php endif; ?>
                </div>
                <div>
                    <label class="text-xs font-semibold text-gray-600 uppercase">Barangay Certification</label>
                    <?php if($farmer->barangay_certification_path): ?>
                        <p class="text-emerald-700 font-medium"><i class="fas fa-check-circle mr-1"></i>Document uploaded</p>
                    <?php else: ?>
                        <p class="text-gray-600 font-medium">Not provided</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </details>

    <!-- Category 10: System Information -->
    <details class="bg-white rounded-lg border border-gray-200 shadow-sm overflow-hidden group">
        <summary class="cursor-pointer p-6 font-semibold text-lg text-gray-800 bg-gray-50 hover:bg-gray-100 flex items-center justify-between">
            <span><i class="fas fa-info-circle text-emerald-600 mr-3"></i>10. System Information</span>
            <i class="fas fa-chevron-down text-gray-400 group-open:rotate-180 transition"></i>
        </summary>
        <div class="p-6 border-t border-gray-200">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="text-xs font-semibold text-gray-600 uppercase">Registered By</label>
                    <p class="text-gray-800 font-medium"><?php echo e($farmer->registered_by ?? 'Not provided'); ?></p>
                </div>
                <div>
                    <label class="text-xs font-semibold text-gray-600 uppercase">Profile Status</label>
                    <p class="text-gray-800 font-medium">
                        <?php if($farmer->profile_status === 'active'): ?>
                            <span class="px-3 py-1 bg-emerald-100 text-emerald-800 rounded text-xs font-semibold">Active</span>
                        <?php elseif($farmer->profile_status === 'pending'): ?>
                            <span class="px-3 py-1 bg-yellow-100 text-yellow-800 rounded text-xs font-semibold">Pending</span>
                        <?php else: ?>
                            <span class="px-3 py-1 bg-gray-100 text-gray-800 rounded text-xs font-semibold"><?php echo e($farmer->profile_status ?? 'Not set'); ?></span>
                        <?php endif; ?>
                    </p>
                </div>
                <div>
                    <label class="text-xs font-semibold text-gray-600 uppercase">Profile Created</label>
                    <p class="text-gray-800 font-medium"><?php echo e($farmer->created_at->format('M d, Y H:i A')); ?></p>
                </div>
                <div>
                    <label class="text-xs font-semibold text-gray-600 uppercase">Last Updated</label>
                    <p class="text-gray-800 font-medium"><?php echo e($farmer->updated_at->format('M d, Y H:i A')); ?></p>
                </div>
            </div>
        </div>
    </details>
    <?php endif; ?>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.farmer-dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Mannalon_App\resources\views\farmer\information.blade.php ENDPATH**/ ?>