# Modular Architecture - Implementation Checklist

## Overview
This document provides a detailed todo list for fully implementing the modular architecture across the Mannalon application.

## Phase 1: ✅ COMPLETED - Directory Structure

- [x] Create `/app/Modules/` root directory
- [x] Create Auth module structure
- [x] Create Admin module structure
- [x] Create Farmer module structure
- [x] Create Farm module structure
- [x] Create Guide module structure
- [x] Create Messaging module structure
- [x] Create Market module structure
- [x] Create Announcement module structure
- [x] Create Notification module structure
- [x] Create Dashboard module structure
- [x] Create Shared module structure
- [x] Create module documentation files

## Phase 2: File Migration (To Do)

### Auth Module Files
- [ ] Copy `app/Http/Controllers/AuthController.php` → `app/Modules/Auth/Controllers/`
- [ ] Copy `app/Models/User.php` → `app/Modules/Auth/Models/`
- [ ] Copy `app/Models/Role.php` → `app/Modules/Auth/Models/`

### Admin Module Files
- [ ] Copy `app/Http/Controllers/AdminController.php` → `app/Modules/Admin/Controllers/`
- [ ] Copy `app/Http/Controllers/AdminLandManagementController.php` → `app/Modules/Admin/Controllers/`
- [ ] Copy `app/Models/AdminSupervisorAssignment.php` → `app/Modules/Admin/Models/`

### Farmer Module Files
- [ ] Copy `app/Models/Farmer.php` → `app/Modules/Farmer/Models/`
- [ ] Copy `app/Models/FarmerProfile.php` → `app/Modules/Farmer/Models/`
- [ ] Copy `app/Models/FarmerAddress.php` → `app/Modules/Farmer/Models/`
- [ ] Copy `app/Models/FarmerDocument.php` → `app/Modules/Farmer/Models/`
- [ ] Copy `app/Models/FarmerFinancialRecord.php` → `app/Modules/Farmer/Models/`
- [ ] Copy `app/Models/FarmerCreditRecord.php` → `app/Modules/Farmer/Models/`
- [ ] Copy `app/Models/FarmerInsuranceRecord.php` → `app/Modules/Farmer/Models/`
- [ ] Copy `app/Models/FarmerAuditLog.php` → `app/Modules/Farmer/Models/`
- [ ] Copy `app/Models/FarmerGroup.php` → `app/Modules/Farmer/Models/`
- [ ] Copy `app/Models/FarmingProfile.php` → `app/Modules/Farmer/Models/`

### Farm Module Files
- [ ] Copy `app/Models/Crop.php` → `app/Modules/Farm/Models/`
- [ ] Copy `app/Models/CropReport.php` → `app/Modules/Farm/Models/`
- [ ] Copy `app/Models/Livestock.php` → `app/Modules/Farm/Models/`
- [ ] Copy `app/Models/FarmDetail.php` → `app/Modules/Farm/Models/`
- [ ] Copy `app/Models/FarmEquipment.php` → `app/Modules/Farm/Models/`
- [ ] Copy `app/Models/FarmInput.php` → `app/Modules/Farm/Models/`
- [ ] Copy `app/Models/FarmParcel.php` → `app/Modules/Farm/Models/`
- [ ] Copy `app/Models/FarmRecord.php` → `app/Modules/Farm/Models/`
- [ ] Copy `app/Models/FarmWaterResource.php` → `app/Modules/Farm/Models/`

### Guide Module Files
- [ ] Copy `app/Models/FarmingGuide.php` → `app/Modules/Guide/Models/`

### Messaging Module Files
- [ ] Copy `app/Http/Controllers/ChatController.php` → `app/Modules/Messaging/Controllers/`
- [ ] Copy `app/Http/Controllers/MessagingController.php` → `app/Modules/Messaging/Controllers/`
- [ ] Copy `app/Models/Message.php` → `app/Modules/Messaging/Models/`
- [ ] Copy `app/Models/MessageRecipient.php` → `app/Modules/Messaging/Models/`
- [ ] Copy `app/Models/ConversationThread.php` → `app/Modules/Messaging/Models/`
- [ ] Copy `app/Models/ThreadParticipant.php` → `app/Modules/Messaging/Models/`

### Market Module Files
- [ ] Copy `app/Models/CommodityPrice.php` → `app/Modules/Market/Models/`

### Announcement Module Files
- [ ] Copy `app/Models/Announcement.php` → `app/Modules/Announcement/Models/`

### Notification Module Files
- [ ] Copy `app/Models/Notification.php` → `app/Modules/Notification/Models/`

### Dashboard Module Files
- [ ] Copy `app/Http/Controllers/DashboardController.php` → `app/Modules/Dashboard/Controllers/`

### Shared Module Files
- [ ] Copy `app/Models/CommunicationPermission.php` → `app/Modules/Shared/Models/`
- [ ] Copy `app/Models/Beneficiary.php` → `app/Modules/Shared/Models/`
- [ ] Copy `app/Models/GovernmentProgramParticipation.php` → `app/Modules/Shared/Models/`
- [ ] Copy `app/Models/ProgramBenefitAvailed.php` → `app/Modules/Shared/Models/`
- [ ] Copy `app/Models/ServiceAccessLog.php` → `app/Modules/Shared/Models/`
- [ ] Copy all from `app/Traits/` → `app/Modules/Shared/Traits/`

## Phase 3: Namespace Updates (To Do)

### Auth Module
- [ ] Update AuthController namespace to `App\Modules\Auth\Controllers`
- [ ] Update User namespace to `App\Modules\Auth\Models`
- [ ] Update Role namespace to `App\Modules\Auth\Models`
- [ ] Update all use statements in Auth module files

### Admin Module
- [ ] Update AdminController namespace
- [ ] Update AdminLandManagementController namespace
- [ ] Update AdminSupervisorAssignment namespace
- [ ] Update all use statements

### Farmer Module
- [ ] Update all Farmer* model namespaces
- [ ] Update all use statements
- [ ] Update model relationships

### Farm Module
- [ ] Update all Farm* model namespaces
- [ ] Update all relationships
- [ ] Update all use statements

### Messaging Module
- [ ] Update ChatController namespace
- [ ] Update MessagingController namespace
- [ ] Update Message* model namespaces
- [ ] Update all relationships

### Dashboard Module
- [ ] Update DashboardController namespace

### Shared Module
- [ ] Update all Shared model namespaces
- [ ] Update trait namespaces

### Global Replacements Needed
- [ ] Search and replace old model imports in all files
- [ ] Update route imports in `routes/web.php`
- [ ] Update provider service registrations

## Phase 4: Service Layer Creation (To Do)

### Auth Module
- [ ] Create `AuthService.php`
- [ ] Create `TokenService.php`
- [ ] Extract login logic
- [ ] Extract registration logic

### Admin Module
- [ ] Create `AdminService.php`
- [ ] Create `SupervisorAssignmentService.php`
- [ ] Create `LandManagementService.php`

### Farmer Module
- [ ] Create `FarmerService.php`
- [ ] Create `FarmerProfileService.php`
- [ ] Extract farmer creation logic
- [ ] Extract profile update logic

### Farm Module
- [ ] Create `FarmService.php`
- [ ] Create `CropService.php`
- [ ] Create `LivestockService.php`
- [ ] Create `EquipmentService.php`

### Guide Module
- [ ] Create `GuideService.php`
- [ ] Create `GuidePublishService.php`

### Messaging Module
- [ ] Create `MessagingService.php`
- [ ] Create `ChatService.php`
- [ ] Extract messaging logic

### Market Module
- [ ] Create `MarketService.php`
- [ ] Create `PriceService.php`

### Announcement Module
- [ ] Create `AnnouncementService.php`
- [ ] Create `AnnouncementDistributionService.php`

### Notification Module
- [ ] Create `NotificationService.php`
- [ ] Create `NotificationChannelService.php`

### Dashboard Module
- [ ] Create `DashboardService.php`
- [ ] Create `AdminDashboardService.php`
- [ ] Create `FarmerDashboardService.php`

## Phase 5: Route Organization (To Do)

- [ ] Create `routes/Modules/auth.php`
- [ ] Create `routes/Modules/admin.php`
- [ ] Create `routes/Modules/farmer.php`
- [ ] Create `routes/Modules/farm.php`
- [ ] Create `routes/Modules/guide.php`
- [ ] Create `routes/Modules/messaging.php`
- [ ] Create `routes/Modules/market.php`
- [ ] Create `routes/Modules/announcement.php`
- [ ] Create `routes/Modules/notification.php`
- [ ] Create `routes/Modules/dashboard.php`
- [ ] Update `routes/web.php` to include module routes
- [ ] Group routes with appropriate middleware
- [ ] Test all routes

## Phase 6: View Organization (To Do)

- [ ] Organize views by module in `resources/views/`
- [ ] Create `resources/views/auth/`
- [ ] Create `resources/views/admin/`
- [ ] Create `resources/views/farmer/`
- [ ] Create `resources/views/farm/`
- [ ] Create `resources/views/guide/`
- [ ] Create `resources/views/messaging/`
- [ ] Create `resources/views/market/`
- [ ] Create `resources/views/dashboard/`
- [ ] Update view references in controllers

## Phase 7: Testing (To Do)

### Unit Tests
- [ ] Create tests for Auth module
- [ ] Create tests for Admin module
- [ ] Create tests for Farmer module
- [ ] Create tests for Farm module
- [ ] Create tests for Guide module
- [ ] Create tests for Messaging module
- [ ] Create tests for Market module
- [ ] Create tests for Announcement module
- [ ] Create tests for Notification module
- [ ] Create tests for Dashboard module

### Feature Tests
- [ ] Test Auth workflows
- [ ] Test Admin operations
- [ ] Test Farmer management
- [ ] Test Farm operations
- [ ] Test Messaging functionality
- [ ] Test Dashboard aggregation

## Phase 8: Documentation (To Do)

- [ ] Complete MODULAR_ARCHITECTURE_GUIDE.md ✅
- [ ] Create migration guide for developers
- [ ] Update README.md
- [ ] Create API documentation
- [ ] Document all endpoints
- [ ] Create troubleshooting guide
- [ ] Create developer guidelines

## Phase 9: Composer Configuration (To Do)

- [ ] Update `composer.json` PSR-4 autoloading
- [ ] Verify `App\Modules\` namespace mapping
- [ ] Run `composer dump-autoload`
- [ ] Test autoloading

## Phase 10: Service Providers (To Do)

- [ ] Create or update service providers for modules
- [ ] Register services in providers
- [ ] Register facades
- [ ] Register middleware
- [ ] Test service registration

## Priority Order

**HIGH PRIORITY:**
1. [ ] Phase 2 - Copy all files to module locations
2. [ ] Phase 3 - Update all namespaces
3. [ ] Phase 9 - Update composer.json
4. [ ] Phase 5 - Organize routes
5. [ ] Verify no breaking changes

**MEDIUM PRIORITY:**
6. [ ] Phase 4 - Create service layers
7. [ ] Phase 6 - Organize views
8. [ ] Phase 10 - Update service providers

**LOWER PRIORITY:**
9. [ ] Phase 7 - Write/update tests
10. [ ] Phase 8 - Complete documentation

## Testing After Implementation

```bash
# Test autoloading
composer dump-autoload

# Run tests
php artisan test

# Check for errors
php artisan tinker
>>> use App\Modules\Auth\Models\User;
>>> User::count();

# Run the application
php artisan serve
```

## Rollback Plan

If issues occur during migration:
1. Keep all original files in their old locations
2. Files in new locations don't affect originals
3. Update imports/namespaces gradually
4. Test after each phase
5. If major issue, revert namespace changes

---

**Document Version:** 1.0
**Created:** 2026-03-28
**Status:** Phase 1 Completed, Phase 2-10 Pending
