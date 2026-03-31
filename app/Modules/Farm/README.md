# Farm Module

## Overview
Manages farm operations, resources, and agricultural production including crops, livestock, equipment, and land parcels.

## Responsibilities
- Crop management and tracking
- Crop report generation
- Livestock management and health tracking
- Farm details and specifications
- Equipment inventory
- Farm inputs and supplies
- Farm parcel/plot management
- Farm records and history
- Water resources management

## Key Models
- **Crop** - Crop information and specifications
- **CropReport** - Crop reports and yield data
- **Livestock** - Livestock tracking and health
- **FarmDetail** - General farm information
- **FarmEquipment** - Equipment inventory
- **FarmInput** - Inputs and supplies tracking
- **FarmParcel** - Land plots and parcels
- **FarmRecord** - Historical farm records
- **FarmWaterResource** - Water resource management

## Controllers
- `FarmController` - Main farm operations
- `CropController` - Crop management
- `LivestockController` - Livestock management
- `EquipmentController` - Equipment management

## Services
- `FarmService` - Farm operations business logic
- `CropService` - Crop management service
- `LivestockService` - Livestock management service
- `EquipmentService` - Equipment inventory service

## Key Relationships
- Farm (FarmDetail) belongs to Farmer
- Farm has many crops (Crop)
- Crop has many reports (CropReport)
- Farm has many livestock (Livestock)
- Farm has many equipment (FarmEquipment)
- Farm has many parcels (FarmParcel)
- Farm has many water resources (FarmWaterResource)

## Routes
```
GET    /farms/{id}/crops            - List crops
POST   /farms/{id}/crops            - Add crop
GET    /farms/{id}/livestock        - List livestock
POST   /farms/{id}/livestock        - Add livestock
GET    /farms/{id}/equipment        - List equipment
GET    /farms/{id}/parcels          - List farm parcels
GET    /farms/{id}/water-resources  - Water resource info
```

## Usage Examples

### Get Farm with All Resources
```php
$farm = FarmDetail::with(['crops', 'livestock', 'equipment', 'parcels'])->find($id);
```

### Create Crop Report
```php
$crop->reports()->create($reportData);
```

## Validation
- Crop quantities must be positive
- Equipment serial numbers must be unique
- Water resource measurements must be valid
- Parcel area calculations

## Testing
- Test crop creation and reporting
- Test livestock tracking
- Test equipment inventory
- Test parcel associations
- Test water resource management

## Implementation Notes
- Track crop seasons (Kharif, Rabi, etc.)
- Implement livestock health tracking
- Create equipment maintenance schedules
- Maintain historical records for analytics
- Implement geolocation for parcels
- Create dashboard displays for farm overview
