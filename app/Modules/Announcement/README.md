# Announcement Module

## Overview
Manages system announcements and broadcasts to communicate important information with users.

## Responsibilities
- Announcement creation and publishing
- Announcement distribution to user groups
- Announcement scheduling
- Announcement status tracking
- Archive and retrieval

## Key Models
- **Announcement** - System announcements

## Controllers
- `AnnouncementController` - Announcement management

## Services
- `AnnouncementService` - Announcement business logic
- `AnnouncementDistributionService` - Distribution management

## Key Relationships
- Announcement created by Admin
- Announcement targets specific user roles/groups
- Announcement has publish/expiry dates

## Routes
```
GET    /announcements        - List announcements
GET    /announcements/{id}   - View announcement
POST   /announcements        - Create announcement (admin only)
PUT    /announcements/{id}   - Update announcement (admin only)
DELETE /announcements/{id}   - Delete announcement (admin only)
```

## Usage Examples

### Get Active Announcements
```php
$announcements = Announcement::where('is_published', true)
    ->where('expires_at', '>', now())
    ->latest()
    ->get();
```

### Create Announcement
```php
Announcement::create([
    'title' => 'New Season Guidelines',
    'content' => 'Follow these guidelines...',
    'audience' => 'farmers'
]);
```

## Validation
- Title and content required
- Valid target audience
- Valid publication dates

## Testing
- Test announcement creation
- Test announcement publishing
- Test audience targeting
- Test announcement expiration

## Implementation Notes
- Support HTML content
- Create email notifications for announcements
- Implement announcement scheduling
- Add read status tracking
- Create archive views
- Support priority levels
- Add rich text editor for content creation
