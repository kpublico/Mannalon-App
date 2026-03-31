# Guide Module

## Overview
Manages farming guides and educational content to help farmers improve agricultural practices.

## Responsibilities
- Farming guide creation and publishing
- Guide categorization and tagging
- Guide versioning and updates
- Guide attachments (PDFs, videos)
- Guide accessibility and distribution

## Key Models
- **FarmingGuide** - Farming guides and educational content

## Controllers
- `GuideController` - Guide management and viewing

## Services
- `GuideService` - Business logic for guide operations
- `GuidePublishService` - Guide publishing workflow

## Key Relationships
- Guide created by Admin/Expert User
- Guide accessible to Farmers based on permissions
- Guide can have multiple attachments
- Guide can have versions

## Routes
```
GET    /guides              - List all guides
GET    /guides/{id}         - View specific guide
POST   /guides              - Create new guide (admin only)
PUT    /guides/{id}         - Update guide (admin only)
DELETE /guides/{id}         - Delete guide (admin only)
GET    /guides/search       - Search guides
```

## Usage Examples

### Get All Guides for a Crop Type
```php
$guides = FarmingGuide::where('crop_type', 'wheat')->get();
```

### Get Guide with Attachments
```php
$guide = FarmingGuide::with('attachments')->find($id);
```

## Validation
- Guide title and content required
- Valid crop category selection
- Attachment file type validation
- PDF/video format validation

## Testing
- Test guide creation workflow
- Test guide search and filtering
- Test guide attachment handling
- Test guide visibility based on permissions

## Implementation Notes
- Support multiple languages for guides
- Implement rich text editor for guide content
- Create PDF generation capability
- Implement view tracking for guides
- Add recommendation engine for relevant guides
- Create guide feedback system
- Support embedded videos in guides
