# Admin Module

## Overview
Manages administrative operations, supervisor assignments, and land management capabilities for administrators.

## Responsibilities
- Admin user management and operations
- Supervisor assignments to farmers/regions
- Land management and verification
- System configuration
- User role and permission management
- Administrative reporting

## Key Models
- **AdminSupervisorAssignment** - Links administrators to supervised farmers/regions

## Controllers
- `AdminController` - Main admin operations and dashboard
- `AdminLandManagementController` - Land verification and management

## Services
- `AdminService` - Admin operations business logic
- `SupervisorAssignmentService` - Manages supervisor-farmer relationships
- `LandManagementService` - Land verification and management

## Key Relationships
- Admin (extends User) has many supervisor assignments
- Supervisor assignments link to Farmer/Farm models

## Routes
```
GET    /admin/dashboard       - Admin dashboard
GET    /admin/supervisors     - List supervisors
POST   /admin/assign-supervisor - Assign supervisor
GET    /admin/land-management  - Land management view
POST   /admin/verify-land      - Verify farm land
```

## Usage Examples

### Get Admin Dashboard
```php
Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->middleware('admin');
```

### Assign Supervisor
```php
Route::post('/admin/assign-supervisor', [AdminController::class, 'assignSupervisor']);
```

## Middleware
- `admin` - Verify user is an admin
- `supervisor` - Verify user is a supervisor

## Testing
- Test admin-only operations are restricted
- Test supervisor assignment workflow
- Test land verification process
- Test reporting capabilities

## Implementation Notes
- Require admin middleware on all routes
- Log all administrative actions for audit
- Implement approval workflows for sensitive operations
- Create audit trail for land verification changes
