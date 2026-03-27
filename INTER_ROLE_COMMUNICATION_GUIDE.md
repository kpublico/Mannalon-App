# Inter-Role Communication System - Complete Guide

## Overview

The Mannalon App now features a comprehensive **inter-role communication system** that enables different user roles to communicate through controlled channels. This system ensures secure, organized, and role-appropriate communication flow.

## System Architecture

### Components

1. **Database Tables**
   - `messages` - Core message storage
   - `notifications` - User notifications
   - `message_recipients` - Broadcast message recipients
   - `communication_permissions` - Role-based permission matrix
   - `conversation_threads` - Multi-participant conversations
   - `thread_participants` - Thread membership tracking

2. **Models**
   - `Message` - Core messaging model
   - `Notification` - Notification tracking
   - `MessageRecipient` - Recipient management for broadcasts
   - `ConversationThread` - Threaded conversations
   - `ThreadParticipant` - Thread membership
   - `CommunicationPermission` - Role permission definitions

3. **Controllers**
   - `MessagingController` - All messaging operations

4. **Traits**
   - `RoleMessagingTrait` - Role-based messaging methods attached to User model

5. **Policies**
   - `MessagePolicy` - Message access control
   - `ConversationThreadPolicy` - Thread access control
   - `NotificationPolicy` - Notification access control

## Supported Roles

The system supports four user roles:

- **farmer** - Agricultural data providers and recipients
- **admin** - Local administrators managing farmer groups
- **super_admin** - System supervisors overseeing admins
- **coordinator** - Coordination staff assisting farmers

## Role Communication Matrix

### Farmer → Communications

| To Role | Methods | Purpose |
|---------|---------|---------|
| Admin | Direct | Report issues, seek guidance |
| Coordinator | Direct | Get support and assistance |
| Farmer | Direct | Peer-to-peer communication |

### Admin → Communications

| To Role | Methods | Purpose |
|---------|---------|---------|
| Farmer | Direct, Broadcast | Send instructions, announcements to groups |
| Admin | Direct | Coordinate with other admins |
| Super Admin | Direct | Report status and seek approvals |
| Coordinator | Direct | Delegate tasks |

### Super Admin → Communications

| To Role | Methods | Purpose |
|---------|---------|---------|
| Admin | Direct, Broadcast | System directives, policy announcements |
| Farmer | Announcement | System-wide announcements |
| Super Admin | Direct | Strategic coordination |

### Coordinator → Communications

| To Role | Methods | Purpose |
|---------|---------|---------|
| Farmer | Direct | Provide support and guidance |
| Admin | Direct | Report coordination activities |
| Coordinator | Direct | Share coordination information |

## Communication Methods

### 1. Direct Messages
- One-to-one private communication
- Between specific users based on role permissions
- Full message content with read receipts

### 2. Broadcast Messages
- One-to-many communication to groups
- Sent by admins to specific farmer groups
- Creates message records for each recipient

### 3. Announcements
- System-wide messages from super admins
- Reaches all users of a specific role
- High visibility, archivable by recipients

### 4. Conversation Threads
- Multi-participant, topic-focused discussions
- Participants: message threads with replies
- Can be muted or closed
- Maintains conversation history

## Feature Details

### Message Types

```php
// Message Types:
- 'direct'       - Private message to specific user
- 'broadcast'    - To farmer group by admin
- 'announcement' - System-wide by super admin
- 'alert'        - System alerts
```

### Message Priority Levels

```php
- 'low'      - General information
- 'normal'   - Standard communication (default)
- 'high'     - Important items requiring attention
- 'urgent'   - Critical issues needing immediate action
```

### Message Status

- **Read/Unread** - Track if recipient has viewed
- **Archived** - Hidden from inbox but retained
- **Deleted** - Soft-deleted for archives
- **Notifications** - Track delivery and dismissal

## Usage Examples

### Send Direct Message

```php
$user = Auth::user();
$recipient = User::find($recipientId);

// Using the trait method
$message = $user->sendDirectMessage(
    $recipient,
    'Subject here',
    'Message content here',
    ['priority' => 'high']
);

// Or using the controller
Post to: /messages/send
{
    "recipient_id": 123,
    "subject": "Important Update",
    "content": "Content here",
    "message_type": "direct",
    "priority": "normal"
}
```

### Send Broadcast to Group

```php
// Using trait
$message = $admin->sendBroadcastToGroup(
    $groupId,
    'Group Announcement',
    'All farmers please note...',
    ['priority' => 'high']
);

// Via controller
Post to: /messages/send
{
    "target_group_id": 5,
    "subject": "Group Announcement",
    "content": "Content",
    "message_type": "broadcast",
    "priority": "normal"
}
```

### Start Conversation Thread

```php
// Via controller
Post to: /messages/threads/start
{
    "title": "Discussion Topic",
    "description": "Optional description",
    "participant_ids": [123, 456, 789]
}
```

### Reply in Thread

```php
// Via controller
Post to: /messages/threads/{threadId}/reply
{
    "content": "Reply message content"
}
```

### Check Message Permissions

```php
$user = Auth::user();

// Get available recipient roles
$roles = $user->getAvailableRecipientRoles();
// Returns: ['admin', 'coordinator', 'farmer']

// Get available methods for a role
$methods = $user->getAvailableMethods('admin');
// Returns: ['direct']

// Check if can send direct to user
if ($user->canSendDirectMessageTo($recipient)) {
    // Send message
}

// Check broadcast permission
if ($user->canSendBroadcast()) {
    // Send broadcast
}
```

## API Routes

### Message Management
```
GET    /messages                    - View inbox
GET    /messages/compose            - Compose form
POST   /messages/send               - Send message
GET    /messages/{message}          - View message
PUT    /messages/{message}/read     - Mark read
PUT    /messages/{message}/archive  - Archive message
DELETE /messages/{message}          - Delete message
```

### Notifications
```
GET    /messages/notifications/list              - Get notifications
PUT    /messages/notifications/{notification}/dismiss - Dismiss
```

### Conversation Threads
```
GET    /messages/threads                    - List threads
POST   /messages/threads/start               - Start thread
GET    /messages/threads/{thread}            - View thread
POST   /messages/threads/{thread}/reply      - Reply to thread
```

### Statistics
```
GET    /messages/api/statistics - Get message statistics
```

## Security Features

### Authorization
- **Policies**: `MessagePolicy`, `ConversationThreadPolicy`, `NotificationPolicy`
- **Role-based Access**: Only permitted roles can communicate
- **User Isolation**: Users can only access their own messages

### Data Protection
- Soft deletes for audit trail
- Read receipt tracking
- IP logging in audit trails
- Metadata storage for context

### Permission Control
- `CommunicationPermission` table manages all role relationships
- Enable/disable communication channels
- Conditions field for complex rules

## Database Schema

### Messages Table
```
- id: PK
- sender_id: FK to users
- recipient_id: FK to users (nullable for broadcasts)
- subject: string
- content: longtext
- message_type: enum(direct, broadcast, announcement, alert)
- priority: enum(low, normal, high, urgent)
- recipient_type: string (farmer, admin, etc.)
- target_group_id: FK to farmer_groups
- department_id: unsigned bigint
- is_read: boolean
- read_at: timestamp
- is_archived: boolean
- attachment_path: string
- metadata: json
- sent_at: timestamp
- timestamps, soft deletes
```

### Communication Permissions Table
```
- id: PK
- sender_role: string
- recipient_role: string
- is_enabled: boolean
- communication_method: string
- description: text
- conditions: json
- timestamps
```

## Seeding Communication Permissions

Run migrations to set up default permissions:
```bash
php artisan migrate
```

This will create all communication permission rules defined in:
`database/migrations/2026_03_25_130100_seed_communication_permissions.php`

## Frontend Integration

### Notifications
- Dashboard widget showing unread count
- Real-time notification display
- Mark as read/dismiss actions

### Message Compose
- Role-based recipient dropdown
- Template suggestions
- Attachment support

### Thread Discussions
- Real-time updates (future)
- Nested reply threading
- Participant management

## Future Enhancements

1. **Real-time Updates**
   - WebSocket broadcast notifications
   - Live message delivery

2. **Advanced Filtering**
   - Search by sender, date, priority
   - Label/tag system
   - Archive management

3. **Message Templates**
   - Pre-defined message formats
   - Quick send functionality

4. **Attachment Support**
   - File attachments
   - Document sharing
   - Image uploads

5. **Email Notifications**
   - Email digest of messages
   - Urgent message alerts

6. **Scheduling**
   - Schedule message sending
   - Recurring messages

## Configuration

### Enable/Disable Communication Channels

```php
// Disable specific communication method
CommunicationPermission::where('sender_role', 'farmer')
    ->where('recipient_role', 'admin')
    ->where('communication_method', 'direct')
    ->update(['is_enabled' => false]);
```

### Add New Roles

To add new role communication:

1. Add new communication permission records:
```php
CommunicationPermission::create([
    'sender_role' => 'new_role',
    'recipient_role' => 'farmer',
    'is_enabled' => true,
    'communication_method' => 'direct',
    'description' => 'Description of communication',
]);
```

## Troubleshooting

### Permission Denied Errors
- Check `communication_permissions` table for role pair
- Verify `is_enabled` is true
- Confirm correct role names

### Messages Not Appearing
- Verify recipient user exists
- Check message type matches permission method
- Ensure sender has correct role

### Notifications Missing
- Check notification creation in controller
- Verify notification preferences
- Check notification channel settings

## Best Practices

1. **Always Check Permissions**
   - Use trait methods to verify before operations
   - Handle permission failures gracefully

2. **Include Metadata**
   - Store contextual information in metadata field
   - Include crop type, location, or reference IDs

3. **Use Priority Appropriately**
   - Reserve 'urgent' for critical alerts
   - Use 'normal' for routine communication

4. **Archive Old Messages**
   - Archive completed conversations
   - Keep inbox organized

5. **Thread Discussions for Complex Topics**
   - Multi-participant issues
   - Decision-making processes

## Support & Development

For extending the system:
- Check `app/Models/Message.php` for core logic
- Review `app/Http/Controllers/MessagingController.php` for operations
- See `app/Traits/RoleMessagingTrait.php` for convenience methods
