# Inter-Role Communication System - Implementation Checklist

## ✅ Completed Components

### Database Layer
- [x] Migration: `2026_03_25_130000_create_messages_system_tables.php`
  - Created `messages` table
  - Created `notifications` table
  - Created `message_recipients` table
  - Created `communication_permissions` table
  - Created `conversation_threads` table
  - Created `thread_participants` table

- [x] Migration: `2026_03_25_130100_seed_communication_permissions.php`
  - Predefined role communication matrix
  - All role pairs configured with methods

### Models
- [x] `Message` - Message model with all relationships
- [x] `Notification` - Notification model
- [x] `MessageRecipient` - Recipient management
- [x] `CommunicationPermission` - Permission matrix
- [x] `ConversationThread` - Thread management
- [x] `ThreadParticipant` - Participant tracking

### Controllers
- [x] `MessagingController` - Complete implementation with:
  - Message management (send, read, archive, delete)
  - Notification handling
  - Thread conversations
  - Statistics and reporting

### Authorization
- [x] `MessagePolicy` - Message access control
- [x] `ConversationThreadPolicy` - Thread access control
- [x] `NotificationPolicy` - Notification access control
- [x] Policy registration in `AppServiceProvider`

### Traits
- [x] `RoleMessagingTrait` - Added to User model with methods:
  - Get available recipient roles
  - Send direct messages
  - Send broadcasts
  - Send announcements
  - Check permissions
  - Get unread count

### Routing
- [x] Added message routes to `routes/web.php`
  - Inbox and compose routes
  - Message CRUD routes
  - Notification routes
  - Thread management routes
  - API statistics endpoint

### User Model
- [x] Updated `User.php` with:
  - Messaging relationships
  - Notification relationships
  - Thread relationships
  - `RoleMessagingTrait` usage

### Service Provider
- [x] Updated `AppServiceProvider` to register policies

### Documentation
- [x] `INTER_ROLE_COMMUNICATION_GUIDE.md` - Complete guide

## 🚀 Next Steps to Integrate

### 1. Run Migrations
```bash
php artisan migrate
```

This will:
- Create all message system tables
- Seed communication permissions
- Initialize role matrix

### 2. Create Views (Optional but Recommended)

Create blade templates for UI:
- `resources/views/messaging/inbox.blade.php` - Inbox list
- `resources/views/messaging/show.blade.php` - View message
- `resources/views/messaging/compose.blade.php` - Compose new
- `resources/views/messaging/threads.blade.php` - Thread list
- `resources/views/messaging/thread.blade.php` - Thread view

### 3. Add Dashboard Widgets

In farmer/admin dashboards, add:
```blade
@if($unreadCount = auth()->user()->getUnreadMessageCount())
    <div class="alert alert-info">
        You have {{ $unreadCount }} unread messages
        <a href="{{ route('messages.inbox') }}">View</a>
    </div>
@endif
```

### 4. Add Navigation Links

Update header/navigation:
```blade
<a href="{{ route('messages.inbox') }}">
    <i class="fas fa-envelope"></i>
    Messages
    @if(auth()->user()->getUnreadMessageCount())
        <span class="badge">{{ auth()->user()->getUnreadMessageCount() }}</span>
    @endif
</a>
```

### 5. Create API Responses

For AJAX interactions, use existing endpoints:
- `POST /messages/send` - Send message
- `GET /messages/api/statistics` - Get statistics
- `PUT /messages/{id}/read` - Mark read

### 6. Implement Frontend Components

React/Vue components for:
- Message list with real-time updates
- Compose form with validation
- Notification bell with dropdown
- Thread UI with add participant

### 7. Set Up Event Broadcasting (Optional)

For real-time notifications:
```php
// Create event: app/Events/MessageSent.php
// Add to Message model: send event after create
event(new MessageSent($message));
```

### 8. Configure Email Notifications (Optional)

For email delivery:
```php
// Create mailable: app/Mail/NewMessageMail.php
// Register in notification handler
```

## 📋 Usage Quick Reference

### Check Permissions
```php
$user = Auth::user();

// Available roles this user can message
$roles = $user->getAvailableRecipientRoles();

// Check specific permission
if ($user->canSendDirectMessageTo($recipient)) {
    // Send message
}
```

### Send Messages
```php
// Direct message
$user->sendDirectMessage($recipient, $subject, $content);

// Broadcast to group
$user->sendBroadcastToGroup($groupId, $subject, $content);

// System announcement
$user->sendSystemAnnouncement($subject, $content);
```

### View Inbox
```
GET /messages
```

### Send Message
```
POST /messages/send
{
  "recipient_id": 5,
  "subject": "Title",
  "content": "Message content",
  "message_type": "direct",
  "priority": "normal"
}
```

### Conversation Threads
```
GET /messages/threads - List all threads
POST /messages/threads/start - Create thread
GET /messages/threads/{id} - View thread
POST /messages/threads/{id}/reply - Reply
```

## 🔄 Role Permission Matrix

### Farmer
- Can message: Admin, Coordinator, Farmer (direct)
- Cannot broadcast or announce

### Admin  
- Can message: Farmer (direct, broadcast), Admin (direct), Super Admin (direct), Coordinator (direct)
- Can broadcast to farmer groups
- Cannot system announce

### Super Admin
- Can message: Admin (direct, broadcast), Farmer (announcement), Super Admin (direct)
- Can broadcast to admins
- Can send system announcements

### Coordinator
- Can message: Farmer (direct), Admin (direct), Coordinator (direct)
- Cannot broadcast or announce

## 🧪 Testing Commands

### Artisan Commands
```bash
# Run migrations
php artisan migrate

# Check permission
php artisan tinker
>>> $user = User::find(1);
>>> $user->getAvailableRecipientRoles();

# Seed permissions
php artisan migrate:refresh --seed
```

### Manual Testing Routes
```
/messages                    - View inbox
/messages/compose           - New message form
POST /messages/send         - Send message
GET /messages/notifications/list - Get notifications
/messages/threads           - View threads
```

## ⚠️ Important Notes

1. **Migrations Required**: Run `php artisan migrate` before using system
2. **Role Names**: Use exact role names from database ('farmer', 'admin', 'super_admin', 'coordinator')
3. **FarmerGroup Relationship**: Broadcasts require farmer groups to exist
4. **Authentication**: All routes require `auth` middleware
5. **Authorization**: Policies enforce role-based access

## 📊 System Changes Summary

### New Files Created
- Models: 6 (Message, Notification, MessageRecipient, CommunicationPermission, ConversationThread, ThreadParticipant)
- Controllers: 1 (MessagingController)
- Policies: 3 (MessagePolicy, ConversationThreadPolicy, NotificationPolicy)
- Traits: 1 (RoleMessagingTrait)
- Migrations: 2 (messages system tables, permissions seeding)

### Modified Files
- User.php - Added traits and relationships
- AppServiceProvider.php - Policy registration
- routes/web.php - New messaging routes

### Database Tables
- messages (stores all messages)
- notifications (tracks notification delivery)
- message_recipients (manages broadcast recipients)
- communication_permissions (role permission matrix)
- conversation_threads (groups messages by topic)
- thread_participants (tracks thread members)

## Key Features

✅ Role-Based Communication - Only permitted role pairs can communicate
✅ Multiple Message Types - Direct, Broadcast, Announcement, Alert
✅ Priority Levels - Low, Normal, High, Urgent
✅ Read Receipts - Track if messages have been viewed
✅ Thread Conversations - Multi-participant organized discussions
✅ Notification System - Track delivery and dismissals
✅ Permission Matrix - Flexible, configurable role relationships
✅ Soft Deletes - Audit trail of deleted messages
✅ Metadata Storage - Contextual information in messages

## Support Files

- `INTER_ROLE_COMMUNICATION_GUIDE.md` - Comprehensive documentation
- This file - Implementation checklist and quick reference

## Related System Components

These communication features integrate with:
- User authentication and roles
- Farmer groups and management
- Admin supervision hierarchy
- Audit logging system

See main system documentation for integration details.
