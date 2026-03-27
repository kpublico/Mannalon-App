# Announcement System - Complete Implementation Guide

## Overview
The Announcement System has been fully integrated and made functional to connect Administrators with Farmers through targeted announcements and weather alerts.

## What Was Fixed

### 1. **Model Relationships** ✅
- **FarmerProfile Model**: Added relationship to FarmerGroup
  - Farmers now belong to groups
  - Each farmer can receive group-specific announcements

- **Announcement Model**: Enhanced with targeting capabilities
  - Relationships to admin (posted_by)
  - Relationship to target group

- **FarmerGroup Model**: Already had relationships set up
  - Many FarmerProfiles
  - Many Announcements

### 2. **Admin Controller Updates** ✅
The announcement management system now supports:
- **Audience Scope Selection**:
  - `all` - Send to all farmers
  - `specific_group` - Send to a specific farmer group

- **Group Targeting**: Admins can select which group receives the announcement

- **Publishing Control**:
  - Publish immediately via checkbox
  - Schedule start/end dates
  - Set expiry dates

- **Validation**: Ensures target group is selected when audience scope is "specific_group"

### 3. **Dashboard Controller Updates** ✅
Farmers now see only relevant announcements based on:
- Their assigned farmer group
- Publication status (must be published)
- Active date range (between starts_at and ends_at)
- Not expired (before expiry_date)

**Filtering Logic**:
```php
// Show announcements that are:
// 1. For all farmers (audience_scope = 'all'), OR
// 2. Specifically for this farmer's group (audience_scope = 'specific_group' AND target_group_id matches)
// AND
// 3. Published (is_published = true)
// AND  
// 4. Within active date range (starts_at <= now <= ends_at)
// AND
// 5. Not expired (expiry_date >= today)
```

### 4. **Admin Views Updated** ✅
- **Create Announcement Form**:
  - Basic info (title, content, category)
  - Target Audience section:
    - Audience scope selector
    - Conditional group dropdown (shows only when "Specific Group" is selected)
  - Publishing Options section:
    - Publish immediately checkbox
    - Start/end date/time pickers
    - Expiry date picker

- **Edit Announcement Form**:
  - Same as create form
  - Pre-populated with existing values

### 5. **Database Fields** ✅
All required fields exist in the announcements table:
- `audience_scope` (enum): 'all', 'specific_group'
- `target_group_id` (foreign key): References farmer_groups
- `is_published` (boolean): Publication status
- `starts_at` (datetime): When announcement becomes active
- `ends_at` (datetime): When announcement expires
- `expiry_date` (date): Final expiry date

## How It Works

### **For Administrators**:
1. Navigate to Admin Dashboard → Announcements → Create New
2. Fill in announcement details:
   - Title
   - Content
   - Category (General, Alert, Weather)
3. Choose audience scope:
   - **All Farmers**: Everyone sees it
   - **Specific Group**: Only farmers in that group see it
4. Set publishing options:
   - Check "Publish Immediately" to go live now
   - Or set Start/End dates to schedule
   - Set Expiry Date when announcement should stop showing
5. Click "Create Announcement"

### **For Farmers**:
1. Log in to farmer dashboard
2. Navigate to:
   - **Announcements**: View all announcements for their group
   - **Weather**: View weather and alert announcements
3. Use filters:
   - Filter by category
   - Search by keyword

## Key Features

### **Announcement Targeting**
- ✅ Administrators can target specific farmer groups
- ✅ Farmers see only announcements relevant to them
- ✅ Global announcements still visible to everyone

### **Scheduling**
- ✅ Schedule announcements to go live in the future
- ✅ Set end dates for time-limited announcements
- ✅ Set expiry dates to automatically hide old announcements

### **Publication Control**
- ✅ Draft announcements (uncheck "Publish Immediately")
- ✅ Publish when ready
- ✅ Automatic activation based on date ranges

### **Categories**
- General: Regular information
- Alert: Important urgent information
- Weather: Weather-related advisories

## Database Changes

### Migrations Applied
- Migration `2026_03_25_000107_update_announcements_for_targeting` adds:
  - `audience_scope` column
  - `target_group_id` column  
  - `is_published` column
  - `starts_at` column
  - `ends_at` column
  - Composite index on (audience_scope, is_published)

## Testing the System

### Test Case 1: Create Global Announcement
1. As Admin:
   - Create announcement with "All Farmers" scope
   - Publish immediately
   - Title: "Fertilizer Subsidy Available"

2. As Farmer (any group):
   - Check Announcements page
   - Should see the announcement

### Test Case 2: Create Group-Specific Announcement
1. As Admin:
   - Create announcement with "Specific Group" scope
   - Select "Region A Farmers" group
   - Publish immediately
   - Title: "Rice Planting Guide for Region A"

2. As Farmer in "Region A Farmers":
   - Check Announcements page
   - Should see the announcement

3. As Farmer in "Region B Farmers":
   - Check Announcements page
   - Should NOT see the announcement

### Test Case 3: Scheduled Announcement
1. As Admin:
   - Create announcement
   - Uncheck "Publish Immediately"
   - Set Start Date: Tomorrow at 9:00 AM
   - Publish immediately (checkbox unchecked means it won't show until start date)

2. As Farmer:
   - Check Announcements page immediately
   - Should NOT see the announcement yet
   
3. As Farmer (after start date):
   - Should see the announcement

## Files Modified

### Controllers
- `app/Http/Controllers/AdminController.php`
  - announcementsCreate()
  - announcementsStore()
  - announcementsEdit()
  - announcementsUpdate()

- `app/Http/Controllers/DashboardController.php`
  - farmerAnnouncements()
  - farmerWeather()

### Models
- `app/Models/FarmerProfile.php`
  - Added farmer_group_id to fillable
  - Added farmerGroup() relationship

- `app/Models/Announcement.php` (unchanged, already correct)
- `app/Models/FarmerGroup.php` (unchanged, already correct)
- `app/Models/User.php` (verified relationships are correct)

### Views
- `resources/views/admin/announcements/create.blade.php`
  - Completely revised with new fields
  
- `resources/views/admin/announcements/edit.blade.php`
  - Completely revised with new fields

### Database
- `database/migrations/2026_03_25_000107_update_announcements_for_targeting.php`
  - Updated migration to use correct enum values

## Troubleshooting

### Farmers not seeing any announcements
1. Check if announcements are published (`is_published = true`)
2. Check if current time is within start/end date range
3. Check if farmer belongs to a group (check farmer_group_id in farmer_profiles)
4. Check announcement.audience_scope - if "specific_group", verify target_group_id matches farmer's group

### Announcement not showing for specific group
1. Verify audience_scope is set to "specific_group"
2. Verify target_group_id is set
3. Verify farmer's farmer_group_id matches the target_group_id

### Farmers seeing announcements meant for another group
1. Check farmer's farmer_group_id assignment
2. Verify announcement doesn't have audience_scope = 'all'

## Future Enhancements
- [ ] Read/Unread tracking for announcements
- [ ] Delivery receipts
- [ ] Farmer engagement notifications
- [ ] Announcement priority levels
- [ ] Multiple group targeting in single announcement
- [ ] Announcement templates
- [ ] Bulk announcement scheduling

## API Integration
When building mobile or external apps, use these endpoints:
- GET `/api/announcements` - List announcements for logged-in farmer
- GET `/api/announcements/{id}` - Get single announcement
- (Admin) POST `/api/announcements` - Create announcement
- (Admin) PUT `/api/announcements/{id}` - Update announcement
- (Admin) DELETE `/api/announcements/{id}` - Delete announcement
