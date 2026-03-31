# Market Module

## Overview
Manages commodity prices, market information, and price tracking for agricultural products.

## Responsibilities
- Commodity price tracking
- Price history and trends
- Market analysis
- Price alerts for farmers
- Local and regional price comparisons

## Key Models
- **CommodityPrice** - Commodity prices

## Controllers
- `MarketController` - Market information and prices

## Services
- `MarketService` - Market operations business logic
- `PriceService` - Price data management
- `PriceAlertService` - Price alert notifications

## Key Relationships
- CommodityPrice relates to Product/Crop type
- CommodityPrice tracked by location/region
- CommodityPrice has time-series data

## Routes
```
GET    /market/prices        - Get current prices
GET    /market/trends        - Price trends
GET    /market/prices/{crop} - Prices for specific crop
POST   /market/alerts        - Set price alerts
```

## Usage Examples

### Get Current Market Prices
```php
$prices = CommodityPrice::latest()->get();
```

### Get Price Trend
```php
$trend = CommodityPrice::where('commodity', 'wheat')
    ->whereBetween('date', [$startDate, $endDate])
    ->orderBy('date')
    ->get();
```

## Validation
- Price value must be positive
- Valid commodity type
- Valid region/location
- Valid date format

## Testing
- Test price data display
- Test trend calculations
- Test price alert functionality
- Test regional price comparisons

## Implementation Notes
- Integrate with external price APIs if available
- Implement daily/hourly price updates
- Create price prediction model
- Add comparative analysis tools
- Implement mobile alerts for price changes
- Create price history visualization
- Add export functionality for price data
