# Dashboard Module

## Overview
Aggregates and displays key metrics, analytics, and information relevant to each user role (Admin, Supervisor, Farmer).

## Responsibilities
- Dashboard data aggregation
- Metrics calculation
- Performance analytics
- Custom dashboard widgets
- Data visualization preparation

## Key Models
- No models in this module (aggregates data from other modules)

## Controllers
- `DashboardController` - Dashboard data endpoints

## Services
- `DashboardService` - Data aggregation and calculations
- `AdminDashboardService` - Admin-specific metrics
- `FarmerDashboardService` - Farmer-specific metrics
- `SupervisorDashboardService` - Supervisor-specific metrics

## Key Relationships
- Dashboard aggregates data from all other modules
- Uses models from Admin, Farmer, Farm, Market modules

## Routes
```
GET    /dashboard           - Main dashboard
GET    /dashboard/admin     - Admin dashboard
GET    /dashboard/farmer    - Farmer dashboard
GET    /dashboard/metrics   - Detailed metrics
```

## Usage Examples

### Get Admin Dashboard Data
```php
$dashboardService = app(DashboardService::class);
$data = $dashboardService->getAdminDashboard();
```

### Get Farmer Dashboard
```php
$farmerMetrics = app(FarmerDashboardService::class)->getMetrics(auth()->id());
```

## Validation
- User role validation
- Data range validation

## Testing
- Test dashboard data accuracy
- Test metrics calculations
- Test role-based dashboard variations
- Test data pagination

## Implementation Notes
- Use caching for expensive calculations
- Implement real-time updates
- Create dashboard customization options
- Add export functionality
- Create performance reports
- Implement activity feeds
- Create comparison views
- Add drill-down capabilities
