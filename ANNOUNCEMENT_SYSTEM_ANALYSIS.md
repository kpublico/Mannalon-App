# Announcement System - Complete Analysis

## WHAT EXISTS ✓

### 1. **Announcement Model** ([app/Models/Announcement.php](app/Models/Announcement.php))
```php
protected $fillable = [
    'title',
    'category',           // Alert, General, Weather
    'content',
    'audience_scope',     // all, admins, farmers, group
    'target_group_id',    // FK to farmer_groups
    'is_published',       // boolean
    'starts_at',          // datetime
    'ends_at',            // datetime
    'expiry_date',        // date
    'posted_by',          // FK to users (admin)
];
```

**Relationships:**
- `admin()` → belongsTo(User::class, 'posted_by')
- `targetGroup()` → belongsTo(FarmerGroup::class, 'target_group_id')

---

### 2. **Farmer Models** 
Two farmer models exist:

#### **a) Farmer Model** ([app/Models/Farmer.php](app/Models/Farmer.php))
- Legacy/basic farmer model with extensive fields
- Related fields: user_id, name, email, phone, location, etc.
- **Relationships:**
  - `user()` → belongsTo(User::class)
  - `farmDetail()` → hasOne(FarmDetail::class)
  - `beneficiaries()` → hasMany(Beneficiary::class)
  - `serviceAccessLogs()` → hasMany(ServiceAccessLog::class)
  - `modernProfile()` → hasOne(FarmerProfile::class, 'legacy_farmer_id')

#### **b) FarmerProfile Model** ([app/Models/FarmerProfile.php](app/Models/FarmerProfile.php))
- Modern farmer profile model
- **Relationships:**
  - `user()` → belongsTo(User::class)
  - `addresses()` → hasMany(FarmerAddress::class)
  - `farmingProfile()` → hasOne(FarmingProfile::class)
  - `farmRecords()` → hasMany(FarmRecord::class)
  - `financialRecords()` → hasMany(FarmerFinancialRecord::class)
  - `creditRecords()` → hasMany(FarmerCreditRecord::class)

#### **c) FarmerGroup Model** ([app/Models/FarmerGroup.php](app/Models/FarmerGroup.php))
```php
public function admin() { return $this->belongsTo(User::class, 'admin_user_id'); }
public function farmerProfiles() { return $this->hasMany(FarmerProfile::class, 'farmer_group_id'); }
public function announcements() { return $this->hasMany(Announcement::class, 'target_group_id'); }
```

---

### 3. **Database Migrations**

#### **Create Table Migration** 
[database/migrations/2026_03_24_000005_create_announcements_table.php](database/migrations/2026_03_24_000005_create_announcements_table.php)
- id, title, category (enum), content, expiry_date, posted_by (FK), timestamps
- Indexes on category and created_at

#### **Update Migration** 
[database/migrations/2026_03_25_000107_update_announcements_for_targeting.php](database/migrations/2026_03_25_000107_update_announcements_for_targeting.php)
- Added: audience_scope (enum), target_group_id (FK), is_published, starts_at, ends_at
- Adds composite index on audience_scope and is_published

#### **FarmerProfile Migration** 
[database/migrations/2026_03_25_000105_create_farmer_profiles_table.php](database/migrations/2026_03_25_000105_create_farmer_profiles_table.php)
- includes farmer_group_id (FK to farmer_groups)
- Links FarmerProfile to FarmerGroup

---

### 4. **Controllers**

#### **AdminController** ([app/Http/Controllers/AdminController.php](app/Http/Controllers/AdminController.php))
**Announcement Management Methods:**
- `announcementsIndex()` - List announcements with search/filter
- `announcementsCreate()` - Show create form
- `announcementsStore()` - Save new announcement
- `announcementsEdit()` - Show edit form
- `announcementsUpdate()` - Update announcement
- `announcementsDestroy()` - Delete announcement

**Note:** Current validation only includes title, category, expiry_date, content.
Does NOT validate audience_scope, target_group_id, or publishing fields.

#### **DashboardController** ([app/Http/Controllers/DashboardController.php](app/Http/Controllers/DashboardController.php))
**Farmer-Facing Methods:**
- `farmerHome()` - Shows count of announcements not expired
- `farmerAnnouncements()` - List announcements (filters by category/search, respects expiry_date)
- `farmerWeather()` - Shows weather/alert announcements
- `farmerMarketPrices()` - Related functionality

**Note:** Shows ALL announcements to ALL farmers. No group-based filtering implemented.

---

### 5. **Routes** ([routes/web.php](routes/web.php))

**Admin Routes:**
```
GET  /admin/announcements                    → announcementsIndex
GET  /admin/announcements/create             → announcementsCreate
POST /admin/announcements                    → announcementsStore
GET  /admin/announcements/{id}/edit          → announcementsEdit
PUT  /admin/announcements/{id}               → announcementsUpdate
DELETE /admin/announcements/{id}             → announcementsDestroy
```

**Farmer Routes:**
```
GET /farmer/announcements → farmerAnnouncements (filtered list)
```

---

### 6. **Views**

#### **Admin View** 
[resources/views/admin/announcements-content.blade.php](resources/views/admin/announcements-content.blade.php)
- Admin list/management interface

#### **Farmer View** 
[resources/views/farmer/announcements.blade.php](resources/views/farmer/announcements.blade.php)
- Farmer-facing announcement list
- Filter by category (Alert, General, Weather)
- Search by title/content
- Color-coded by category (Red=Alert, Blue=Weather, Green=General)

---

### 7. **User Model** ([app/Models/User.php](app/Models/User.php))
**Relationships:**
- `farmerProfile()` → hasOne(Farmer::class)
- `farmerGroups()` → hasMany(FarmerGroup::class, 'admin_user_id')
- `farmerProfileV2()` → hasOne(FarmerProfile::class, 'user_id')

---

## WHAT'S MISSING ❌

### 1. **Direct Farmer-to-Announcement Relationship**
- Announcement model has no direct relationship to individual Farmer or FarmerProfile
- **Gap:** Cannot send targeted announcements to specific farmers, only to groups

### 2. **Pivot Table (Many-to-Many)**
- No `announcement_farmer` or `announcement_farmer_profile` table
- **Gap:** Cannot implement many-to-many relationship for flexible targeting

### 3. **Recipient Tracking**
- No table to track which farmer has received/read which announcement
- **Gap:** Cannot provide read receipts, reminder resends, or engagement metrics

### 4. **Complete Admin Announcement Form**
- Current admin form validation only includes: title, category, expiry_date, content
- **Missing Fields in Form:**
  - audience_scope selector
  - target_group_id selector (for group-specific announcements)
  - is_published toggle
  - starts_at / ends_at datetime pickers

### 5. **Group-Based Filtering in Farmer View**
- Farmer announcements show ALL announcements, regardless of farmer's group
- **Gap:** No logic to filter announcements based on farmer's assigned group(s)

### 6. **Announcement Display Logic**
- No scope for audience visibility (audience_scope field exists but not used)
- No status-based queries (published, scheduled, expired)

### 7. **API/Controller Methods**
- No dedicated AnnouncementController
- No methods to:
  - Get farmer's group-specific announcements
  - Mark announcement as read
  - Get announcement details page
  - Publish/unpublish announcements

### 8. **Announcement Recipients Model**
- No model to track announcement_id → farmer_profile_id or farmer_id mapping
- **Critical Gap:** Cannot implement selective distribution

---

## DATABASE SCHEMA

### announcements table (Current)
```
id (PK)
title (string)
category (enum: Alert, General, Weather)
content (text)
audience_scope (enum: all, admins, farmers, group)  ← NOT USED
target_group_id (FK to farmer_groups)              ← NOT USED
is_published (boolean)                              ← NOT USED
starts_at (datetime)                                ← NOT USED
ends_at (datetime)                                  ← NOT USED
expiry_date (date)
posted_by (FK to users)
created_at, updated_at
```

### farmer_groups table
```
id (PK)
admin_user_id (FK to users)
group_name
region, province, municipality, barangay
description
timestamps
```

### farmer_profiles table
```
id (PK)
user_id (FK to users, unique)
farmer_group_id (FK to farmer_groups)  ← Links farmer to group
... other fields ...
timestamps
```

---

## IMPLEMENTATION ROADMAP

### Phase 1: Enable Group-Based Targeting (Quick Win)
1. Update AdminController validation to include audience_scope and target_group_id
2. Update announcement views to include group selector and scope selector
3. Update DashboardController.farmerAnnouncements() to filter by farmer's group
4. Create view to display farmer's FarmerGroup relationship

### Phase 2: Recipient Tracking (Medium)
1. Create `AnnouncementRecipient` model with pivot table
2. Migration: Create announcement_recipients table (announcement_id, farmer_profile_id, read_at)
3. Add relationships to Announcement and FarmerProfile models
4. Update display logic to mark read/unread

### Phase 3: Advanced Features (Complex)
1. Create dedicated AnnouncementController
2. Add announcement scheduling (starts_at/ends_at)
3. Add announcement status (draft, scheduled, published, expired)
4. Implement read receipts and engagement tracking
5. Add bulk send logic by group/scope

---

## KEY FINDINGS

✓ **Working:** Admin can create announcements, farmers can view all announcements
✗ **Not Working:** Group-based targeting, individual recipient tracking, full publication workflow
✗ **Not Used:** audience_scope, target_group_id, is_published, starts_at, ends_at fields
✗ **Gap:** No way to filter announcements by farmer's assigned group

---

## RECOMMENDED NEXT STEPS

1. **Immediate:** Update AdminController form validation to support audience_scope targeting
2. **Next:** Modify FarmerProfile to ensure farmer_group_id is set during registration
3. **Then:** Update DashboardController to filter announcements by farmer's group
4. **Later:** Implement recipient tracking for engagement metrics
