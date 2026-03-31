# Shared Module

## Overview
Contains cross-cutting concerns, shared utilities, traits, and models used across multiple modules.

## Responsibilities
- Shared data models
- Reusable traits
- Utility classes
- Cross-module services
- Common enums and constants

## Key Models
- **CommunicationPermission** - Permission management for user communication
- **Beneficiary** - Beneficiary information (government programs)
- **GovernmentProgramParticipation** - Program participation records
- **ProgramBenefitAvailed** - Benefits claimed from programs
- **ServiceAccessLog** - Access logging for audit trails

## Traits
- Shared traits that multiple modules use (audit logging, soft deletes, etc.)

## Enums
- Status enums
- Role enums
- Permission enums

## Usage

### Using Shared Traits
```php
use App\Modules\Shared\Traits\Auditable;

class MyModel extends Model
{
    use Auditable;
}
```

### Using Shared Models
```php
use App\Modules\Shared\Models\ServiceAccessLog;

ServiceAccessLog::log($user, 'action', 'details');
```

## Key Relationships
- Models used by other modules maintain relationships through this shared module
- Traits provide common functionality across all models

## Common Patterns

### Audit Logging
```php
// Automatically logs all changes to the model
use App\Modules\Shared\Traits\Auditable;
```

### Soft Deletes
```php
// Soft-delete capability
use SoftDeletes;
```

### Timestamps
```php
// Automatic created_at and updated_at
use HasTimestamps; // or built-in Laravel timestamp
```

## Implementation Notes

### Adding New Shared Models
1. Create model in `Modules/Shared/Models/`
2. Document in this README
3. Add relationships
4. Create migrations if needed

### Adding New Traits
1. Create trait in `Modules/Shared/Traits/`
2. Document usage
3. Test across different models

### Adding New Enums
1. Create enum in `Modules/Shared/Enums/`
2. Use backed enums for database storage
3. Document available values

## Examples

### Access Log Usage
```php
$service = app(ServiceAccessLog::class);
$service->log(auth()->user(), 'farmer_view', 'Viewed farmer #123');
```

### Permission Check
```php
$permission = CommunicationPermission::where('user_id', $userId)
    ->where('can_message', true)
    ->exists();
```

### Program Participation
```php
$programs = GovernmentProgramParticipation::where('farmer_id', $farmerId)->get();
```
