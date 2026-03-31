# Farmer Module

## Overview
Manages farmer profiles, personal information, financial records, and farmer-specific data.

## Responsibilities
- Farmer profile creation and management
- Address and contact information
- Document management (IDs, certificates, etc.)
- Financial record tracking
- Credit and insurance information
- Farmer group associations
- Audit logging for farmer modifications

## Key Models
- **Farmer** - Core farmer entity
- **FarmerProfile** - Extended profile information
- **FarmerAddress** - Address details
- **FarmerDocument** - Document management
- **FarmerFinancialRecord** - Financial information
- **FarmerCreditRecord** - Credit history
- **FarmerInsuranceRecord** - Insurance information
- **FarmerAuditLog** - Change tracking
- **FarmerGroup** - Group associations
- **FarmingProfile** - Farming-specific attributes

## Controllers
- `FarmerController` - Farmer CRUD operations and management
- `FarmerProfileController` - Profile management

## Services
- `FarmerService` - Business logic for farmer operations
- `FarmerProfileService` - Profile management
- `DocumentService` - Document handling

## Key Relationships
- Farmer has one FarmerProfile
- Farmer has many addresses (FarmerAddress)
- Farmer has many documents (FarmerDocument)
- Farmer has many financial records (FarmerFinancialRecord)
- Farmer belongs to many groups (FarmerGroup)
- Farmer has one FarmingProfile

## Routes
```
GET    /farmers              - List farmers
POST   /farmers              - Create new farmer
GET    /farmers/{id}         - View farmer details
PUT    /farmers/{id}         - Update farmer
DELETE /farmers/{id}         - Delete farmer (soft delete)
GET    /farmers/{id}/profile - View profile
PUT    /farmers/{id}/profile - Update profile
```

## Usage Examples

### Get Farmer Profile
```php
$farmer = Farmer::with(['profile', 'documents', 'addresses'])->find($id);
```

### Add Financial Record
```php
$farmer->financialRecords()->create($data);
```

## Validation
- Email must be unique
- Phone number format validation
- Document file size and type validation
- Financial record data validation

## Testing
- Test farmer creation with valid/invalid data
- Test profile updates
- Test document uploads
- Test financial record association
- Test farmer group assignment

## Implementation Notes
- Use soft deletes for farmer records
- Implement audit logging for all changes
- Validate document uploads
- Create indexes on frequently queried fields
- Implement search by farmer name, phone, email
