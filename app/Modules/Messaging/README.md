# Messaging Module

## Overview
Handles inter-user communication including direct messages, chat threads, and conversation management.

## Responsibilities
- Direct messaging between users
- Chat thread management
- Conversation participant tracking
- Message delivery and read status
- Conversation filtering and search

## Key Models
- **Message** - Individual messages
- **MessageRecipient** - Message recipients and delivery status
- **ConversationThread** - Chat threads/conversations
- **ThreadParticipant** - Participants in a thread

## Controllers
- `ChatController` - Chat interface and operations
- `MessagingController` - Direct messaging operations

## Services
- `MessagingService` - Core messaging business logic
- `ChatService` - Chat thread management
- `NotificationService` - Message notifications

## Key Relationships
- Message belongs to User (sender)
- Message has many recipients (MessageRecipient)
- ConversationThread has many participants
- ConversationThread has many messages

## Routes
```
GET    /messages            - List conversations
POST   /messages            - Send message
GET    /messages/{id}       - View conversation
PUT    /messages/{id}/read  - Mark as read
DELETE /messages/{id}       - Delete message
GET    /threads             - List chat threads
POST   /threads             - Create new thread
```

## Usage Examples

### Send Direct Message
```php
Message::create([
    'sender_id' => auth()->id(),
    'thread_id' => $threadId,
    'content' => 'Hello'
]);
```

### Get User Conversations
```php
$conversations = auth()->user()->conversations()->latest()->get();
```

## Validation
- Message content not empty
- Valid recipient selection
- Thread participant validation

## Testing
- Test sending messages
- Test conversation creation
- Test participant management
- Test message read status
- Test notification triggers

## Implementation Notes
- Implement real-time messaging with WebSockets (optional)
- Store message attachments
- Implement message search
- Add message deletion with audit trail
- Create notification system for new messages
- Implement typing indicators
- Add emoji and rich text support
