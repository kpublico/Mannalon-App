# Modules Overview

## Directory Structure

This document provides a quick overview of all modules in the Mannalon application.

```
app/Modules/
├── Auth/          - User Authentication & Authorization
├── Admin/         - Administrative Operations
├── Farmer/        - Farmer Profile Management  
├── Farm/          - Farm Operations & Resources
├── Guide/         - Farming Guides & Education
├── Messaging/     - User Communication
├── Market/        - Commodity Prices & Market Info
├── Announcement/  - System Announcements
├── Notification/  - User Notifications
├── Dashboard/     - Metrics & Analytics
└── Shared/        - Cross-Module Utilities
```

## Module Status

| Module | Status | Controllers | Models | Services | Routes |
|--------|--------|-------------|--------|----------|--------|
| Auth | ✅ Setup | 1 | 2 | - | - |
| Admin | ✅ Setup | 2 | 1 | - | - |
| Farmer | ✅ Setup | - | 10 | - | - |
| Farm | ✅ Setup | - | 9 | - | - |
| Guide | ✅ Setup | - | 1 | - | - |
| Messaging | ✅ Setup | 2 | 4 | - | - |
| Market | ✅ Setup | - | 1 | - | - |
| Announcement | ✅ Setup | - | 1 | - | - |
| Notification | ✅ Setup | - | 1 | - | - |
| Dashboard | ✅ Setup | 1 | - | - | - |
| Shared | ✅ Setup | - | 5 | - | - |

## Implementation Roadmap

### Phase 1: Directory Structure ✅
- [x] Create module directories
- [x] Create service directories
- [x] Create Models directories
- [x] Create Controllers directories
- [x] Create READMEs for each module

### Phase 2: File Migration (Next Steps)
- [ ] Copy controllers to respective modules
- [ ] Copy models to respective modules
- [ ] Update namespaces in all files
- [ ] Update use statements and imports

### Phase 3: Service Layer Creation
- [ ] Extract business logic from controllers
- [ ] Create service classes
- [ ] Implement dependency injection
- [ ] Create interfaces for services

### Phase 4: Route Organization
- [ ] Create module-specific route files
- [ ] Update web.php to use modular routes
- [ ] Group routes by module
- [ ] Apply appropriate middleware

### Phase 5: Testing & Validation
- [ ] Create unit tests
- [ ] Create feature tests
- [ ] Test all endpoints
- [ ] Verify namespace resolution

## Quick Reference

### Auth Module
- **Purpose:** User authentication and authorization
- **Key Files:** AuthController, User, Role
- **Where to Find:** `app/Modules/Auth/`

### Farmer Module
- **Purpose:** Farmer profile and information management
- **Key Files:** Farmer, FarmerProfile, FarmerAddress, FarmerFinancialRecord
- **Where to Find:** `app/Modules/Farmer/`

### Farm Module
- **Purpose:** Farm operations including crops and livestock
- **Key Files:** Crop, Livestock, FarmDetail, FarmEquipment
- **Where to Find:** `app/Modules/Farm/`

### Messaging Module
- **Purpose:** User communication and chat
- **Key Files:** Message, ConversationThread, ChatController
- **Where to Find:** `app/Modules/Messaging/`

### Dashboard Module
- **Purpose:** Aggregated metrics and analytics
- **Key Files:** DashboardController, DashboardService
- **Where to Find:** `app/Modules/Dashboard/`

## Common Tasks

### Adding a New Feature to a Module
1. Create controller in `Modules/{ModuleName}/Controllers/`
2. Create model in `Modules/{ModuleName}/Models/`
3. Create service in `Modules/{ModuleName}/Services/`
4. Add routes in `routes/Modules/{module}.php`
5. Create tests in `tests/Feature/{ModuleName}/`

### Accessing Models from Different Modules
```php
// Import with full namespace
use App\Modules\Farmer\Models\Farmer;
use App\Modules\Farm\Models\Crop;

$farmer = Farmer::find($id);
$crops = $farmer->farm->crops;
```

### Creating a Service
```php
namespace App\Modules\Farmer\Services;

class FarmerService
{
    public function __construct(
        private FarmerRepository $farmerRepository
    ) {}
    
    public function createFarmer(array $data)
    {
        return $this->farmerRepository->create($data);
    }
}
```

## Best Practices

1. **Keep Modules Independent** - Minimize cross-module dependencies
2. **Use Services** - Extract business logic from controllers
3. **Namespace Everything** - Use proper namespace for each file
4. **Update Documentation** - Keep READMEs current
5. **Write Tests** - Create unit and feature tests
6. **Follow PSR-12** - Maintain consistent code style
7. **Use Type Hints** - Add type hints for parameters and returns
8. **Document APIs** - Document public methods and endpoints

---

**Created:** 2026-03-28
**Last Updated:** 2026-03-28

For detailed information about each module, see the individual module README files.
