# Address Dependent Dropdown - Testing Guide

## How to Test the Implementation

### 1. Access the Farmer Registration Form
1. Log in as an admin
2. Navigate to **Admin Dashboard → Farmers** or go to `/admin/farmers`
3. Click on the form to add a new farmer

### 2. Test the Dependent Dropdowns

#### Step 1: Select a Region
- Click on the "Region" dropdown
- Select any Philippine region (e.g., "Ilocos Region", "Central Visayas")
- **Expected**: The "Province" dropdown should become enabled and populate with provinces for that region

#### Step 2: Select a Province
- Click on the "Province" dropdown
- Select a province (e.g., "Iloilo" under Central Visayas)
- **Expected**: The "Municipality/City" dropdown should become enabled and show municipalities for that province

#### Step 3: Select Municipality/City
- Click on the "Municipality/City" dropdown
- Select a municipality (e.g., "Iloilo City")
- **Expected**: The "Barangay" dropdown should become enabled and show barangays for that municipality

#### Step 4: Select Barangay
- Click on the "Barangay" dropdown
- Select a barangay (e.g., "Arevalo (Proper)")
- **Expected**: The "Sitio/Purok" dropdown should become enabled and show sitios for that barangay

#### Step 5: Select Sitio/Purok
- Click on the "Sitio/Purok" dropdown
- Select a sitio (e.g., "Sitio Poblacion")
- **Expected**: The form should save the selection

### 3. Test Form Submission
1. Fill out all required fields
2. Complete the address selection as described above
3. Click "Save Farmer"
4. **Expected**: The form should submit successfully with the selected location values

### 4. Test Edit/Update Form
1. Open an existing farmer record
2. Navigate to the address section
3. **Expected**: All dropdowns should be pre-populated with previously selected values
4. Try changing the region:
   - **Expected**: Provinces should update, and dependent fields should reset

### 5. Verify Form Validation
1. Try submitting without selecting all address fields
2. **Expected**: Validation should pass (all address fields are optional based on current validation)
3. If you want to make fields required, update the validation in AdminController

## Current Sample Data Available

### Regions
- National Capital Region (NCR)
- Cordillera Administrative Region (CAR)
- Ilocos Region (I)
- Cagayan Valley (II)
- Central Luzon (III)
- CALABARZON (IV-A)
- Mimaropa (IV-B)
- Bicol Region (V)
- Western Visayas (VI)
- Central Visayas (VII)
- Eastern Visayas (VIII)
- Zamboanga Peninsula (IX)
- Northern Mindanao (X)
- Davao Region (XI)
- Soccsksargen (XII)
- Caraga (XIII)
- BARMM

### Provinces with Sample Municipalities
Currently configured with sample data for testing. For production use, integrate a complete database.

## Notes for Production Use

⚠️ **Important**: The current implementation uses hardcoded sample data for municipalities and barangays. For production deployment:

1. **Integrate Complete Database**: Load actual municipalities and barangays from a proper database
2. **Data Source Options**:
   - Use PSGC (Philippine Standard Geographic Code) database
   - Import from Philippine Statistics Authority
   - Use a pre-built municipality database package
3. **Performance**: Consider caching location data to improve API response times
4. **Validation**: Update server-side validation to ensure only valid location codes are accepted

## Troubleshooting

### Dropdowns not changing
- Check browser console for JavaScript errors
- Verify routes are registered: `php artisan route:list | grep locations`
- Verify the API endpoints return valid JSON

### API returning 422 error
- This means required query parameters are missing
- Ensure the dependent dropdown JavaScript is loading correctly

### Data not saving
- Check if address field values are being submitted
- Verify form validation is not rejecting the values
- Check database column sizes match the data being saved

## Files Changed
- ✅ `app/Services/PhilippineLocationService.php` (created)
- ✅ `app/Http/Controllers/AdminController.php` (5 new methods)
- ✅ `routes/web.php` (5 new routes)
- ✅ `resources/views/admin/farmers-content.blade.php` (updated form + JavaScript)
