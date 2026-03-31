# Modular Architecture - Developer Quick Start Guide

## Welcome to the Modular Mannalon Architecture!

This guide will help you quickly understand and work with the new modular structure.

## Understanding the Structure

### Module Organization
Each module is self-contained and organized by domain:

```
Modules/
├── Auth/              # Authentication & User Management
├── Admin/             # Administrative Functions
├── Farmer/            # Farmer Profiles & Info
├── Farm/              # Farm Operations
├── Guide/             # Farming Guides
├── Messaging/         # Chat & Messages
├── Market/            # Market Prices
├── Announcement/      # System Announcements
├── Notification/      # User Notifications
├── Dashboard/         # Analytics & Metrics
└── Shared/            # Utilities & Shared Code
```

## Finding Code

### I need to work with farmer data
👉 Look in `app/Modules/Farmer/Models/`
- `Farmer.php` - Core farmer entity
- `FarmerProfile.php` - Profile details
- `FarmerAddress.php` - Address info

### I need to add a new crop feature
👉 Look in `app/Modules/Farm/`
- Models: `Crop.php`, `CropReport.php`
- Controller: `CropController.php` (when created)
- Service: `CropService.php` (when created)

### I need to update messaging
👉 Look in `app/Modules/Messaging/`
- Controllers: `ChatController.php`, `MessagingController.php`
- Models: `Message.php`, `ConversationThread.php`

### I need shared/reusable code
👉 Look in `app/Modules/Shared/`
- Models: Common models used across modules
- Traits: Reusable traits for all models

## Creating a New Feature

### Step 1: Create the Model
```php
// File: app/Modules/Farm/Models/FarmVariation.php
namespace App\Modules\Farm\Models;

use Illuminate\Database\Eloquent\Model;

class FarmVariation extends Model
{
    protected $fillable = ['crop_id', 'variety', 'yield'];
    
    public function crop()
    {
        return $this->belongsTo(Crop::class);
    }
}
```

### Step 2: Create the Service (Business Logic)
```php
// File: app/Modules/Farm/Services/FarmVariationService.php
namespace App\Modules\Farm\Services;

use App\Modules\Farm\Models\FarmVariation;

class FarmVariationService
{
    public function createVariation(array $data)
    {
        return FarmVariation::create($data);
    }
    
    public function getVariationsByCrop($cropId)
    {
        return FarmVariation::where('crop_id', $cropId)->get();
    }
}
```

### Step 3: Create the Controller
```php
// File: app/Modules/Farm/Controllers/FarmVariationController.php
namespace App\Modules\Farm\Controllers;

use Illuminate\Routing\Controller;
use App\Modules\Farm\Services\FarmVariationService;

class FarmVariationController extends Controller
{
    public function __construct(
        private FarmVariationService $service
    ) {}
    
    public function store($cropId)
    {
        $variation = $this->service->createVariation(
            request()->validate([
                'variety' => 'required|string',
                'yield' => 'required|numeric'
            ]) + ['crop_id' => $cropId]
        );
        
        return response()->json($variation);
    }
}
```

### Step 4: Add Routes (when routes are organized)
```php
// Will be added to routes/Modules/farm.php
Route::post('crops/{cropId}/variations', [FarmVariationController::class, 'store']);
```

## Using Models in Different Modules

### Importing Models from Another Module
```php
// In a Farmer module file, use Farm models:
use App\Modules\Farm\Models\Crop;
use App\Modules\Farm\Models\Livestock;

$crops = Crop::where('farmer_id', $farmerId)->get();
```

### Accessing Related Models Across Modules
```php
// Farmer module accessing Farm module data
$farmer = Farmer::with(['farm.crops', 'farm.livestock'])->find($id);

// Loop through farmer's crops
foreach ($farmer->farm->crops as $crop) {
    echo $crop->name;
}
```

## Common Tasks

### Adding Validation to a Service
```php
use Illuminate\Support\Facades\Validator;

class FarmerService
{
    public function createFarmer(array $data)
    {
        $validated = Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'phone' => 'required|string'
        ])->validate();
        
        return Farmer::create($validated);
    }
}
```

### Using Dependency Injection
```php
class DashboardController extends Controller
{
    public function __construct(
        private AdminDashboardService $adminService,
        private FarmerDashboardService $farmerService
    ) {}
    
    public function index()
    {
        if (auth()->user()->is_admin) {
            return view('dashboard.admin', [
                'data' => $this->adminService->getMetrics()
            ]);
        }
        
        return view('dashboard.farmer', [
            'data' => $this->farmerService->getMetrics(auth()->id())
        ]);
    }
}
```

### Querying Across Modules
```php
// Get all farmers with farms in a specific region
$farmers = Farmer::whereHas('farm', function ($query) {
    $query->where('region', 'Karnataka');
})->get();

// Count achievements by role
$adminCount = User::where('role', 'admin')->count();
$farmerCount = Farmer::count();
```

## File Locations Reference

| Task | Location |
|------|----------|
| Find farmer models | `app/Modules/Farmer/Models/` |
| Find farm operations | `app/Modules/Farm/Models/` |
| Add authentication logic | `app/Modules/Auth/Services/` |
| Create new admin feature | `app/Modules/Admin/` |
| Work with messages | `app/Modules/Messaging/` |
| Add market features | `app/Modules/Market/` |
| Create shared traits | `app/Modules/Shared/Traits/` |
| Add shared models | `app/Modules/Shared/Models/` |

## Best Practices

### 1. Keep Models Focused
```php
/* ✅ Good - Model only concerned with its properties */
class Farmer extends Model
{
    protected $fillable = ['name', 'email'];
    
    public function farm()
    {
        return $this->hasOne(FarmDetail::class);
    }
}

/* ❌ Avoid - Mixing business logic in model */
class Farmer extends Model
{
    public function calculateSubsidy()
    {
        // Complex business logic - move to service
    }
}
```

### 2. Use Services for Business Logic
```php
/* ✅ Good - Service handles business logic */
class FarmerService
{
    public function applyForSubsidy(Farmer $farmer, array $data)
    {
        // Validate data
        // Check eligibility
        // Create records
        // Send notifications
    }
}
```

### 3. Use Type Hints
```php
/* ✅ Good - Clear parameter types */
public function create(FarmerData $data): Farmer
{
    return Farmer::create($data->toArray());
}

/* ❌ Avoid - Ambiguous parameter types */
public function create($data)
{
    return Farmer::create($data);
}
```

### 4. Organize Imports by Module
```php
/* ✅ Good - Organized imports */
// Local imports first
use App\Modules\Farmer\Models\Farmer;

// External module imports
use App\Modules\Farm\Models\Crop;
use App\Modules\Shared\Traits\Auditable;

// Laravel imports
use Illuminate\Database\Eloquent\Model;
```

## Troubleshooting

### "Class not found" errors
- Check namespace matches file location
- Verify use statement is correct
- Run `composer dump-autoload`

### Model relationships not working
- Ensure related model namespace is correct
- Verify relationship method is defined
- Check foreign key configurations

### Routes not working
- Verify controller namespace is correct
- Check route import statement
- Test route with `php artisan route:list`

## Getting Help

### Find Module Documentation
See individual module READMEs in `app/Modules/{ModuleName}/README.md`

### View Full Architecture Guide
Read `MODULAR_ARCHITECTURE_GUIDE.md` in project root

### Check Implementation Status
Read `IMPLEMENTATION_CHECKLIST.md` for what's done and what's pending

## Next Steps

1. Read the [MODULAR_ARCHITECTURE_GUIDE.md](../MODULAR_ARCHITECTURE_GUIDE.md)
2. Review your module's README file
3. Run `composer dump-autoload`
4. Test imports: `php artisan tinker`
5. Start building features!

---

**Happy Coding!** 🚀

For questions or clarifications, refer to the module READMEs or the main architecture guide.
