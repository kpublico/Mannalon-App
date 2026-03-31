# Mannalon App - Modular Architecture Guide

## Overview
This document outlines the clean, modular architecture implemented for the Mannalon Farmer Management System. The project has been reorganized using a Domain-Driven Design (DDD) and Module-Based Architecture pattern to improve maintainability, scalability, and separation of concerns.

## Architecture Principles

1. **Domain-Driven Design (DDD)** - Each business domain is a separate module
2. **Single Responsibility** - Each module handles one core business concern
3. **Loose Coupling** - Modules communicate through well-defined interfaces
4. **High Cohesion** - Related functionality stays together within a module
5. **Testability** - Clear boundaries make modules easier to test

## Project Structure

```
app/
├── Modules/                          # All business logic organized by domain
│   ├── Auth/                         # Authentication & Authorization
│   │   ├── Controllers/
│   │   │   └── AuthController.php
│   │   ├── Models/
│   │   │   ├── User.php              # User model (core to auth)
│   │   │   └── Role.php              # Role model
│   │   ├── Services/
│   │   ├── Requests/                 # Form request validations
│   │   └── README.md
│   │
│   ├── Admin/                        # Admin Management & Supervision
│   │   ├── Controllers/
│   │   │   ├── AdminController.php
│   │   │   └── AdminLandManagementController.php
│   │   ├── Models/
│   │   │   └── AdminSupervisorAssignment.php
│   │   ├── Services/
│   │   └── README.md
│   │
│   ├── Farmer/                       # Farmer Profile & Information
│   │   ├── Controllers/
│   │   ├── Models/
│   │   │   ├── Farmer.php                    # Core farmer entity
│   │   │   ├── FarmerProfile.php             # Extended farmer profile
│   │   │   ├── FarmerAddress.php             # Farmer address info
│   │   │   ├── FarmerDocument.php            # Farmer documents
│   │   │   ├── FarmerFinancialRecord.php     # Financial records
│   │   │   ├── FarmerCreditRecord.php        # Credit information
│   │   │   ├── FarmerInsuranceRecord.php     # Insurance records
│   │   │   ├── FarmerAuditLog.php            # Audit logs
│   │   │   ├── FarmerGroup.php               # Farmer groups/associations
│   │   │   └── FarmingProfile.php            # Farming-specific profile
│   │   ├── Services/
│   │   │   └── FarmerService.php             # Business logic for farmer management
│   │   └── README.md
│   │
│   ├── Farm/                         # Farm Operations & Resources
│   │   ├── Controllers/
│   │   ├── Models/
│   │   │   ├── Crop.php                      # Crop information
│   │   │   ├── CropReport.php                # Crop reports
│   │   │   ├── Livestock.php                 # Livestock tracking
│   │   │   ├── FarmDetail.php                # Farm details
│   │   │   ├── FarmEquipment.php             # Farm equipment inventory
│   │   │   ├── FarmInput.php                 # Farm inputs/supplies
│   │   │   ├── FarmParcel.php                # Farm parcels/plots
│   │   │   ├── FarmRecord.php                # Farm records
│   │   │   └── FarmWaterResource.php         # Water resources
│   │   ├── Services/
│   │   │   └── FarmService.php               # Farm management business logic
│   │   └── README.md
│   │
│   ├── Guide/                        # Farming Guides & Educational Content
│   │   ├── Controllers/
│   │   ├── Models/
│   │   │   └── FarmingGuide.php               # Farming guides
│   │   ├── Services/
│   │   └── README.md
│   │
│   ├── Messaging/                    # Chat, Messages & Communication
│   │   ├── Controllers/
│   │   │   ├── ChatController.php
│   │   │   └── MessagingController.php
│   │   ├── Models/
│   │   │   ├── Message.php                   # Messages
│   │   │   ├── MessageRecipient.php          # Message recipients
│   │   │   ├── ConversationThread.php        # Chat threads
│   │   │   └── ThreadParticipant.php         # Thread participants
│   │   ├── Services/
│   │   │   └── MessagingService.php          # Messaging business logic
│   │   ├── Events/                           # Message events
│   │   └── README.md
│   │
│   ├── Market/                       # Market & Commodity Prices
│   │   ├── Controllers/
│   │   ├── Models/
│   │   │   └── CommodityPrice.php            # Commodity prices
│   │   ├── Services/
│   │   └── README.md
│   │
│   ├── Announcement/                 # System Announcements
│   │   ├── Controllers/
│   │   ├── Models/
│   │   │   └── Announcement.php               # Announcements
│   │   ├── Services/
│   │   │   └── AnnouncementService.php        # Announcement business logic
│   │   └── README.md
│   │
│   ├── Notification/                 # User Notifications
│   │   ├── Controllers/
│   │   ├── Models/
│   │   │   └── Notification.php               # Notifications
│   │   ├── Services/
│   │   │   └── NotificationService.php        # Notification business logic
│   │   └── README.md
│   │
│   ├── Dashboard/                    # Dashboard & Analytics
│   │   ├── Controllers/
│   │   │   └── DashboardController.php
│   │   ├── Services/
│   │   │   └── DashboardService.php           # Dashboard data aggregation
│   │   ├── DTO/                              # Data Transfer Objects
│   │   └── README.md
│   │
│   ├── Shared/                       # Shared Resources & Utilities
│   │   ├── Models/
│   │   │   ├── CommunicationPermission.php   # Shared permission model
│   │   │   ├── Beneficiary.php               # Beneficiary information
│   │   │   ├── GovernmentProgramParticipation.php
│   │   │   ├── ProgramBenefitAvailed.php
│   │   │   └── ServiceAccessLog.php          # Access logging
│   │   ├── Traits/                           # Reusable traits
│   │   │   └── (Move Traits/ files here)
│   │   ├── Enums/                            # Enum classes
│   │   └── README.md
│   │
│   └── README.md                     # Modules overview
│
├── Http/                             # Cross-cutting HTTP concerns
│   ├── Controllers/                  # (Legacy - kept for reference)
│   │   └── (See Modules/* for current structure)
│   ├── Middleware/                   # HTTP Middleware
│   │   └── (Contains: custom middleware)
│   └── Kernel.php
│
├── Models/                           # (Legacy - see Modules/* for new location)
├── Services/                         # (Core application services)
├── Traits/                           # (See Modules/Shared/Traits)
├── Providers/                        # Service providers
├── Exceptions/                       # Custom exceptions
└── ...

routes/
├── web.php                           # Web routes (to be organized by module)
└── console.php                       # Console commands

resources/
├── views/
│   ├── auth/                         # Auth views
│   ├── admin/                        # Admin views
│   ├── farmer/                       # Farmer views
│   ├── farm/                         # Farm views
│   ├── messaging/                    # Messaging views
│   ├── dashboard/                    # Dashboard views
│   └── ...
└── react/                            # React components
    ├── components/Auth/
    ├── components/Admin/
    ├── components/Farmer/
    ├── components/Farm/
    ├── components/Messaging/
    ├── components/Dashboard/
    └── ...
```

## Module Organization

### 1. **Auth Module** 
**Responsibility:** User authentication, authorization, and access control
**Files:**
- Controllers: `AuthController.php`
- Models: `User.php`, `Role.php`

### 2. **Admin Module**
**Responsibility:** Admin operations, supervision, and land management
**Files:**
- Controllers: `AdminController.php`, `AdminLandManagementController.php`
- Models: `AdminSupervisorAssignment.php`

### 3. **Farmer Module**
**Responsibility:** Farmer profile management and farmer-specific data
**Files:**
- Models: `Farmer.php`, `FarmerProfile.php`, `FarmerAddress.php`, `FarmerDocument.php`, `FarmerFinancialRecord.php`, `FarmerCreditRecord.php`, `FarmerInsuranceRecord.php`, `FarmerAuditLog.php`, `FarmerGroup.php`, `FarmingProfile.php`

### 4. **Farm Module**
**Responsibility:** Farm operations, resources, and production tracking
**Files:**
- Models: `Crop.php`, `CropReport.php`, `Livestock.php`, `FarmDetail.php`, `FarmEquipment.php`, `FarmInput.php`, `FarmParcel.php`, `FarmRecord.php`, `FarmWaterResource.php`

### 5. **Guide Module**
**Responsibility:** Farming guides and educational content
**Files:**
- Models: `FarmingGuide.php`

### 6. **Messaging Module**
**Responsibility:** Inter-user communication, chat, and messaging
**Files:**
- Controllers: `ChatController.php`, `MessagingController.php`
- Models: `Message.php`, `MessageRecipient.php`, `ConversationThread.php`, `ThreadParticipant.php`

### 7. **Market Module**
**Responsibility:** Commodity prices and market information
**Files:**
- Models: `CommodityPrice.php`

### 8. **Announcement Module**
**Responsibility:** System announcements and broadcasts
**Files:**
- Models: `Announcement.php`

### 9. **Notification Module**
**Responsibility:** User notifications and alerts
**Files:**
- Models: `Notification.php`

### 10. **Dashboard Module**
**Responsibility:** Dashboard aggregation and analytics
**Files:**
- Controllers: `DashboardController.php`
- Services: `DashboardService.php`

### 11. **Shared Module**
**Responsibility:** Cross-cutting concerns and shared utilities
**Files:**
- Models: `CommunicationPermission.php`, `Beneficiary.php`, `GovernmentProgramParticipation.php`, `ProgramBenefitAvailed.php`, `ServiceAccessLog.php`
- Traits: (from `Traits/` folder)

## File Migration Mapping

| Original Location | New Location |
|---|---|
| `app/Http/Controllers/AuthController.php` | `app/Modules/Auth/Controllers/AuthController.php` |
| `app/Http/Controllers/AdminController.php` | `app/Modules/Admin/Controllers/AdminController.php` |
| `app/Http/Controllers/AdminLandManagementController.php` | `app/Modules/Admin/Controllers/AdminLandManagementController.php` |
| `app/Http/Controllers/DashboardController.php` | `app/Modules/Dashboard/Controllers/DashboardController.php` |
| `app/Http/Controllers/ChatController.php` | `app/Modules/Messaging/Controllers/ChatController.php` |
| `app/Http/Controllers/MessagingController.php` | `app/Modules/Messaging/Controllers/MessagingController.php` |
| `app/Models/Farmer.php` | `app/Modules/Farmer/Models/Farmer.php` |
| `app/Models/FarmerProfile.php` | `app/Modules/Farmer/Models/FarmerProfile.php` |
| `app/Models/FarmerAddress.php` | `app/Modules/Farmer/Models/FarmerAddress.php` |
| `app/Models/FarmerDocument.php` | `app/Modules/Farmer/Models/FarmerDocument.php` |
| `app/Models/FarmerFinancialRecord.php` | `app/Modules/Farmer/Models/FarmerFinancialRecord.php` |
| `app/Models/FarmerCreditRecord.php` | `app/Modules/Farmer/Models/FarmerCreditRecord.php` |
| `app/Models/FarmerInsuranceRecord.php` | `app/Modules/Farmer/Models/FarmerInsuranceRecord.php` |
| `app/Models/FarmerAuditLog.php` | `app/Modules/Farmer/Models/FarmerAuditLog.php` |
| `app/Models/FarmerGroup.php` | `app/Modules/Farmer/Models/FarmerGroup.php` |
| `app/Models/FarmingProfile.php` | `app/Modules/Farmer/Models/FarmingProfile.php` |
| `app/Models/Crop.php` | `app/Modules/Farm/Models/Crop.php` |
| `app/Models/CropReport.php` | `app/Modules/Farm/Models/CropReport.php` |
| `app/Models/Livestock.php` | `app/Modules/Farm/Models/Livestock.php` |
| `app/Models/FarmDetail.php` | `app/Modules/Farm/Models/FarmDetail.php` |
| `app/Models/FarmEquipment.php` | `app/Modules/Farm/Models/FarmEquipment.php` |
| `app/Models/FarmInput.php` | `app/Modules/Farm/Models/FarmInput.php` |
| `app/Models/FarmParcel.php` | `app/Modules/Farm/Models/FarmParcel.php` |
| `app/Models/FarmRecord.php` | `app/Modules/Farm/Models/FarmRecord.php` |
| `app/Models/FarmWaterResource.php` | `app/Modules/Farm/Models/FarmWaterResource.php` |
| `app/Models/FarmingGuide.php` | `app/Modules/Guide/Models/FarmingGuide.php` |
| `app/Models/Message.php` | `app/Modules/Messaging/Models/Message.php` |
| `app/Models/MessageRecipient.php` | `app/Modules/Messaging/Models/MessageRecipient.php` |
| `app/Models/ConversationThread.php` | `app/Modules/Messaging/Models/ConversationThread.php` |
| `app/Models/ThreadParticipant.php` | `app/Modules/Messaging/Models/ThreadParticipant.php` |
| `app/Models/CommodityPrice.php` | `app/Modules/Market/Models/CommodityPrice.php` |
| `app/Models/Announcement.php` | `app/Modules/Announcement/Models/Announcement.php` |
| `app/Models/Notification.php` | `app/Modules/Notification/Models/Notification.php` |
| `app/Models/User.php` | `app/Modules/Auth/Models/User.php` |
| `app/Models/Role.php` | `app/Modules/Auth/Models/Role.php` |
| `app/Models/AdminSupervisorAssignment.php` | `app/Modules/Admin/Models/AdminSupervisorAssignment.php` |
| `app/Models/CommunicationPermission.php` | `app/Modules/Shared/Models/CommunicationPermission.php` |
| `app/Models/Beneficiary.php` | `app/Modules/Shared/Models/Beneficiary.php` |
| `app/Models/GovernmentProgramParticipation.php` | `app/Modules/Shared/Models/GovernmentProgramParticipation.php` |
| `app/Models/ProgramBenefitAvailed.php` | `app/Modules/Shared/Models/ProgramBenefitAvailed.php` |
| `app/Models/ServiceAccessLog.php` | `app/Modules/Shared/Models/ServiceAccessLog.php` |
| `app/Traits/*` | `app/Modules/Shared/Traits/*` |

## Next Steps for Full Implementation

### Phase 1: Copy Files (No Deletion)
1. Create all module directories ✅ (DONE)
2. Copy all Controller files to respective module Controllers/
3. Copy all Model files to respective module Models/
4. Copy all Trait files to Modules/Shared/Traits/

### Phase 2: Update Namespaces
1. Update namespace declarations in all copied files
2. Update use statements and imports
3. Update class inheritance references

### Phase 3: Create Service Layers
1. Extract business logic from controllers into Services
2. Create `XxxService.php` in each module
3. Implement dependency injection

### Phase 4: Create Module Routes
1. Create `routes/Modules/auth.php`
2. Create `routes/Modules/admin.php`
3. Create `routes/Modules/farmer.php`
4. Group routes by module in `routes/web.php`

### Phase 5: Update Views Organization
1. Organize views by module in `resources/views/`
2. Update view references in controllers

### Phase 6: Create Service Providers
1. Create module-specific service providers
2. Register in `app/Providers/AppServiceProvider.php`

## Benefits of This Architecture

✅ **Better Organization** - Related code is grouped together by domain
✅ **Improved Maintainability** - Changes to one feature stay within that module
✅ **Scalability** - Easy to add new modules or features
✅ **Reusability** - Shared components in Shared module
✅ **Testability** - Clear boundaries make unit testing easier
✅ **Team Collaboration** - Multiple teams can work on different modules
✅ **Code Discovery** - New developers can quickly find relevant code
✅ **Reduced Conflicts** - Team members work in different modules

## Naming Conventions

### Controllers
```php
namespace App\Modules\{Module}\Controllers;

class {Feature}Controller extends Controller
{
    // index, show, store, update, destroy, etc.
}
```

### Models
```php
namespace App\Modules\{Module}\Models;

class {EntityName} extends Model
{
    // Model definition
}
```

### Services
```php
namespace App\Modules\{Module}\Services;

class {Feature}Service
{
    // Business logic
}
```

### Routes
```php
// routes/Modules/module-name.php
Route::group(['prefix' => 'module-prefix', 'middleware' => 'auth'], function () {
    // Routes for this module
});
```

## PSR-4 Autoloading

Update `composer.json` to ensure modules are autoloaded:

```json
{
  "autoload": {
    "psr-4": {
      "App\\": "app/",
      "App\\Modules\\": "app/Modules/",
      "Database\\Factories\\": "database/factories/",
      "Database\\Seeders\\": "database/seeders/"
    }
  }
}
```

Then run:
```bash
composer dump-autoload
```

## Documentation Files in Each Module

Each module should have a `README.md` describing:
- Module purpose and responsibilities
- Key models and their relationships
- Available endpoints/routes
- Service layer overview
- Implementation notes

---

**Created:** 2026-03-28
**Last Updated:** 2026-03-28
**Version:** 1.0
