

<?php $__env->startSection('title', 'Farmer Details'); ?>

<?php $__env->startSection('content'); ?>
<div class="card">
    <a href="<?php echo e(route('admin.farmers.index')); ?>" style="color: #2ecc71; text-decoration: none;">← Back to Farmers</a>
    <h2 style="margin-top: 1rem;"><?php echo e($farmer->name); ?></h2>
    <p><strong>Farmer ID:</strong> #<?php echo e($farmer->id); ?></p>
    <p><strong>Date Registered:</strong> <?php echo e(optional($farmer->created_at)->format('M d, Y h:i A')); ?></p>
    <p><strong>Status:</strong> <?php echo e(ucfirst($farmer->profile_status ?? 'active')); ?></p>
</div>

<div class="card">
    <h2 style="margin-bottom: 1rem;">Update Farmer Information</h2>

    <?php if($errors->any()): ?>
        <div style="background: #fef2f2; border: 1px solid #fecaca; color: #991b1b; padding: 0.75rem; border-radius: 0.5rem; margin-bottom: 1rem;">
            <strong>Please fix these errors:</strong>
            <ul style="margin: 0.5rem 0 0 1.2rem;">
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>

    <form method="POST" action="<?php echo e(route('admin.farmers.update', $farmer)); ?>" enctype="multipart/form-data" style="display: grid; gap: 1rem;" data-category-form="headings">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>

        <h3>1. Personal Information</h3>
        <div style="display:grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 0.75rem;">
            <input type="text" name="first_name" value="<?php echo e(old('first_name', $farmer->first_name)); ?>" placeholder="First Name" required>
            <input type="text" name="middle_name" value="<?php echo e(old('middle_name', $farmer->middle_name)); ?>" placeholder="Middle Name">
            <input type="text" name="last_name" value="<?php echo e(old('last_name', $farmer->last_name)); ?>" placeholder="Last Name" required>
            <select name="gender">
                <option value="">Gender</option>
                <option value="male" <?php if(old('gender', $farmer->gender) === 'male'): echo 'selected'; endif; ?>>Male</option>
                <option value="female" <?php if(old('gender', $farmer->gender) === 'female'): echo 'selected'; endif; ?>>Female</option>
                <option value="other" <?php if(old('gender', $farmer->gender) === 'other'): echo 'selected'; endif; ?>>Other</option>
            </select>
            <input type="date" name="date_of_birth" value="<?php echo e(old('date_of_birth', optional($farmer->date_of_birth)->format('Y-m-d'))); ?>">
            <input type="number" min="1" max="120" name="age" value="<?php echo e(old('age', $farmer->age)); ?>" placeholder="Age">
            <select name="civil_status">
                <option value="">Civil Status</option>
                <option value="single" <?php if(old('civil_status', $farmer->civil_status) === 'single'): echo 'selected'; endif; ?>>Single</option>
                <option value="married" <?php if(old('civil_status', $farmer->civil_status) === 'married'): echo 'selected'; endif; ?>>Married</option>
                <option value="divorced" <?php if(old('civil_status', $farmer->civil_status) === 'divorced'): echo 'selected'; endif; ?>>Divorced</option>
                <option value="widowed" <?php if(old('civil_status', $farmer->civil_status) === 'widowed'): echo 'selected'; endif; ?>>Widowed</option>
                <option value="separated" <?php if(old('civil_status', $farmer->civil_status) === 'separated'): echo 'selected'; endif; ?>>Separated</option>
            </select>
            <input type="text" name="phone" value="<?php echo e(old('phone', $farmer->phone)); ?>" placeholder="Contact Number">
            <input type="email" name="email" value="<?php echo e(old('email', $farmer->email)); ?>" placeholder="Email Address">
            <input type="text" name="government_id_type" value="<?php echo e(old('government_id_type', $farmer->government_id_type)); ?>" placeholder="Government ID Type">
            <input type="text" name="government_id_number" value="<?php echo e(old('government_id_number', $farmer->government_id_number)); ?>" placeholder="Government ID Number">
        </div>

        <h3>2. Address Information</h3>
        <div style="display:grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 0.75rem;">
            <input type="text" name="region" value="<?php echo e(old('region', $farmer->region)); ?>" placeholder="Region">
            <input type="text" name="province" value="<?php echo e(old('province', $farmer->province)); ?>" placeholder="Province">
            <input type="text" name="municipality_city" value="<?php echo e(old('municipality_city', $farmer->municipality_city)); ?>" placeholder="Municipality/City">
            <input type="text" name="barangay" value="<?php echo e(old('barangay', $farmer->barangay)); ?>" placeholder="Barangay">
            <input type="text" name="sitio_purok" value="<?php echo e(old('sitio_purok', $farmer->sitio_purok)); ?>" placeholder="Sitio/Purok">
        </div>

        <h3>3. Farming Profile</h3>
        <div style="display:grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 0.75rem;">
            <select name="farmer_type">
                <option value="">Type of Farmer</option>
                <option value="owner" <?php if(old('farmer_type', $farmer->farmer_type) === 'owner'): echo 'selected'; endif; ?>>Owner</option>
                <option value="tenant" <?php if(old('farmer_type', $farmer->farmer_type) === 'tenant'): echo 'selected'; endif; ?>>Tenant</option>
                <option value="farm_worker" <?php if(old('farmer_type', $farmer->farmer_type) === 'farm_worker'): echo 'selected'; endif; ?>>Farm Worker</option>
            </select>
            <input type="number" min="0" max="80" name="years_in_farming" value="<?php echo e(old('years_in_farming', $farmer->years_in_farming)); ?>" placeholder="Years in Farming">
            <input type="text" name="primary_occupation" value="<?php echo e(old('primary_occupation', $farmer->primary_occupation)); ?>" placeholder="Primary Occupation">
            <input type="text" name="secondary_occupation" value="<?php echo e(old('secondary_occupation', $farmer->secondary_occupation)); ?>" placeholder="Secondary Occupation">
            <label><input type="checkbox" name="is_association_member" value="1" <?php if(old('is_association_member', $farmer->is_association_member)): echo 'checked'; endif; ?>> Association Member</label>
            <input type="text" name="association_name" value="<?php echo e(old('association_name', $farmer->association_name)); ?>" placeholder="Association/Cooperative">
        </div>

        <h3>4. Farm Information</h3>
        <div style="display:grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 0.75rem;">
            <input type="text" name="farm_location" value="<?php echo e(old('farm_location', $farmer->farm_location)); ?>" placeholder="Farm Location">
            <input type="number" step="0.01" min="0" name="farm_size_hectares" value="<?php echo e(old('farm_size_hectares', $farmer->farm_size_hectares)); ?>" placeholder="Farm Size (hectares)">
            <select name="land_ownership_type">
                <option value="">Land Ownership</option>
                <option value="owned" <?php if(old('land_ownership_type', $farmer->land_ownership_type) === 'owned'): echo 'selected'; endif; ?>>Owned</option>
                <option value="leased" <?php if(old('land_ownership_type', $farmer->land_ownership_type) === 'leased'): echo 'selected'; endif; ?>>Leased</option>
                <option value="shared" <?php if(old('land_ownership_type', $farmer->land_ownership_type) === 'shared'): echo 'selected'; endif; ?>>Shared</option>
            </select>
            <input type="number" min="0" name="number_of_parcels" value="<?php echo e(old('number_of_parcels', $farmer->number_of_parcels)); ?>" placeholder="Number of Parcels">
            <input type="number" step="0.00000001" name="gps_latitude" value="<?php echo e(old('gps_latitude', $farmer->gps_latitude)); ?>" placeholder="Farm GPS Latitude">
            <input type="number" step="0.00000001" name="gps_longitude" value="<?php echo e(old('gps_longitude', $farmer->gps_longitude)); ?>" placeholder="Farm GPS Longitude">
        </div>
        <div style="margin-top: 0.75rem;">
            <p style="font-weight: 600; margin-bottom: 0.5rem;">Farm Land Boundary Points</p>
            <input type="hidden" id="land_boundary_points" name="land_boundary_points" value="<?php echo e(old('land_boundary_points', json_encode($farmer->land_boundary_points ?? []))); ?>">
            <div style="display:flex; flex-wrap: wrap; gap: 0.5rem; margin-bottom: 0.5rem;">
                <button type="button" id="boundary-undo" style="background:#f59e0b;">Undo Last Point</button>
                <button type="button" id="boundary-clear" style="background:#4b5563;">Clear Points</button>
                <span id="boundary-count" style="align-self:center; font-size:0.85rem; color:#4b5563;">0 points</span>
            </div>
            <div id="farmer-boundary-map" style="height: 460px; border:1px solid #ddd; border-radius: 6px;"></div>
        </div>

        <h3>5. Crop / Livestock Information</h3>
        <textarea name="crop_types" rows="2" placeholder="Crop types"><?php echo e(old('crop_types', $farmer->crop_types)); ?></textarea>
        <textarea name="crop_area_per_type" rows="2" placeholder="Area per crop"><?php echo e(old('crop_area_per_type', $farmer->crop_area_per_type)); ?></textarea>
        <div style="display:grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 0.75rem;">
            <select name="cropping_season">
                <option value="">Cropping Season</option>
                <option value="wet" <?php if(old('cropping_season', $farmer->cropping_season) === 'wet'): echo 'selected'; endif; ?>>Wet</option>
                <option value="dry" <?php if(old('cropping_season', $farmer->cropping_season) === 'dry'): echo 'selected'; endif; ?>>Dry</option>
                <option value="wet_dry" <?php if(old('cropping_season', $farmer->cropping_season) === 'wet_dry'): echo 'selected'; endif; ?>>Wet/Dry</option>
            </select>
            <input type="text" name="yield_per_harvest" value="<?php echo e(old('yield_per_harvest', $farmer->yield_per_harvest)); ?>" placeholder="Yield per harvest">
            <input type="text" name="livestock_types" value="<?php echo e(old('livestock_types', $farmer->livestock_types)); ?>" placeholder="Livestock types">
            <input type="number" min="0" name="livestock_count" value="<?php echo e(old('livestock_count', $farmer->livestock_count)); ?>" placeholder="Number of animals">
        </div>

        <h3>6. Farming Resources & Equipment</h3>
        <textarea name="farm_equipment" rows="2" placeholder="Farm Equipment"><?php echo e(old('farm_equipment', $farmer->farm_equipment)); ?></textarea>
        <div style="display:grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 0.75rem;">
            <select name="irrigation_type">
                <option value="">Irrigation Type</option>
                <option value="rainfed" <?php if(old('irrigation_type', $farmer->irrigation_type) === 'rainfed'): echo 'selected'; endif; ?>>Rainfed</option>
                <option value="irrigated" <?php if(old('irrigation_type', $farmer->irrigation_type) === 'irrigated'): echo 'selected'; endif; ?>>Irrigated</option>
                <option value="mixed" <?php if(old('irrigation_type', $farmer->irrigation_type) === 'mixed'): echo 'selected'; endif; ?>>Mixed</option>
            </select>
            <input type="text" name="water_source" value="<?php echo e(old('water_source', $farmer->water_source)); ?>" placeholder="Source of Water">
            <select name="fertilizer_usage">
                <option value="">Fertilizer Usage</option>
                <option value="organic" <?php if(old('fertilizer_usage', $farmer->fertilizer_usage) === 'organic'): echo 'selected'; endif; ?>>Organic</option>
                <option value="inorganic" <?php if(old('fertilizer_usage', $farmer->fertilizer_usage) === 'inorganic'): echo 'selected'; endif; ?>>Inorganic</option>
                <option value="mixed" <?php if(old('fertilizer_usage', $farmer->fertilizer_usage) === 'mixed'): echo 'selected'; endif; ?>>Mixed</option>
            </select>
        </div>
        <textarea name="pesticide_usage" rows="2" placeholder="Pesticide Usage"><?php echo e(old('pesticide_usage', $farmer->pesticide_usage)); ?></textarea>

        <h3>7. Financial Information</h3>
        <div style="display:grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 0.75rem;">
            <input type="number" step="0.01" min="0" name="average_monthly_income" value="<?php echo e(old('average_monthly_income', $farmer->average_monthly_income)); ?>" placeholder="Average Monthly Income">
            <input type="number" step="0.01" min="0" name="average_annual_income" value="<?php echo e(old('average_annual_income', $farmer->average_annual_income)); ?>" placeholder="Average Annual Income">
            <select name="income_source">
                <option value="">Income Source</option>
                <option value="farm" <?php if(old('income_source', $farmer->income_source) === 'farm'): echo 'selected'; endif; ?>>Farm</option>
                <option value="non_farm" <?php if(old('income_source', $farmer->income_source) === 'non_farm'): echo 'selected'; endif; ?>>Non-Farm</option>
                <option value="both" <?php if(old('income_source', $farmer->income_source) === 'both'): echo 'selected'; endif; ?>>Both</option>
            </select>
            <label><input type="checkbox" name="has_credit_access" value="1" <?php if(old('has_credit_access', $farmer->has_credit_access)): echo 'checked'; endif; ?>> Access to Credit/Loans</label>
            <input type="text" name="insurance_coverage" value="<?php echo e(old('insurance_coverage', $farmer->insurance_coverage)); ?>" placeholder="Insurance Coverage">
        </div>

        <h3>8. Government Program Participation</h3>
        <div style="display:grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 0.75rem;">
            <label><input type="checkbox" name="is_rsbsa_registered" value="1" <?php if(old('is_rsbsa_registered', $farmer->is_rsbsa_registered)): echo 'checked'; endif; ?>> Registered in RSBSA</label>
            <input type="date" name="program_registration_date" value="<?php echo e(old('program_registration_date', optional($farmer->program_registration_date)->format('Y-m-d'))); ?>">
        </div>
        <textarea name="programs_availed" rows="2" placeholder="Programs availed"><?php echo e(old('programs_availed', $farmer->programs_availed)); ?></textarea>

        <h3>9. Documents & Attachments</h3>
        <div style="display:grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 0.75rem;">
            <div>
                <label>Valid ID</label>
                <input type="file" name="valid_id" accept=".jpg,.jpeg,.png,.pdf">
                <?php if($farmer->valid_id_path): ?>
                    <p><a href="<?php echo e(asset('storage/' . $farmer->valid_id_path)); ?>" target="_blank">Current file</a></p>
                <?php endif; ?>
            </div>
            <div>
                <label>Land Title / Lease Agreement</label>
                <input type="file" name="land_document" accept=".jpg,.jpeg,.png,.pdf">
                <?php if($farmer->land_document_path): ?>
                    <p><a href="<?php echo e(asset('storage/' . $farmer->land_document_path)); ?>" target="_blank">Current file</a></p>
                <?php endif; ?>
            </div>
            <div>
                <label>Farm Photo</label>
                <input type="file" name="farm_photo" accept=".jpg,.jpeg,.png,.pdf">
                <?php if($farmer->farm_photos_path): ?>
                    <p><a href="<?php echo e(asset('storage/' . $farmer->farm_photos_path)); ?>" target="_blank">Current file</a></p>
                <?php endif; ?>
            </div>
            <div>
                <label>Barangay Certification</label>
                <input type="file" name="barangay_certification" accept=".jpg,.jpeg,.png,.pdf">
                <?php if($farmer->barangay_certification_path): ?>
                    <p><a href="<?php echo e(asset('storage/' . $farmer->barangay_certification_path)); ?>" target="_blank">Current file</a></p>
                <?php endif; ?>
            </div>
        </div>

        <h3>10. System Information</h3>
        <div style="display:grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 0.75rem;">
            <select name="profile_status">
                <option value="active" <?php if(old('profile_status', $farmer->profile_status) === 'active'): echo 'selected'; endif; ?>>Active</option>
                <option value="inactive" <?php if(old('profile_status', $farmer->profile_status) === 'inactive'): echo 'selected'; endif; ?>>Inactive</option>
                <option value="verified" <?php if(old('profile_status', $farmer->profile_status) === 'verified'): echo 'selected'; endif; ?>>Verified</option>
            </select>
            <input type="text" value="<?php echo e(optional($farmer->created_at)->format('M d, Y h:i A')); ?>" disabled>
        </div>

        <button type="submit" style="padding: 0.65rem 1rem; background: #2ecc71; color: #fff; border: 0; border-radius: 6px; cursor: pointer;">Save Updates</button>
    </form>
</div>

<div class="card">
    <h2>Crops (<?php echo e($crops->count()); ?>)</h2>
    <?php if($crops->count() > 0): ?>
        <table>
            <thead>
                <tr>
                    <th>Crop Name</th>
                    <th>Area</th>
                    <th>Status</th>
                    <th>Planting Date</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $crops; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $crop): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($crop->name); ?></td>
                        <td><?php echo e($crop->area); ?></td>
                        <td><?php echo e($crop->status); ?></td>
                        <td><?php echo e($crop->planting_date->format('M d, Y')); ?></td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No crops recorded</p>
    <?php endif; ?>
</div>

<div class="card">
    <h2>Livestock (<?php echo e($livestock->count()); ?>)</h2>
    <?php if($livestock->count() > 0): ?>
        <table>
            <thead>
                <tr>
                    <th>Type</th>
                    <th>Count</th>
                    <th>Health Status</th>
                    <th>Last Checkup</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $livestock; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $animal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($animal->type); ?></td>
                        <td><?php echo e($animal->count); ?></td>
                        <td><?php echo e($animal->health_status); ?></td>
                        <td><?php echo e($animal->last_checkup ? $animal->last_checkup->format('M d, Y') : 'N/A'); ?></td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No livestock recorded</p>
    <?php endif; ?>
</div>

<script>
(() => {
    const form = document.querySelector('form[data-category-form="headings"]');
    if (!form) {
        return;
    }

    function getCategoryElements(headerRow) {
        const elements = [];
        let current = headerRow.nextElementSibling;
        while (current && !current.dataset.categoryHeaderRow) {
            elements.push(current);
            current = current.nextElementSibling;
        }
        return elements;
    }

    function resetCategory(elements) {
        elements.forEach((element) => {
            const controls = element.querySelectorAll('input, select, textarea');
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

            const boundaryHidden = element.querySelector('#land_boundary_points');
            const boundaryClearBtn = element.querySelector('#boundary-clear');
            if (boundaryHidden) {
                boundaryHidden.value = '[]';
            }
            if (boundaryClearBtn) {
                boundaryClearBtn.click();
            }
        });
    }

    const headings = Array.from(form.querySelectorAll('h3'));
    headings.forEach((heading) => {
        const headerRow = document.createElement('div');
        headerRow.dataset.categoryHeaderRow = '1';
        headerRow.style.display = 'flex';
        headerRow.style.alignItems = 'center';
        headerRow.style.justifyContent = 'space-between';
        headerRow.style.gap = '0.75rem';

        heading.parentNode.insertBefore(headerRow, heading);
        headerRow.appendChild(heading);

        const answerAgainBtn = document.createElement('button');
        answerAgainBtn.type = 'button';
        answerAgainBtn.textContent = 'Answer Again';
        answerAgainBtn.style.padding = '0.35rem 0.6rem';
        answerAgainBtn.style.background = '#0284c7';
        answerAgainBtn.style.color = '#fff';
        answerAgainBtn.style.border = '0';
        answerAgainBtn.style.borderRadius = '6px';
        answerAgainBtn.style.cursor = 'pointer';
        answerAgainBtn.style.fontSize = '0.75rem';
        answerAgainBtn.addEventListener('click', () => {
            resetCategory(getCategoryElements(headerRow));
        });
        headerRow.appendChild(answerAgainBtn);
    });
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

                const fallbackLat = parseFloat(latInput.value) || 17.6135;
                const fallbackLng = parseFloat(lngInput.value) || 121.7269;
                const map = L.map(mapEl).setView([fallbackLat, fallbackLng], 14);

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
                L.control.layers(baseLayers, null, { collapsed: false }).addTo(map);

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
                        polygon = L.polygon(points.map(p => [p.lat, p.lng]), { color: '#16a34a', weight: 2, fillOpacity: 0.2 }).addTo(map);
                    } else if (points.length >= 2) {
                        polygon = L.polyline(points.map(p => [p.lat, p.lng]), { color: '#16a34a', weight: 2 }).addTo(map);
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

            const fallbackLat = parseFloat(latInput.value) || 17.6135;
            const fallbackLng = parseFloat(lngInput.value) || 121.7269;

            const map = new google.maps.Map(mapEl, {
                center: { lat: fallbackLat, lng: fallbackLng },
                zoom: 14,
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
                        strokeColor: '#16a34a',
                        strokeOpacity: 1,
                        strokeWeight: 2,
                        fillColor: '#16a34a',
                        fillOpacity: 0.2,
                        map,
                    });
                } else if (points.length >= 2) {
                    polygon = new google.maps.Polyline({
                        path: points,
                        strokeColor: '#16a34a',
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Mannalon_App\resources\views\admin\farmers\show.blade.php ENDPATH**/ ?>