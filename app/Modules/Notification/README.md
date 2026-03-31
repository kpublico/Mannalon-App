# Notification Module

## Overview
Manages user notifications including alerts, reminders, and notification delivery.

## Responsibilities
- User notification creation
- Notification delivery (in-app, email, SMS)
- Notification preferences management
- Read/unread status tracking
- Notification archiving

## Key Models
- **Notification** - User notifications

## Controllers
- `NotificationController` - Notification management

## Services
- `NotificationService` - Core notification logic
- `NotificationChannelService` - Multi-channel delivery
- `NotificationPreferenceService` - User preferences

## Key Relationships
- Notification belongs to User (recipient)
- Notification has multiple delivery channels
- User has notification preferences

## Routes
```
GET    /notifications        - List user notifications
GET    /notifications/{id}   - View notification
PUT    /notifications/{id}/read - Mark as read
DELETE /notifications/{id}   - Delete notification
GET    /notifications/preferences - Get preferences
PUT    /notifications/preferences - Update preferences
```

## Usage Examples

### Send Notification
```php
Notification::send($user, new NewCropAlertNotification($crop));
```

### Get Unread Notifications
```php
$unread = auth()->user()->notifications()->whereNull('read_at')->get();
```

## Validation
- Valid recipient user
- Valid notification type
- Channel availability validation

## Testing
- Test notification creation
- Test delivery to channels
- Test read status tracking
- Test user preferences

## Implementation Notes
- Support email delivery
- Support in-app notifications
- Support SMS notifications (optional)
- Create notification templates
- Implement notification queuing
- Add rate limiting for notifications
- Create notification history
- Implement Do Not Disturb modes
